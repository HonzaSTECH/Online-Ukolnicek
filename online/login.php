<?php session_start(); ?>
<meta charset="utf-8">
<form method="POST" action="login.php">
	<input type="text" name="username" placeholder="Jméno" required><br />
	<input type="password" name="password" placeholder="Heslo" required><br />
	<input type="submit" name="send" value="Přihlásit se">
</form>
<?php
	require_once("connect.php");
	if(isset($_POST['send'])){
		$name = $_POST['username'];
		$pass = $_POST['password'];
		
		$query = "SELECT password FROM users WHERE name='$name'";
		$result = mysqli_query($connection, $query);
		if($result){
			$data = mysqli_fetch_array($result);
			if($data['password'] == $pass){
				echo "Byl/a jsi úspěšně přihlášen/a.";
				$_SESSION['user']=$name;
				echo "<script type='text/javascript'>location.href = 'home.php';</script>";
			}
			else{echo "Špatné heslo";}
		}
		else{echo "Uživatel s tímto jménem neexistuje.";}
	}
	mysqli_close($connection);

?>
<p>Ještě nemáš účet? Zaregistruj se <a href="register.php"><u>zde</u></a>.</p>