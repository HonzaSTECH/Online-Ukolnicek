<?php
	session_start();
	require 'checker.php';
	check(true);
	include 'logger.php';

	if(isset($_POST['posted'])){
		//echo "Formulář byl odeslán.<br />";
		$myemail = 'honza.stech@gmail.com';

		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$school = $_POST['school'];
		$class = $_POST['class'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$message = wordwrap($message, 70, "\r\n");
		if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i",$email))
		{
			$errors .= "\n Error: Invalid email address";
			echo "Neplatná e-mailová adresa.<br />";
		}
		else{
			$to = $myemail;
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
			//echo $name."<br />".$surname."<br />".$school."<br />".$class."<br />".$email."<br />".$message."<br /><br />";
			//echo $to."<br />".$email_subject."<br />".$email_body."<br />".$headers;
			mail($to,$email_subject,$email_body,$headers);
			$user = $_SESSION['user'];
			fileLog("Uživatel $user zažádal o založení nové třídy za třídu $class ve škole $school");
			echo "Vaše žádost o založení nové třídy byla odeslána. O přijetí nebo zamítnutí požadavku se dozvíte prostřednictvím e-mailu na Vámi zadanou e-mailovou adresu v řádu několika málo dní.";
		}
	}
?>

<meta charset="utf-8">
<link rel="shortcut icon" href="../images/marklessLogo.ico">
<link rel="stylesheet" href="../styles/newClass.css">
<p>Zažádat o založení nové třídy</p>
<p>Z důvodu zamezení zakládání nepotřebných a prázdných tříd a zaplňování omezeného místa v naší databázi je nutné k založení třídy vyplnit tento formulář.</p><br />

<form action="newClass.php" method="POST">
    <input type=text name="name" placeholder="Jméno" required><br />
    <input type=text name="surname" placeholder="Přijímení" required><br />
    <input type=text name="school" placeholder="Škola" required><br />
    <input type=text name="class" placeholder="Třída" required><br />
    <input type=email name="email" placeholder="E-mail" required><br />
    <textarea type="message" name="message" placeholder="Text žádosti" required id="text"></textarea><br /><br />
    <input type=submit name="posted" value="Odeslat žádost"><br />
</form>

<a href="home.php">Návrat na seznam tříd</a>