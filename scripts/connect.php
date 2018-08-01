<?php
	define('host', "185.64.219.6:3306");
	define('username', "seznamtestuc3809");
	define('password', "hidden");
	define('database', "seznamtestuc3809");
	$data = "";
	$result = "";
	
	//Connect to the database
	$connection = @mysqli_connect(host, username, password, database) OR die("Connection to the database failed. Error: ".mysqli_connect_error);
        //echo "Succefully connected to SQL database.<br />";
	mysqli_set_charset($connection, 'utf8') OR die("Couldn´t set the charset to utf8");
        //echo "Succefully set charset to uth8mb4<br />";
?>