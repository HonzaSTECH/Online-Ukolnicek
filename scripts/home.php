<?php
	session_start(); 
	require 'checker.php';
	check(true);
	unset($_SESSION['class']);
?>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../images/marklessLogo.ico">
	<link rel="stylesheet" href="../styles/home.css">
</head>
<body>
	<div id="header">
		<span id="username">
			<?php
			echo "Jsi přihlášen jako ";
			echo $_SESSION['user'];
			?>
		</span>
		<div id="logoutBox">
			<a href="login.php" id="logoutLink">Odhlásit se</a>
		</div>
		<!--<div id="homeBox">
			<a href="home.php" id="homeLink">Domů</a>
		</div>-->
		<div id="infoBox">
			<a href="info.php" id="infoLink">Informace</a>
		</div>
	</div>
	<div id="leftSidebar">
		<!-- TODO -->
	</div>
	<div id="rightSidebar">
		<!-- TODO -->
	</div>
	<div id="middle">
		<div id="titleBox">
		<span id="title">Jsi členem v těchto třídách:</span>
		</div>
		<div id="main">
		
		<?php
			require_once("connect.php");
			
			$user = $_SESSION['user'];
			$query = "SELECT memberIn FROM users WHERE name='$user'";
			$result = mysqli_query($connection, $query);
			
			$data = mysqli_fetch_array($result);
			$data = $data['memberIn'];
			
			if(!$data == '0'){
				$classes = explode(',', $data);
				echo "<form action='classLogin.php' method='POST'><table>";
				foreach ($classes as $class){
					$result = mysqli_query($connection, "SELECT * FROM classes WHERE id='$class'");
					$classData = mysqli_fetch_array($result);
					$classData = $classData['name'];
					
					$result = mysqli_query($connection, "SELECT modIn FROM users WHERE name='$user'");
					$data = mysqli_fetch_array($result);
					$data = $data['modIn'];
					if(!$data == '0'){$modClasses = explode(',', $data);}
					
					$result = mysqli_query($connection, "SELECT adminIn FROM users WHERE name='$user'");
					$data = mysqli_fetch_array($result);
					$data = $data['adminIn'];
					if(!$data == '0'){$adminClasses = explode(',', $data);}
					
					echo "<tr><td class='selectorColumn'><input type=radio name='classSelect' value='$class' class='radioSelect'></td><td class='nameColumn'> $classData</td><td class='rankColumn'>";
					if(in_array($class, $adminClasses)){echo "Administrátor";}
					else if(in_array($class, $modClasses)){echo "Moderátor";}
					else{echo "Člen";}
					echo "</td></tr>";
				}
				echo "</table><input type=submit value='Vstoupit' name='login' id='submitButton'></form>";
			}
			else{
				echo "Nejsi členem žádné třídy.<br />";
			}
			mysqli_close($connection);
		?>
		
		</div>
		<div id="applyBox">
			<a href="apply.php" id="applyLink">Zažádat o přijetí do existující třídy</a>
		</div>
		<div id="newClassBox">
			<a href="newClass.php" id="newClassLink">Založit novou třídu</a>
		</div>
	</div>
</body>