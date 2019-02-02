<?php
	session_start();
	
	$action = $_COOKIE['action'];
	if ($action == 'T') //Getting translation of the confirm dialog box.
	{
		$language = $_GET['lang'];
		$langFile = "../lang/$language.php";
		include $langFile;
		echo $lang['confirmDelete'];
		die();
	}
	
	require_once('connect.php');
	
	//Get data from cookies
	$date = $_COOKIE['date'];
	$subject = $_COOKIE['subject'];
	$description = $_COOKIE['description'];
	
	//Convert the date into YYYY-MM-DD format
	$day = ""; $month = ""; $year = "";
	$date = str_split($date);
	foreach ($date as $char){
		if (!isset($i)){$i = 0;}
		if ($char == '.'){$i++; continue;}
		if($char == ' '){continue;}
		
		if($i == 0){$day .= $char;}
		if($i == 1){$month .= $char;}
		if($i == 2){$year .= $char;}
	}
	$date = $year."-".$month."-".$day;
	unset($i);
	
	//Performing a action depending on $action variable
	switch($action){
		case 'L':	//Liking a record
			//Get likers list from the database
			$query = "SELECT likers FROM records WHERE date='$date' AND subject='$subject' AND description='$description'";
			$newLikers = mysqli_query($connection, $query);
			$newLikers = mysqli_fetch_array($newLikers);
			$newLikers = $newLikers['likers'];
			
			//Get user's ID from the database
			$username = $_SESSION['user'];
			$query = "SELECT id FROM users WHERE name='$username'";
			$query = mysqli_query($connection, $query);
			$query = mysqli_fetch_array($query);
			$user = $query['id'];
			
			//Write user's ID into likers list in database
			if ($newLikers == "0"){$newLikers = $user;}
			else {$newLikers .= ",".$user;}
			
			$query = "UPDATE records SET likes = likes + 1, likers = '$newLikers' WHERE date='$date' AND subject='$subject' AND description='$description'";
			break;
		case 'E':	//Editting a record
			//Getting new values for the record from cookies
			$newDate = $_COOKIE['newDate'];
			$newSubject = $_COOKIE['newSubject'];
			$newDesc = $_COOKIE['newDescription'];
			$newPriority = $_COOKIE['newPriority'];
			
			$query = "UPDATE records SET date='$newDate',subject='$newSubject',description='$newDesc',priority='$newPriority' WHERE date='$date' AND subject='$subject' AND description='$description'";
			break;
		case 'D':	//Deleting a record
			$query = "DELETE FROM records WHERE date='$date' AND subject='$subject' AND description='$description'";
			break;
	}
	
	echo "$date<br />$subject<br />$description<br/>$action<br />$query";	//Controll output
	//Execute the query
	mysqli_query($connection, $query);
	mysqli_close($connection);
	echo "Database has been altered.";	//Cotroll output
?>