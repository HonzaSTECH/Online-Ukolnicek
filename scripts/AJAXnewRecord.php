<?php
    require_once('connect.php');
	include 'logger.php';
	
	if(isset($_POST['send'])){
	
		$a = $_POST['date'];
		$b = $_POST['subject'];
		$c = $_POST['description'];
		$d = $_SESSION['user'];
		$e = $_POST['priority'];
	/*
		echo $a."<br />";
		echo $b."<br />";
		echo $c."<br />";
		echo $d."<br />";
		echo $e."<br />";
	*/	
		$query = "INSERT INTO records (date, subject, description, author, dateOfAdding, priority, class) values ('$a', '$b', '$c', '$d', NOW(), '$e', '$classId')";
		$result = mysqli_query($connection, $query);
		if ($result){
			/*echo "
				<script>
					document.getElementsByClassName('action1')[recordCount].onclick = upvoteRecord;
					document.getElementsByClassName('action2')[recordCount].onclick = editRecord;
					document.getElementsByClassName('action3')[recordCount].onclick = removeRecord;
				</script>";
			*/
				$user = $_SESSION['user'];
				fileLog("Uživatel $user přidal ve třídě $name záznam: $a - $b - $c - $e. priorita");
				//echo "<script type='text/javascript'>location.href = 'list.php';</script>";
		}
		else{
            echo "An error occured: ".mysqli_error($connection);
            mysqli_close($connection);
        }
	}
    else{mysqli_close($connection);}
?>