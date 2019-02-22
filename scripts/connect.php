<?php
	//Define the connection constatns
	@define('host', "localhost");
	@define('username', "u203826608_admin");
	@define('password', "DsTvgBt6UCovLkTp");
	@define('database', "u203826608_exams");
	
	//Connect to the database
	$connection = @mysqli_connect(host, username, password, database) OR die("Connection to the database failed. Error: ".mysqli_connect_error);
	
	//Setting charset of the connection
	mysqli_set_charset($connection, 'utf8') OR die("Couldn´t set the charset to utf8");
?>