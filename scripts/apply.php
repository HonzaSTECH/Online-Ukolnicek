<?php
	session_start();
	require 'checker.php';
	check(true);
?>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../images/transparentMarklessLogo.ico">
	<link rel="stylesheet" href="../styles/apply.css">
</head>
<body>
	<p>Seznam tříd:</p>
	
	<!-- Getting and writing classes the user isn't member in -->
	<?php
		require_once("connect.php");
		
		$user = $_SESSION['user'];
		$query = "SELECT memberIn FROM users WHERE name='$user'";
		$result = mysqli_query($connection, $query);
		$alreadyMemberIn = mysqli_fetch_array($result);
		$alreadyMemberIn = $alreadyMemberIn['memberIn'];
		if(!$alreadyMemberIn == 0){$alreadyMemberIn = explode(',',$alreadyMemberIn);}
		else{$alreadyMemberIn = array(0);}
		$count = count($alreadyMemberIn);
		$query = "SELECT * FROM classes WHERE id NOT IN (";
		foreach($alreadyMemberIn as $class)
		{
			$count--;
			$query .= $class;
			if($count > 0){$query .= ", ";}
			else{$query .= ");";}
		}
		
		$result = mysqli_query($connection, $query);

		echo "<form method='POST' action='apply.php'><table>";
		while($row = mysqli_fetch_array($result))
		{
			$name = $row['name'];
			echo "<tr><td align='center' class='td1'><input type=radio name='applyTo' value='$name'></td><td align='center' class='td2'>$name</td></tr>";
		}
		echo "</table><input type=submit name='apply' value='Zažádat o přijetí'></form>"
	?>

	<a href="home.php">Návrat na seznam tříd</a>
</body>
<?php
	//Handling form submit
	if(isset($_POST['apply']))
	{
		$_SESSION['applyClass'] = $_POST['applyTo'];
		echo "<script type='text/javascript'>location.href = 'applyForm.php';</script>";
	}
?>