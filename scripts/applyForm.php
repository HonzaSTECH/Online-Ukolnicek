<?php
	session_start();
	require 'checker.php';
	check(true);
?>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../images/marklessLogo.ico">
	<link rel="stylesheet" href="../styles/applyForm.css">
</head>
<body>
	<p>Administrátor nebo moderátoři této třídy musí potvrdit tvou žádost o vstup do této třídy. Dej jim tedy vědět, kdo skutečně jsi, ať vědí, koho mezi sebe přijímají.</p>
	<form action="applyForm.php" method="POST"><br />
		<input type=text name="name" placeholder="Jméno" required><br />
		<input type=text name="surname" placeholder="Přijímění" required><br />
		<textarea type="message" name="message" placeholder="Dodatečné informace" id="text"></textarea><br /><br />
		<input type=submit name="posted" value="Odeslat žádost"><br />
	</form>

	<?php
		require_once("connect.php");
		include 'logger.php';

		if(isset($_POST['posted'])){
			
			//Getting ID of the class
			$class = $_SESSION['applyClass'];
			$query = "SELECT id FROM classes WHERE name='$class'";
			$result = mysqli_query($connection, $query);
			$result = mysqli_fetch_array($result);
			$class = $result['id'];
			unset($_SESSION['applyClass']);
			
			//Getting e-mail of the admin of the class
			$query = "SELECT admin FROM classes WHERE name='$class'";
			$result = mysqli_query($connection, $query);
			if (!$result){echo "An error occured. Error: ".mysqli_error();}
			$admin = mysqli_fetch_array($result);
			$admin = $admin['admin'];
			$query = "SELECT email FROM users WHERE name='$admin'";
			$result = mysqli_query($connection, $query);
			if (!$result){echo "An error occured. Error: ".mysqli_error();}
			$email = mysqli_fetch_array($result);
			$email = $email['email'];

			//Getting application details
			$user = $_SESSION['user'];
			$name = $_POST['name'];
			$surname = $_POST['surname'];
			$message = $_POST['message'];
			
			//Replacing linebreaks with <br>
			$message = str_replace(array("\r\n"), '<br>', $message);
			
			//Writing the application into the database
			$timestamp = time();
			$query = "INSERT INTO applications (nickname, name, surname, message, class, age) VALUES ('$user', '$name', '$surname', '$message', '$class', '$timestamp')";
			$result = mysqli_query($connection, $query);
			
			//Checking for error
			if(!$result){echo "An Error occured. Error: ".mysqli_error($connection);}
			
			//Building e-mail for the admin
			$message = wordwrap($message, 70, "\r\n");
			
			$email_subject = "Žádost o přijetí to třídy od: $name $surname";
			//Building e-mail body
			$email_body = "Detaily žádosti:".
			"\nJméno: $name".
			"\nPřijímení: $surname".
			"\nText žádosti (nemuselo být vyplněno):".
			"\n$message".
			"\n\n".
			"\nŽádost můžete přijmout nebo zamítnout na stránce se seznamem testů.".
			"\nTuto Žadost schvalte pouze v případě, že jste si jistí kdo tento uživatel ve skutečnosti je.".
			"\nTento e-mail byl vygenerován automaticky a tudíž na něj neodpovídejte.".
			$headers = "From: info@seznamtestu.chytrak.cz\n";
			
			//Sending e-mail to the admin of the class
			mail($email,$email_subject,$email_body,$headers);
			
			//Logging the application
			$user = $_SESSION['user'];
			fileLog("Uživatel $user zažádal o přijetí do třídy $class");
			
			//Redirecting to the home page
			echo "<script>alert('Vaše žádost o přijetí do této třídy byla odeslána. O přijetí nebo zamítnutí požadavku se dozvíte na stránce se seznamem tříd.');</script>";
			echo "<script type='text/javascript'>location.href = 'home.php';</script>";
		}
	?>
	<a href="apply.php">Návrat na seznam tříd</a>
<<<<<<< HEAD
</body>
=======
</body>
>>>>>>> 0986e609d528b2717f7fa4ef089600cd68b057b9
