<?php
	session_start(); 
	unset($_SESSION['class']);
	unset($_SESSION['user']);
?>

<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../images/transparentMarklessLogo.ico">
	<link rel="stylesheet" href="../styles/register.css">
</head>
<body>
	<div id="registerBox">
		<div id="header">Register</div>
		<form method="POST" action="register.php" id="registerForm">
			<fieldset>
			<input type="text" name="username" placeholder="Name" id="usernameInput" required>
			<br />
			<input type="password" name="password" placeholder="Password (a-z + A-Z + 0-9)" id="passwordInput" required>
			<br />
			<input type="password" name="password_repeat" placeholder="Repeat password" id="repeatPasswordInput" required>
			<br />
			<input type="email" name="email" placeholder="E-mail" id="emailInput" required>
			<div id="termsInput">
				<input type="checkbox" name="accept" id="checkbox">
				<span id=termsText>I agree with the <a href="terms.html"><u>terms of service</u></a>.</span>
			</div>
			<input type="submit" name="send" value="Register" id="submitButton">
			</fieldset>
		</form>
		<div id="loginLink">Already having an account? Log in <a href="login.php"><u>here</u></a>.</div>
		
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
				if(!isset($accept)){echo "<div id='registerError'>You have to accept out terms of service.</div>";}
				else		//Accepted terms
				{
					//Searching the database for an existing account with the same name
					$query = "SELECT * FROM users WHERE name='$name'";
					$result = mysqli_query($connection, $query);
					$data = mysqli_fetch_array($result);
					$data = $data['name'];
					
					//Checking for valid username
					if(strlen($name) < 4){echo "<div id='registerError'>The name must be at least 4 characters long.</div>";}
					else if(strlen($name) > 16){echo "<div id='registerError'>The name mustn't be more than 16 characters long.</div>";}
					else if(!empty($data)){echo "<div id='registerError'>This name is already used by another user.</div>";}
					
					//Checking for valid password
					else if(strlen($pass) < 6){echo "<div id='registerError'>The password must be at leat 6 characters long.</div>";}
					else if(strlen($pass) > 32){echo "<div id='registerError'>The password mustn't be more then 32 characters long.</div>";}
					else if($pass != $pass_repeat){echo "<div id='registerError'>The passwords aren't equal.</div>";}
					else if(!preg_match("#[0-9]+#", $pass)){echo "<div id='registerError'>The password must contain at least one digit.</div>";}
					else if(!preg_match("#[a-z]+#", $pass)){echo "<div id='registerError'>The password must contain at least one lowercase letter.</div>";}
					else if(!preg_match("#[A-Z]+#", $pass)){echo "<div id='registerError'>The password must contain at least one uppercase letter.</div>";}
					else		//Valid name and password
					{
						//Searching the database for an existing account with the same e-mail
						$query = "SELECT * FROM users WHERE email = '$email'";
						$result = mysqli_query($connection, $query);
						$data = mysqli_fetch_array($result);
						$data = $data['email'];
						
						//Checking for valid e-mail address
						if(!filter_var($email, FILTER_VALIDATE_EMAIL)){echo "<div id='registerError'>You have to enter your valid e-mail address.</div>";}
						else if(strlen($email) > 64){echo "<div id='registerError'>Your e-mail mustn't be more than 64 characters long.</div>";}
						else if(!empty($data)){echo "<div id='registerError'>This e-mail is already used by another user.</div>";}
						else		//Valid e-mail
						{
							//Encrypting the password
							$pass = password_hash($pass, PASSWORD_DEFAULT);
							
							//Saving the account into the database
							$query = "INSERT INTO users (name, password, email) VALUES ('$name', '$pass', '$email')";
							$result = mysqli_query($connection, $query);
							
							//Checking for error
							if(!$result){echo "<div id='registerError'>An error occured. Repeat your attempt later or contact webmaster on e-mail address honza.stech@gmail.com."; echo "<br />"; echo mysqli_error($connection)."</div>";}
							else		//Registred
							{
								//Displaying success message
								echo "<div id='successMessage'>You was successfully registred.</div>";
								
								//Saving user's name into superglobal
								$_SESSION['user']=$name;
								
								//Logging the account creation
								$ip = $_SERVER['REMOTE_ADDR'];
								filelog("Uživatel $name se zaregistroval do systému z IP adresy $ip.");
								echo "<script type='text/javascript'>location.href = 'home.php';</script>";
							}
						}
					}
				}
			}
			mysqli_close($connection);
		?>
		
	</div>
</body>
