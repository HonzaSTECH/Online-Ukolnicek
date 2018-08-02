<?php
	function check($check_user = false, $check_class = false){
		if($check_user){
			if(!isset($_SESSION['user'])){
				echo "<script type='text/javascript'>location.href = 'login.php';</script>";
			}
		}
		if($check_class){
			if(!isset($_SESSION['class'])){
				echo "<script type='text/javascript'>location.href = 'home.php';</script>";
			}
		}
	}
?>