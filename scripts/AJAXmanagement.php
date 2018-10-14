<?php
	require_once('connect.php');
	include 'logger.php';
	
	//Getting data from cookies
	$nickname = $_COOKIE['nickname'];
	$message = urldecode($_COOKIE['message']);
	$class = $_COOKIE['class'];
	$admin = $_COOKIE['admin'];
	$action = $_COOKIE['action'];
	
	//Perform a action depending on $action value
	switch($action){
		case 'a':	//Accepting the application
			//Updating users's memberIn list in the database
			$query = "SELECT memberIn FROM users WHERE name='$nickname'";
			$result = mysqli_query($connection, $query);
			if(!$result){echo mysqli_error($connection);}
			else{
				$result = mysqli_fetch_array($result);
				$result = $result['memberIn'];
				if($result == "0"){$result = $class;}
				else{$result .= (','.$class);}
				$query = "UPDATE users SET memberIn = $result WHERE name='$nickname'";
			}
			unset($result);
			$result = mysqli_query($connection, $query);
			
			//Check for errors
			if(!$result){echo mysqli_error($connection);}
			unset($result);
			
			//Logging the accpetence
			$query = "SELECT name FROM classes WHERE id=$class";
			$result = mysqli_query($connection, $query);
			$result = mysqli_fetch_array($result);
			$result = $result['name'];
			filelog("Uživatel $nickname byl přijat do třídy $result uživatelem $admin.");
			break;
		case 'd':	//Declining the application
			//Logging the declinence
			$query = "SELECT name FROM classes WHERE id=$class";
			$result = mysqli_query($connection, $query);
			$result = mysqli_fetch_array($result);
			$result = $result['name'];
			filelog("Žádost uživatel $nickname o přijetí do třídy $claaa byla zamítnuta uživatelem $admin.");
			break;
	}
	
	echo "$nickname\n$message\n$class\n$action\n$admin";	//Controll outputs
	echo "\n $message";

	//Remove answered application from the database
	$query = "DELETE FROM applications WHERE nickname='$nickname' AND message='$message' AND class='$class'";
	
	echo "\n";
	echo $query;
	mysqli_query($connection, $query);
	
	//Check for errors
	if(!$result){echo mysqli_error($connection);}
	mysqli_close($connection);
	echo "Database has been altered.";	//Controll output
?>