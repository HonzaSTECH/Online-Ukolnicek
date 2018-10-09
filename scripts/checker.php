<?php
	function check($check_user = false, $check_class = false, $check_admin = false)
	{
		if($check_user)		//Checking for logged user
		{
			if(!isset($_SESSION['user']))
			{
				echo "<script type='text/javascript'>location.href = 'login.php';</script>";
			}
		}
		if($check_class)		//Checking for entered class
		{
			if(!isset($_SESSION['class']))
			{
				echo "<script type='text/javascript'>location.href = 'home.php';</script>";
			}
		}
		if($check_admin)	//Checking for being admin of the entered class
		{
			//Getting admin of the entered class
			require_once 'connect.php';
			$classId = $_SESSION['class'];
			$query = "SELECT admin FROM classes WHERE id='$classId'";
			$result = mysqli_query($connection, $query);
			$result = mysqli_fetch_array($result);
			$result = $result['admin'];	
			
			$username = $_SESSION['user'];
			
			//Comparing admin name with logged user's name
			if($username != $result)
			{
				echo "<script type='text/javascript'>location.href = 'list.php';</script>";
			}
		}
	}
?>