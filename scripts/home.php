<?php
	session_start();
	include 'languageHandler.php';
	require 'checker.php';
	check($urlExtension, true);
	unset($_SESSION['class']);
	include 'languageHandler.php';
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
			echo $lang['headerText'];
			echo $_SESSION['user'];
			?>
		</span>
		<a href="login.php<?php echo $urlExtension; ?>">
			<div id="logoutBox">
				<span id="logoutLink"><?php echo $lang['logOut']; ?></span>
			</div>
		</a>
		<a href="info.php<?php echo $urlExtension; ?>">
			<div id="infoBox">
				<span id="infoLink"><?php echo $lang['info']; ?></span>
			</div>
		</a>
	</div>
	<div id="middle">
		<div id="titleBox">
			<span id="title"><?php echo $lang['homeHeader']; ?></span>
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
<<<<<<< HEAD
				echo "<form action='classLogin.php".$urlExtension."' method='POST'><fieldset><table>";
=======
				echo "<form action='list.php".$urlExtension."' method='POST'><fieldset><table>";
>>>>>>> c6f279771b069facb9bf5df12614cab5229bae05
				
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
					if(in_array($class, $adminClasses)){echo $lang['admin'];}
					else if(in_array($class, $modClasses)){echo $lang['mod'];}
					else{echo $lang['member'];}
					echo "</td></tr>";
				}
				//Displaying the "ENTER" button
				echo "</table></fieldset><input type=submit value='".$lang['enter']."' name='login' id='submitButton'></form>";
			}
			else
			{
				//Displaying the "NO MEMBERSHIPS" message
				echo "<table><tr><td>".$lang['notMemberInAnyClass']."</td></tr></table>";
			}
			mysqli_close($connection);
		?>
		
		</div>
		<div id="applyBox">
<<<<<<< HEAD
			<a href="apply.php" id="applyLink"><?php echo $lang['apply']; ?></a>
		</div>
		<div id="newClassBox">
			<a href="newClass.php" id="newClassLink"><?php echo $lang['newClass']; ?></a>
=======
			<a href="apply.php<?php echo $urlExtension; ?>" id="applyLink"><?php echo $lang['apply']; ?></a>
		</div>
		<div id="newClassBox">
			<a href="newClass.php<?php echo $urlExtension; ?>" id="newClassLink"><?php echo $lang['newClass']; ?></a>
>>>>>>> c6f279771b069facb9bf5df12614cab5229bae05
		</div>
	</div>
</body>
