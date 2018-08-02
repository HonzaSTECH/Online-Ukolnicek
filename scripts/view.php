<?php
    require_once("connect.php");
	
	$query = "SELECT id, data FROM testTable";
	$records = mysqli_query($connection, $query);
	
	if($records){
		echo "<table align='left'><tr><td align='center'><b>ID</b></td><td align='center'><b>DATA</b></td></tr>";
		
		while($row = mysqli_fetch_array($records)){
			echo "<tr><td align='center'>".$row['id']."</td><td align='center'>".$row['data']."</td></tr>";
		}
	}
	else{
		echo "An error occured while trying to get data from the database: ".mysqli_error($connection);
		mysqli_close($connection);
	}
?>
<meta charset="UTF-8">
<a href="server.php">Back to the form</a>
<br /><br />
<b><u>Database content:</u></b>
<br />