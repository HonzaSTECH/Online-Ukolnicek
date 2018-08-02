<?php
	session_start();

	if(isset($_POST['login'])){
		$class = $_POST['classSelect'];
		$_SESSION['class'] = $class;
		
		echo "<script type='text/javascript'>location.href = 'list.php';</script>";
	}
?>