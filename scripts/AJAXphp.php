<?php
	require_once('connect.php');
	
	$date = $_COOKIE['date'];
	$subject = $_COOKIE['subject'];
	$description = $_COOKIE['description'];
	$action = $_COOKIE['action'];
	
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
	
	switch($action){
		case 'L':
			$query = "UPDATE records SET likes = likes + 1 WHERE date='$date' AND subject='$subject' AND description='$description'";
			break;
		case 'E':
			$query = "";
			break;
		case 'D':
			$query = "DELETE FROM records WHERE date='$date' AND subject='$subject' AND description='$description'";
			break;
	}
	
	echo "$date<br />$subject<br />$description<br/>$action<br />$query";
	mysqli_query($connection, $query);
	mysqli_close($connection);
	echo "Database has been altered.";
?>