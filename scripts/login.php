<?php
	session_start(); 
	unset($_SESSION['class']);
	unset($_SESSION['user']);
?>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../favicon.ico">
	<link rel="stylesheet" href="../styles/login.css">
</head>
<body>
        <div id="loginBox">
		<form method="POST" action="login.php" id="loginForm">
			<input type=text name="username" placeholder="Jméno" id="usernameInput" required>
			<br />
			<input type=password name="password" placeholder="Heslo" id="passwordInput" required>
			<br />
			<input type=submit name="send" value="Přihlásit se" id="submitButton">
		</form>
		<div id="registerLink">Ještě nemáš účet? Zaregistruj se <a href="register.php"><u>zde</u></a>.</div>
		<?php
			require_once("connect.php");
			include 'logger.php';
			
			if(isset($_POST['send'])){
				$name = $_POST['username'];
				$pass = $_POST['password'];
				
				$query = "SELECT * FROM users WHERE name='$name'";
				$result = mysqli_query($connection, $query);
				
				$data = mysqli_fetch_array($result);
				
				if($data['name'] == $name){
					if(password_verify($pass, $data['password'])){
						echo "<div id='successMessage'>Byl/a jsi úspěšně přihlášen/a.</div>";
						$_SESSION['user']=$name;
						$ip = $_SERVER['REMOTE_ADDR'];
						fileLog("Uživatel $name se přihlásil z IP adresy $ip");
						echo "<script type='text/javascript'>location.href = 'home.php';</script>";
					}
					else{echo "<div id='loginError'>Špatné heslo</div>";}
				}
				else{echo "<div id='loginError'>Uživatel s tímto jménem neexistuje.</div>";}
			}
			mysqli_close($connection);

		?>
        </div>
</body>
