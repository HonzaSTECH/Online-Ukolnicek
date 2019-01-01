<?php
	session_start(); 
	unset($_SESSION['class']);
	unset($_SESSION['user']);
	include 'languageHandler.php';
?>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../images/transparentMarklessLogo.ico">
	<link rel="stylesheet" href="../styles/login.css">
</head>
<body>
        <div id="loginBox">
		<div id="header"><?php echo $lang['logIn']; ?></div>
		<form method="POST" action="login.php<?php echo $urlExtension; ?>" id="loginForm">
			<fieldset>
				<input type=text name="username" placeholder="<?php echo $lang['name']; ?>" id="usernameInput" required>
				<br />
				<input type=password name="password" placeholder="<?php echo $lang['pass']; ?>" id="passwordInput" required>
				<br />
				<input type=submit name="send" value="<?php echo $lang['logIn']; ?>" id="submitButton">
			</fieldset>
		</form>
		<div id="registerLink"><?php echo $lang['newAccountText'] ?><a href="register.php<?php echo $urlExtension; ?>"><u><?php echo $lang['hereLink']; ?></u></a>.</div>
		
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
						echo "<div id='successMessage'>".$lang['successfulLogin']."</div>";
						
						//Saving user's name into superglobal
						$_SESSION['user']=$name;
						
						//Logging the signing in from a IP adress
						$ip = $_SERVER['REMOTE_ADDR'];
						fileLog("Uživatel $name se přihlásil z IP adresy $ip.");
						
						//Redirecting
						echo "<script type='text/javascript'>location.href = 'home.php';</script>";
					}
					else
					{
						//Displaying error message
						echo "<div id='loginError'>".$lang['passFailLogin']."</div>";
						
						//Logging the attempt
						$ip = $_SERVER['REMOTE_ADDR'];
						fileLog("Z adresy $ip proběhl pokus o přihlášení k účtu $name.");
					}
				}
				else
				{
					//Displaying error message
					echo "<div id='loginError'>".$lang['nameFailLogin']."</div>";
				}
			}
			mysqli_close($connection);
		?>
	
	</div>
</body>
