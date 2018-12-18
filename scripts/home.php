<?php
	session_start(); 
	require 'checker.php';
	check(true);
	unset($_SESSION['class']);
?>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../images/transparentMarklessLogo.ico">
	<link rel="stylesheet" href="../styles/home.css">
</head>
<body>
	<div id="header">
		<span id="username">
			<?php
			echo "You are logged in as ";
			echo $_SESSION['user'];
			?>
		</span>
		<a href="login.php">
			<div id="logoutBox">
				<span id="logoutLink">Log out</span>
			</div>
		</a>
		<a href="info.php">
			<div id="infoBox">
				<span id="infoLink">Information</span>
			</div>
		</a>
	</div>
	<div id="middle">
		<div id="titleBox">
		<span id="title">You are a member in these classes</span>
		</div>
		<div id="main">
		
		<?php
			require_once("connect.php");
			
			//Getting listof classes the user is member in
			$user = $_SESSION['user'];
			$query = "SELECT memberIn FROM users WHERE name='$user'";
			$result = mysqli_query($connection, $query);
			$data = mysqli_fetch_array($result);
			$data = $data['memberIn'];
			
			//Checking for any membership
			if(!$data == '0')
			{
				//Separating the list (1,2,4,5,...) into array
				$classes = explode(',', $data);
				
				//Printing the table
				echo "<form action='classLogin.php' method='POST'><fieldset><table>";
				
				$modClasses = array(0);
				$adminClasses = array(0);
				foreach ($classes as $class)
				{
					//Getting the name of the class
					$result = mysqli_query($connection, "SELECT * FROM classes WHERE id='$class'");
					$classData = mysqli_fetch_array($result);
					$classData = $classData['name'];
					
					//Classes the user is moderator in
					$result = mysqli_query($connection, "SELECT modIn FROM users WHERE name='$user'");
					$data = mysqli_fetch_array($result);
					$data = $data['modIn'];
					if(!$data == '0'){$modClasses = explode(',', $data);}
					
					//Classes the user is admin in
					$result = mysqli_query($connection, "SELECT adminIn FROM users WHERE name='$user'");
					$data = mysqli_fetch_array($result);
					$data = $data['adminIn'];
					if(!$data == '0'){$adminClasses = explode(',', $data);}
					
					//Displaying list of classes
					echo "<tr><td class='selectorColumn'><input type=radio name='classSelect' value='$class' class='radioSelect' required></td><td class='nameColumn'> $classData</td><td class='rankColumn'>";
					if(in_array($class, $adminClasses)){echo "Administrator";}
					else if(in_array($class, $modClasses)){echo "Moderator";}
					else{echo "Member";}
					echo "</td></tr>";
				}
				//Displaying the "ENTER" button
				echo "</table></fieldset><input type=submit value='Enter' name='login' id='submitButton'></form>";
			}
			else
			{
				//Displaying the "NO MEMBERSHIPS" message
				echo "<table><tr><td>You aren't member in any class.</td></tr></table>";
			}
			mysqli_close($connection);
		?>
		
		</div>
		<div id="applyBox">
			<a href="apply.php" id="applyLink">Apply for admission to an existing class</a>
		</div>
		<div id="newClassBox">
			<a href="newClass.php" id="newClassLink">Create a new class</a>
		</div>
	</div>
</body>
