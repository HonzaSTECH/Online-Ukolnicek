<?php
	session_start();

	if(isset($_POST['login'])){
		//Getting class from the form on the home page
		$class = $_POST['classSelect'];
		
		//Saving the class's id into session superglobal
		$_SESSION['class'] = $class;
		
		//Redirecting
		echo "<script type='text/javascript'>location.href = 'list.php';</script>";
	}
?>