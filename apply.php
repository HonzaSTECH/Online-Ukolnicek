<?php session_start() ?>
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
</style>
<p>Seznam tříd:</p>

<?php
	require_once("connect.php");
	
	$query = "SELECT * FROM classes";
	$result = mysqli_query($connection, $query);
	
	echo "<form action='applyForm.php'><table>";
	while($row = mysqli_fetch_array($result)){
		$name = $row['name'];
		echo "<tr><td align='center' class='td1'><input type=radio name=applyTo></td><td align='center' class='td2'>$name</td></tr>";
	}
	echo "</table><input type=submit name='apply' value='Zažádat o přijetí'></form>"
?>

<a href="home.php">Návrat na seznam tříd</a>