<?php
	session_start(); 
	unset($_SESSION['class']);
	unset($_SESSION['user']);
?>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../images/transparentMarklessLogo.ico">
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
			
			//Handling form submit
			if(isset($_POST['send']))
			{
				//Getting inputed data
				$name = $_POST['username'];
				$pass = $_POST['password'];
				
				//Getting user's account details from the database
				$query = "SELECT * FROM users WHERE name='$name'";
				$result = mysqli_query($connection, $query);
				$data = mysqli_fetch_array($result);
				
				//Checking for existence of a account with given name
				if($data['name'] == $name)
				{
					//Checking for correct password
					if(password_verify($pass, $data['password']))
					{
						//Displaying success message
						echo "<div id='successMessage'>Byl/a jsi úspěšně přihlášen/a.</div>";
						
						//Saving user's name into superglobal
						$_SESSION['user']=$name;
						
						//Logging the signing in from a IP adress
						$ip = $_SERVER['REMOTE_ADDR'];
						fileLog("Uživatel $name se přihlásil z IP adresy $ip.");
						
						//Redirecting
						echo "<script type='text/javascript'>location.href = 'home.php';</script>";
					}
					else{
						//Displaying error message
						echo "<div id='loginError'>Špatné heslo</div>";
						
						//Logging the attempt
						$ip = $_SERVER['REMOTE_ADDR'];
						fileLog("Z adresy $ip proběhl pokus o přihlášení k účtu $name.");
						}
				}
				else
				{
					//Displaying error message
					echo "<div id='loginError'>Uživatel s tímto jménem neexistuje.</div>";
				}
			}
			mysqli_close($connection);
		?>
	
	</div>
</body>
