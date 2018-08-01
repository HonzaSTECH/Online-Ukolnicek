<?php
	session_start();
	require 'checker.php';
	check(true, true);
?>
<meta charset="utf-8">
<?php
	require_once('connect.php');
	$query = "SELECT * FROM applications ORDER BY age";
	$result = mysqli_query($connection, $query);
	mysqli_close($connection);
	
	echo "<table border=1>";
	while($data = mysqli_fetch_array($result)){
		$exists = true;
		$a = $data['nickname'];
		$b = $data['name'];
		$c = $data['surname'];
		$d = $data['message'];
		echo "<tr><td align='center'>$a</td><td align='center'>$b</td><td align='center'>$c</td><td align='center'>$d</td><td><button>Přijmout</button><br /><button>Odmítnout</button></td></tr>";
	}
	if(!isset($exists)){echo "<tr><td aling='center' style='width: 100%;'>Žádné žádosti o přijetí</td></tr>";}
	echo "</table>";
?>