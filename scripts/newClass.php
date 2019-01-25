<?php
	session_start();
	include 'languageHandler.php';
?>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../images/transparentMarklessLogo.ico">
	<link rel="stylesheet" href="../styles/newClass.css">
</head>
<body>
	<div id="header">
		<span id="username">
			<?php
			echo $lang['headerText'];
			echo $_SESSION['user'];
			?>
		</span>
		<a href="login.php<?php echo $urlExtension; ?>">
			<div id="logoutBox">
				<span id="logoutLink"><?php echo $lang['logOut']; ?></span>
			</div>
		</a>
		<a href="info.php<?php echo $urlExtension; ?>">
			<div id="infoBox">
				<span id="infoLink"><?php echo $lang['info']; ?></span>
			</div>
		</a>
		<a href="home.php<?php echo $urlExtension; ?>">
			<div id="homeBox">
				<span id="homeLink"><?php echo $lang['home']; ?></span>
			</div>
		</a>
	</div>
	<div id="container">
		<div id="infoText">
			<h2><?php echo $lang['newClassHeader']; ?></h2>
			<span id=subtext>
				<?php echo $lang['newClassLore1']; ?><br />
				<?php echo $lang['newClassLore2']; ?><br />
				<?php echo $lang['newClassLore3']; ?>
			</span>
		</div>
		<form action="newClass.php<?php echo $urlExtension; ?>" method="POST">
			<fieldset>
				<input type=text name="name" placeholder="<?php echo $lang['fName']; ?>" id="name" required>
				<input type=text name="surname" placeholder="<?php echo $lang['lName']; ?>" id="surname" required>
				<input type=text name="school" placeholder="<?php echo $lang['school']; ?>" id="school" required>
				<input type=text name="class" placeholder="<?php echo $lang['class']; ?>" id="class" required>
				<input type=email name="email" placeholder="<?php echo $lang['e-mail']; ?>" id="email" required>
				<textarea type="message" name="message" placeholder="<?php echo $lang['newClassPlaceholder']; ?>"  id="text" required></textarea>
				<input type=submit name="posted" value="<?php echo $lang['applicationSend']; ?>" id="submitButton">
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
			nl2br($message);
			//str_replace('<br />', PHP_EOL, $message);
			$message = wordwrap($message, 70, "<br />");
			
			//Checking for valid e-mail
			if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i",$email))
			{
				$errors .= "\n Error: Invalid email address";
				echo "Invalid e-mail address.<br />";
			}
			else
			{
				//Building the email
				$email_subject = "Žádost o založení třídy od: $name $surname";
				$email_body = "Detaily žádosti:".
				"<br />First name: $name".
				"<br />Last name: $surname".
				"<br />School: $school".
				"<br />Class: $class".
				"<br />E-mail: $email".
				"<br />Content of the application:".
				"<br />$message";
				//$headers = "From: $email\n";
				//$headers .= "Reply-To: '$email'";
				
				//Sending the e-mail
				//mail(myemail,$email_subject,$email_body,$headers);
				require_once('mailer.php');
				sendEmail(myemail,$email_subject,$email_body);
				
				//Logging the submission
				$user = $_SESSION['user'];
				fileLog("Uživatel $user zažádal o založení nové třídy za třídu $class ve škole $school");
				
				//Redirecting
				echo "<script>alert('".$lang['newClassAlertText']."');</script>";
				echo "<script type='text/javascript'>location.href = 'home.php".$urlExtension."';</script>";
			}
		}
	?>
