<?php
	session_start(); 
	require 'checker.php';
	check(true);
	unset($_SESSION['class']);
?>
<meta charset="utf-8">
<style>
	.td1{
		width: 20px;
		height: 20px;
	}
	.td2{
		width: 100px;
		height: 20px;
	}
	.td3{
		width: 75px;
		height: 20px;
	}
</style>
<a href="login.php">Odhlásit se</a>
<p>Jsi členem v těchto třídách:</p>

<?php
	require_once("connect.php");
	
	$user = $_SESSION['user'];
	$query = "SELECT memberIn FROM users WHERE name='$user'";
	$result = mysqli_query($connection, $query);
	
	$data = mysqli_fetch_array($result);
	$data = $data['memberIn'];
	
	if(!$data == '0'){
		$classes = explode(',', $data);
		echo "<form action='classLogin.php' method='POST'><table>";
		foreach ($classes as $class){
			$result = mysqli_query($connection, "SELECT * FROM classes WHERE id='$class'");
			$classData = mysqli_fetch_array($result);
			$classData = $classData['name'];
			
			$result = mysqli_query($connection, "SELECT modIn FROM users WHERE name='$user'");
			$data = mysqli_fetch_array($result);
			$data = $data['modIn'];
			if(!$data == '0'){$modClasses = explode(',', $data);}
			
			$result = mysqli_query($connection, "SELECT adminIn FROM users WHERE name='$user'");
			$data = mysqli_fetch_array($result);
			$data = $data['adminIn'];
			if(!$data == '0'){$adminClasses = explode(',', $data);}
			
			echo "<tr><td align='center' class='td1'><input type=radio name='classSelect' value='$class'></td><td align='center' class='td2'> $classData</td><td align='center' class='td3'>";
			if(in_array($class, $adminClasses)){echo "Administrátor";}
			else if(in_array($class, $modClasses)){echo "Moderátor";}
			else{echo "Člen";}
			echo "</td></tr>";
		}
		echo "</table><input type=submit value='Vstoupit' name='login'></form>";
	}
	else{
		echo "Nejsi členem žádné třídy.<br />";
	}
	mysqli_close($connection);
?>

<a href="apply.php">Zažádat o přijetí do existující třídy</a><br />
<a href="newClass.php">Založit novou třídu</a><br />