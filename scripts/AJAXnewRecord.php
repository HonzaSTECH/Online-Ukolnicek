<?php
	session_start();
	require_once('connect.php');
	include 'logger.php';
	
	$a = $_COOKIE['date'];
	$b = $_COOKIE['subject'];
	$c = $_COOKIE['description'];
	$d = $_SESSION['user'];
	$e = $_COOKIE['priority'];
	
	$classId = $_SESSION['class'];

	$query = "INSERT INTO records (date, subject, description, author, dateOfAdding, priority, class) values ('$a', '$b', '$c', '$d', NOW(), '$e', '$classId')";
	$result = mysqli_query($connection, $query);
	if ($result)
	{
		$user = $_SESSION['user'];
		$query = "SELECT name FROM classes WHERE id='$classId'";
		$result = mysqli_query($connection, $query);
		$result = mysqli_fetch_array($result);
		$name = $result['name'];
		fileLog("Uživatel $user přidal ve třídě $name záznam: $a - $b - $c - $e. priorita");
	}
	else
	{
		echo "An error occured: ".mysqli_error($connection);
		mysqli_close($connection);
        }
?>