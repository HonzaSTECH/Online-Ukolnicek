<?php
	//Define the connection constatns
	@define('host', "185.64.219.6:3306");
	@define('username', "seznamtestuc3809");
	@define('password', "MgCa(CO3)2");
	@define('database', "seznamtestuc3809");
	
	//Connect to the database
	$connection = @mysqli_connect(host, username, password, database) OR die("Connection to the database failed. Error: ".mysqli_connect_error);
	
	//Setting charset of the connection
	mysqli_set_charset($connection, 'utf8') OR die("Couldn´t set the charset to utf8");
?>