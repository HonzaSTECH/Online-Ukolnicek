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
			echo "You are logged in as ";
			echo $_SESSION['user'];
			?>
		</span>
		<a href="login.php">
			<div id="logoutBox">
				<span id="logoutLink">Log out</span>
			</div>
		</a>
		<a href="info.php">
			<div id="infoBox">
				<span id="infoLink">Information</span>
			</div>
		</a>
		<a href="home.php">
			<div id="homeBox">
				<span id="homeLink">Home</span>
			</div>
		</a>
	</div>
	<div id="container">
		<div id="infoText">
			<h2>Apply for creation of a new class</h2>
			<span id=subtext>
				To avoid creating unnecessary and empty classes and filling a limited space in our database, you need to fill out this form to create a class.<br />
				Further communication will occure via e-mail, so please make sure that you have entered the correct e-mail address.<br />
				Creating a class is free just as any other feature.
			</span>
		</div>
		<form action="newClass.php" method="POST">
			<fieldset>
				<input type=text name="name" placeholder="First name" id="name" required>
				<input type=text name="surname" placeholder="Last name" id="surname" required>
				<input type=text name="school" placeholder="School" id="school" required>
				<input type=text name="class" placeholder="Class" id="class" required>
				<input type=email name="email" placeholder="E-mail" id="email" required>
				<textarea type="message" name="message" placeholder="Content of the application"  id="text" required></textarea>
				<input type=submit name="posted" value="Send the application" id="submitButton">
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
				echo "Invalid e-mail address.<br />";
			}
			else
			{
				//Building the email
				$email_subject = "Žádost o založení třídy od: $name $surname";
				$email_body = "Detaily žádosti:".
				"\n First name: $name".
				"\n Last name: $surname".
				"\n School: $school".
				"\n Class: $class".
				"\n E-mail: $email".
				"\n Content of the application:".
				"\n $message";
				$headers = "From: $email\n";
				$headers .= "Reply-To: '$email'";
				
				//Sending the e-mail
				mail(myemail,$email_subject,$email_body,$headers);
				
				//Logging the submission
				$user = $_SESSION['user'];
				fileLog("Uživatel $user zažádal o založení nové třídy za třídu $class ve škole $school");
				
				//Redirecting
				echo "<script>alert('Your application for creation of a new class was send. You will be contacted by webmaster on the e-mail address you specified.');</script>";
				echo "<script type='text/javascript'>location.href = 'home.php';</script>";
			}
		}
	?>
