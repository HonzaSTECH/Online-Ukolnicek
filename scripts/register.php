<?php
	session_start(); 
	unset($_SESSION['class']);
	unset($_SESSION['user']);
	include 'languageHandler.php';
?>

<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../images/transparentMarklessLogo.ico">
	<link rel="stylesheet" href="../styles/register.css">
</head>
<body>
	<div id="registerBox">
		<div id="header"><?php echo $lang['register'] ?></div>
		<form method="POST" action="register.php<?php echo $urlExtension; ?>" id="registerForm">
			<fieldset>
			<input type="text" name="username" placeholder="<?php echo $lang['name']; ?>" id="usernameInput" required>
			<br />
			<input type="password" name="password" placeholder="<?php echo $lang['pass']; ?> (a-z + A-Z + 0-9)" id="passwordInput" required>
			<br />
			<input type="password" name="password_repeat" placeholder="<?php echo $lang['repeatPass']; ?>" id="repeatPasswordInput" required>
			<br />
			<input type="email" name="email" placeholder="<?php echo $lang['e-mail']; ?>" id="emailInput" required>
			<div id="termsInput">
				<input type="checkbox" name="accept" id="checkbox">
				<span id=termsText><?php echo $lang['termsText']; ?> <a href="terms.html"><u><?php echo $lang['termsLink']; ?></u></a>.</span>
			</div>
			<input type="submit" name="send" value="<?php echo $lang['register']; ?>" id="submitButton">
			</fieldset>
		</form>
		<div id="loginLink"><?php echo $lang['logInText']; ?><a href="login.php"><u><?php echo $lang['hereLink']; ?></u></a>.</div>
		
		<?php
			require_once("connect.php");
			include 'logger.php';
			
			//Handling form submit
			if(isset($_POST['send']))
			{
				//Getting inputed data
				$name = $_POST['username'];
				$pass = $_POST['password'];
				$pass_repeat = $_POST['password_repeat'];
				$email = $_POST['email'];
				$accept = @$_POST['accept'];
				
				//Checking for acceptence of terms of service
				if(!isset($accept)){echo "<div id='registerError'>".$lang['termsFailRegister']."</div>";}
				else		//Accepted terms
				{
					//Searching the database for an existing account with the same name
					$query = "SELECT * FROM users WHERE name='$name'";
					$result = mysqli_query($connection, $query);
					$data = mysqli_fetch_array($result);
					$data = $data['name'];
					
					//Checking for valid username
					if(strlen($name) < 4){echo "<div id='registerError'>".$lang['shortNameFailRegister']."</div>";}
					else if(strlen($name) > 16){echo "<div id='registerError'>".$lang['longNameFailRegister']."</div>";}
					else if(!empty($data)){echo "<div id='registerError'>".$lang['duplicateNameFailRegister']."</div>";}
					
					//Checking for valid password
					else if(strlen($pass) < 6){echo "<div id='registerError'>".$lang['shortPassFailRegister']."</div>";}
					else if(strlen($pass) > 32){echo "<div id='registerError'>".$lang['longPassFailRegister']."</div>";}
					else if($pass != $pass_repeat){echo "<div id='registerError'>".$lang['unequalPassFailRegister']."</div>";}
					else if(!preg_match("#[0-9]+#", $pass)){echo "<div id='registerError'>".$lang['noDigitInPassFailRegister']."</div>";}
					else if(!preg_match("#[a-z]+#", $pass)){echo "<div id='registerError'>".$lang['noLowercaseInPassFailRegister']."</div>";}
					else if(!preg_match("#[A-Z]+#", $pass)){echo "<div id='registerError'>".$lang['noUppercaseInPassFailRegister']."</div>";}
					else		//Valid name and password
					{
						//Searching the database for an existing account with the same e-mail
						$query = "SELECT * FROM users WHERE email = '$email'";
						$result = mysqli_query($connection, $query);
						$data = mysqli_fetch_array($result);
						$data = $data['email'];
						
						//Checking for valid e-mail address
						if(!filter_var($email, FILTER_VALIDATE_EMAIL)){echo "<div id='registerError'>".$lang['invalidEmailFailRegister']."</div>";}
						else if(strlen($email) > 64){echo "<div id='registerError'>".$lang['longEmailFailRegister']."</div>";}
						else if(!empty($data)){echo "<div id='registerError'>".$lang['duplicateEmailFailRegister']."</div>";}
						else		//Valid e-mail
						{
							//Encrypting the password
							$pass = password_hash($pass, PASSWORD_DEFAULT);
							
							//Saving the account into the database
							$query = "INSERT INTO users (name, password, email) VALUES ('$name', '$pass', '$email')";
							$result = mysqli_query($connection, $query);
							
							//Checking for error
							if(!$result){echo "<div id='registerError'>".$lang['unknownFailRegister']; echo "<br />"; echo mysqli_error($connection)."</div>";}
							else		//Registred
							{
								//Displaying success message
								echo "<div id='successMessage'>".$lang['successfulRegister']."</div>";
								
								//Saving user's name into superglobal
								$_SESSION['user']=$name;
								
								//Logging the account creation
								$ip = $_SERVER['REMOTE_ADDR'];
								filelog("Uživatel $name se zaregistroval do systému z IP adresy $ip.");
								echo "<script type='text/javascript'>location.href = 'home.php".$urlExtension."';</script>";
							}
						}
					}
				}
			}
			mysqli_close($connection);
		?>
		
	</div>
</body>
