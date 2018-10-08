<?php
	function check($check_user = false, $check_class = false, $check_admin = false){
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
		if($check_admin){
			require_once 'connect.php';
			$classId = $_SESSION['class'];
			$username = $_SESSION['user'];
			$query = "SELECT admin FROM classes WHERE id='$classId'";
			$result = mysqli_query($connection, $query);
			$result = mysqli_fetch_array($result);
			$result = $result['admin'];	
			if($username != $result)
			{
				echo "<script type='text/javascript'>location.href = 'list.php';</script>";
			}
		}
	}
?>