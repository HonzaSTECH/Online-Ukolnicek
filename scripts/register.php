<?php
	session_start(); 
	unset($_SESSION['class']);
	unset($_SESSION['user']);
?>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../favicon.ico">
	<link rel="stylesheet" href="../styles/register.css">
</head>
<body>
	<div id="registerBox">
		<form method="POST" action="register.php" id="registerForm">
			<input type="text" name="username" placeholder="Jméno" id="usernameInput" required><br />
			<input type="password" name="password" placeholder="Heslo" id="passwordInput" required><br />
			<input type="password" name="password_repeat" placeholder="Heslo znovu" id="repeatPasswordInput" required><br />
			<input type="email" name="email" placeholder="E-mail" id="emailInput" required>
			<div id="termsInput"><br /><input type="checkbox" name="accept" id="checkbox"><br /><span id=termsText>Souhlasím se spracováním zadaných údajů pro účely této služby</span></div>
			<input type="submit" name="send" value="Zaregistrovat se" id="submitButton">
		</form>
		<div id="loginLink">Jsi již zaregistrován? Přihlaš se <a href="login.php"><u>zde</u></a>.</div>
		<?php
			require_once("connect.php");
			include 'logger.php';
			
			if(isset($_POST['send']))
			{
				$name = $_POST['username'];
				$pass = $_POST['password'];
				$pass_repeat = $_POST['password_repeat'];
				$email = $_POST['email'];
				$accept = @$_POST['accept'];
				
				if(!isset($accept)){echo "<div id='registerError'>Musíš udělit souhlas se spracováním zadaných údajů.</div>";}
				else		//Accepted terms
				{
					$query = "SELECT * FROM users WHERE name='$name'";
					$result = mysqli_query($connection, $query);
					$data = mysqli_fetch_array($result);
					$data = $data['name'];
					if(strlen($name) < 4){echo "<div id='registerError'>Jméno musí být alespoň 4 znaky dlouhé.</div>";}
					else if(strlen($name) > 16){echo "<div id='registerError'>Jméno nesmí být více než 16 znaků dlouhé.</div>";}
					else if(!empty($data)){echo "<div id='registerError'>Uživatel s tímto jménem již existuje.</div>";}
					else if(strlen($pass) < 6){echo "<div id='registerError'>Heslo musí být alespoň 6 znaků dlouhé.</div>";}
					else if(strlen($pass) > 32){echo "<div id='registerError'>Heslo nesmí být více než 32 znaků dlouhé.</div>";}
					else if($pass != $pass_repeat){echo "<div id='registerError'>Hesla se neschodují.</div>";}
					else if(!preg_match("#[0-9]+#", $pass)){echo "<div id='registerError'>Heslo musí obsahovat alespoň jednu číslici.</div>";}
					else if(!preg_match("#[a-z]+#", $pass)){echo "<div id='registerError'>Heslo musí obsahovat alespoň jedno malé písmeno</div>";}
					else if(!preg_match("#[A-Z]+#", $pass)){echo "<div id='registerError'>Heslo musí obsahovat alespoň jedno velké písmeno</div>";}
					else		//Valid name and password
					{
						$query = "SELECT * FROM users WHERE email = '$email'";
						$result = mysqli_query($connection, $query);
						$data = mysqli_fetch_array($result);
						$data = $data['email'];
						if(!filter_var($email, FILTER_VALIDATE_EMAIL)){echo "<div id='registerError'>Musíš zadat platnou e-mailovou adresu.</div>";}
						else if(strlen($email) > 64){echo "<div id='registerError'>E-mail nesmí být více než 64 znaků dlouhé</div>";}
						else if(!empty($data)){echo "<div id='registerError'>Uživatel s tímto e-mailem již existuje.</div>";}
						else		//Valid e-mail
						{
							$pass = password_hash($pass, PASSWORD_DEFAULT);
							$query = "INSERT INTO users (name, password, email) VALUES ('$name', '$pass', '$email')";
							$result = mysqli_query($connection, $query);
							if(!$result){echo "<div id='registerError'>Nastala chyba. Zkuste to později, nebo kontaktujte administrátora na e-mailu honza.stech@gmail.com."; echo mysqli_error($connection)."</div>";}
							else		//Registred
							{
								echo "<div id='successMessage'>Byl/a jsi úspěšně zaregistrován/a.</div>";
								$_SESSION['user']=$name;
								filelog("Uživatel $name se zaregistroval do systému.");
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