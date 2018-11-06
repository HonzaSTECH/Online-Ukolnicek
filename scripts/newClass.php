<?php	session_start();		?>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../images/transparentMarklessLogo.ico">
	<link rel="stylesheet" href="../styles/newClass.css">
</head>
<body>
	<div id="header">
		<span id="username">
			<?php
			echo "Jsi přihlášen jako ";
			echo $_SESSION['user'];
			?>
		</span>
		<a href="login.php">
			<div id="logoutBox">
				<span id="logoutLink">Odhlásit se</span>
			</div>
		</a>
		<a href="info.php">
			<div id="infoBox">
				<span id="infoLink">Informace</span>
			</div>
		</a>
		<a href="home.php">
			<div id="homeBox">
				<span id="homeLink">Domů</span>
			</div>
		</a>
	</div>
	<div id="container">
		<div id="infoText">
			<h2>Zažádat o založení nové třídy</h2>
			<span id=subtext>
				Z důvodu zamezení zakládání nepotřebných a prázdných tříd a zaplňování omezeného místa v naší databázi je nutné k založení třídy vyplnit tento formulář.<br />
				Další komunikace bude probíhat prostřednictvím e-mailu, proto se prosím ujistěte, že jste zadali správnou e-mailovou adresu.<br />
				Založení třídy je stejně jako všechny ostatní funkce bezplatné.
			</span>
		</div>
		<form action="newClass.php" method="POST">
			<fieldset>
				<input type=text name="name" placeholder="Jméno" id="name" required>
				<input type=text name="surname" placeholder="Přijímení" id="surname" required>
				<input type=text name="school" placeholder="Škola" id="school" required>
				<input type=text name="class" placeholder="Třída" id="class" required>
				<input type=email name="email" placeholder="E-mail" id="email" required>
				<textarea type="message" name="message" placeholder="Text žádosti"  id="text" required></textarea>
				<input type=submit name="posted" value="Odeslat žádost" id="submitButton">
			</fieldset>
		</form>
	</div>
</body>

	<?php
		require 'checker.php';
		check(true);
		include 'logger.php';
		
		//Handling form submit
		if(isset($_POST['posted'])){ 
			define('myemail', 'honza.stech@gmail.com');
			
			//Getting submission details
			$name = $_POST['name'];
			$surname = $_POST['surname'];
			$school = $_POST['school'];
			$class = $_POST['class'];
			$email = $_POST['email'];
			$message = $_POST['message'];
			
			//Wrapping the message
			$message = wordwrap($message, 70, "\r\n");
			
			//Checking for valid e-mail
			if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i",$email))
			{
				$errors .= "\n Error: Invalid email address";
				echo "Neplatná e-mailová adresa.<br />";
			}
			else
			{
				//Building the email
				$email_subject = "Žádost o založení třídy od: $name $surname";
				$email_body = "Detaily žádosti:".
				"\n Jméno: $name".
				"\n Přijímení: $surname".
				"\n Škola: $school".
				"\n Třída: $class".
				"\n E-mail: $email".
				"\n Text žádosti: $message";
				$headers = "From: $email\n";
				$headers .= "Reply-To: '$email'";
				
				//Sending the e-mail
				mail(myemail,$email_subject,$email_body,$headers);
				
				//Logging the submission
				$user = $_SESSION['user'];
				fileLog("Uživatel $user zažádal o založení nové třídy za třídu $class ve škole $school");
				
				//Redirecting
				echo "<script>alert('Vaše žádost o založení nové třídy byla odeslána. O přijetí nebo zamítnutí požadavku se dozvíte prostřednictvím e-mailu na Vámi zadanou e-mailovou adresu v řádu několika málo dní.');</script>";
				echo "<script type='text/javascript'>location.href = 'home.php';</script>";
			}
		}
	?>