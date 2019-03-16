<?php
	session_start();
	require_once('connect.php');
	include 'logger.php';
	
	//Getting data from cookies
	$a = $_COOKIE['date'];
	$b = $_COOKIE['subject'];
	$c = $_COOKIE['description'];
	$d = $_SESSION['user'];
	
	$classId = $_SESSION['class'];
	
	//Inserting new record into the database
	$query = "INSERT INTO records (date, subject, description, author, dateOfAdding, class) values ('$a', '$b', '$c', '$d', NOW(), '$classId')";
	$result = mysqli_query($connection, $query);
	
	//Checking for errors
	if ($result)
	{
		//Logging the new record
		$user = $_SESSION['user'];
		$query = "SELECT name FROM classes WHERE id='$classId'";
		$result = mysqli_query($connection, $query);
		$result = mysqli_fetch_array($result);
		$name = $result['name'];
		fileLog("Uživatel $user přidal ve třídě $name záznam: $a - $b - $c.");
	}
	else
	{
		//filelog(mysqli_error($connection));
		echo "An error occured: ".mysqli_error($connection);
		mysqli_close($connection);
        }
?>