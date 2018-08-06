<?php
	session_start(); 
	unset($_SESSION['class']);
	unset($_SESSION['user']);
?>
<head>
	<meta charset="utf-8">
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
			
			if(isset($_POST['send'])){
				$name = $_POST['username'];
				$pass = $_POST['password'];
				$pass_repeat = $_POST['password_repeat'];
				$email = $_POST['email'];
				$accept = @$_POST['accept'];
				
				if(isset($accept)){
					$query = "SELECT * FROM users WHERE name='$name'";
					$result = mysqli_query($connection, $query);
					$data = mysqli_fetch_array($result);
					$data = $data['name'];
					if(empty($data)){
						if($pass == $pass_repeat){
							$query = "SELECT * FROM users WHERE email = '$email'";
							$result = mysqli_query($connection, $query);
							if(!empty($result) || empty($email)){
								$query = "INSERT INTO users (name, password, email) VALUES ('$name', '$pass', '$email')";
								$result = mysqli_query($connection, $query);
								if($result){
										echo "Byl/a jsi úspěšně zaregistrován/a.";
										$_SESSION['user']=$name;
										filelog("Uživatel $name se zaregistroval do systému.");
										echo "<script type='text/javascript'>location.href = 'home.php';</script>";
								}
								else{echo "<div id='registerError'>Nastala chyba. Zkuste to později, nebo kontaktujte administrátora na emailu honza.stech@gmail.com."; echo mysqli_error($connection)."</div>";}
							}
							else{echo "<div id='registerError'>Uživatel s tímto e-mailem již existuje.</div>";}
						}
						else{echo "<div id='registerError'>Hesla se neschodují.</div>";}
					}
					else{echo "<div id='registerError'>Uživatel s tímto jménem již existuje.</div>";}
				}
				else{echo "<div id='registerError'>Musíš udělit souhlas se spracováním zadaných údajů.</div>";}
			}
			mysqli_close($connection);
		?>
	</div>
</body>