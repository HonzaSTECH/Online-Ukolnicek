<?php session_start(); ?>
<meta charset="utf-8">
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
		echo "<form action='list.php' method='GET'>";
		foreach ($classes as $class){
			echo "<input type=radio name='classSelect' value='$class'>' $class'<br />";
		}
		echo "<input type=submit value='Vstoupit'></form><br />";
	}
	else{
		echo "Nejsi členem žádné třídy.<br />";
	}
	mysqli_close($connection);
?>

<a href="apply.php">Zažádat o přijetí do existující třídy</a><br />
<a href="newClass.php">Založit novou třídu</a><br />