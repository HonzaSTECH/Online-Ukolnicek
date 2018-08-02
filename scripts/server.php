<meta charset="utf-8">
<?php
    require_once("connect.php");
	if(isset($_GET["send"])){
		$data = $_GET["data"];
		echo "Data: ".$data."<br />";				//
		if(empty($data)){
			echo "<fieldset>You have to fill the text field.</fieldset>";
		}
		else{
			$sql = "INSERT INTO testTable (data) values ('$data')";
			echo "Query: ".$sql."<br />";
			$result = mysqli_query($connection, $sql);
			if($result){
				echo "<br /><fieldset>New record created succefully</fieldset>";
			}
			else{
				echo "Error: ".$sql."<br />";
				echo mysqli_error($connection);
				mysqli_close($connection);
			}
		}
	}
?>

<a href="view.php">View database</a>
<br />
<!--<a href="index.html">Back to main page</a>
<br />-->
<a href="tests.php">Second testing page</a>
<br />
<form method="GET" action=server.php>
    <input type="text" name="data" id="text"><br /><br />
    <input type="submit" name="send" id="send" value="Submit">
</form>

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