<?php
	session_start();
	require 'checker.php';
	check(true);
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
</style>
<p>Seznam tříd:</p>

<?php
	require_once("connect.php");
	
	$user = $_SESSION['user'];
	$query = "SELECT memberIn FROM users WHERE name='$user'";
	$result = mysqli_query($connection, $query);
	$alreadyMemberIn = mysqli_fetch_array($result);
	$alreadyMemberIn = $alreadyMemberIn['memberIn'];
	if(!$alreadyMemberIn == 0){$alreadyMemberIn = explode(',',$alreadyMemberIn);}
	
	$count = count($alreadyMemberIn);
	$query = "SELECT * FROM classes WHERE id NOT IN (";
	foreach($alreadyMemberIn as $class){
		$count--;
		$query .= $class;
		if($count > 0){$query .= ", ";}
		else{$query .= ");";}
	}
	
	$result = mysqli_query($connection, $query);

	echo "<form action='applyForm.php'><table>";
	while($row = mysqli_fetch_array($result)){
		$name = $row['name'];
		echo "<tr><td align='center' class='td1'><input type=radio name=applyTo></td><td align='center' class='td2'>$name</td></tr>";
	}
	echo "</table><input type=submit name='apply' value='Zažádat o přijetí'></form>"
?>

<a href="home.php">Návrat na seznam tříd</a>