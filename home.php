<?php session_start(); ?>
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
<p>Jsi členem v těchto třídách:</p>

<?php
	require_once("connect.php");
	
	$user = $_SESSION['user'];
	$query = "SELECT memberIn FROM users WHERE name='$user'";
	$result = mysqli_query($connection, $query);
	
	$data = mysqli_fetch_array($result);
	$data = $data['memberIn'];
	
	if(!$data == '0'){
		$classes = explode('0', $data);
		echo "<form action='list.php' method='GET'><table>";
		foreach ($classes as $class){
			$result = mysqli_query($connection, "SELECT * FROM classes WHERE id='$class'");
			$classData = mysqli_fetch_array($result);
			$classAdmin = $classData['admin'];
			$classData = $classData['name'];
			$classAdmin = ($classAdmin == $user);
			echo "<tr><td align='center' class='td1'><input type=radio name='classSelect' value='$class'></td><td align='center' class='td2'> $classData</td><td align='center' class='td3'>";
			if($classAdmin){echo "Administrátor";}
			else{echo "Člen";}
			echo "</td></tr>";
		}
		echo "</table><input type=submit value='Vstoupit'></form>";
	}
	else{
		echo "Nejsi členem žádné třídy.<br />";
	}
	mysqli_close($connection);
?>

<a href="apply.php">Zažádat o přijetí do existující třídy</a><br />
<a href="newClass.php">Založit novou třídu</a><br />