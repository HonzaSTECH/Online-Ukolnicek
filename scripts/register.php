<?php
	session_start(); 
	unset($_SESSION['class']);
	unset($_SESSION['user']);
?>
<meta charset="utf-8">
<link rel="stylesheet" href="../styles/register.css">
<form method="POST" action="register.php">
	<input type="text" name="username" placeholder="Jméno" required><br />
	<input type="password" name="password" placeholder="Heslo" required><br />
	<input type="password" name="password_repeat" placeholder="Heslo znovu" required><br />
	<input type="email" name="email" placeholder="E-mail" required><br />
	<input type="checkbox" name="accept">Souhlasím se spracováním zadaných údajů pro účely této služby<br />
	<input type="submit" name="send" value="Zaregistrovat se">
</form>
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
						else{echo "Nastala chyba. Zkuste to později, nebo kontaktujte administrátora na emailu honza.stech@gmail.com.<br />";echo mysqli_error($connection);}
					}
					else{echo "Uživatel s tímto e-mailem již existuje.";}
				}
				else{echo "Hesla se neschodují.";}
			}
			else{echo "Uživatel s tímto jménem již existuje.";}
		}
		else{echo "Musíš udělit souhlas se spracováním zadaných údajů.";}
	}
	mysqli_close($connection);
?>
<p>Jsi již zaregistrován? Přihlaš se <a href="login.php"><u>zde</u></a>.</p>