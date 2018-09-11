<?php
	session_start();
	require 'checker.php';
	check(true, true);
?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" href="../styles/classManagement.css">
		<script src="classManagement.js"></script>
	</head>
	<body>
		<nav>
			<a onclick="firstTab()">Obecné</a>
			<a onclick="secondTab()">Správa předmětů</a>
			<a onclick="thirdTab()">Správa členů</a>
			<a onclick="fourthTab()">Žádosti o přijetí</a>
		</nav>
		<div id="tab1">
			<h2>Obecné</h2>
			ID třídy: <?php echo $_SESSION['class'];?>
		</div>
		<div id="tab2">
			<h2>Správa předmětů</h2>
			
			<?php
				require_once('connect.php');
				
				$class = $_SESSION['class'];
				$query = "SELECT subjects FROM classes WHERE id='$class'";
				$result = mysqli_query($connection, $query);
				$result = mysqli_fetch_array($result);
				$result = $result['subjects'];
				$result = explode(',',$result);
				echo "<ol>";
				foreach ($result as $subject)
				{
					echo "<li>";
					if ($subject!=''){echo $subject;}
					else {echo "Empty";}
					echo "</li>";
				}
				echo "</ol>";
			?>
			
			<button id="changeSubjects" onclick="changeSubjects()">Upravit předměty</button>
			
			<div id="subjectsForm">
				<form method="POST" action="classManagement.php">
					<?php
						$class = $_SESSION['class'];
						$query = "SELECT subjects FROM classes WHERE id='$class'";
						$result = mysqli_query($connection, $query);
						$result = mysqli_fetch_array($result);
						$result = $result['subjects'];
						$result = explode(',',$result);
						
						for ($i = 1; $i <= 20; $i++)
						{
							echo "<input type=text maxlength=3 name='sub$i'";
							$j = $i - 1;
							if($result[$j] != ''){echo "value='$result[$j]'";}
							echo "><br />";
						}
					?>
					<input type=submit value="Uložit" name="save">
				</form>
				<?php
					if(isset($_POST['save']))
					{
						$subjects = array();
						
						array_push($subjects, $_POST['sub1']);
						array_push($subjects, $_POST['sub2']);
						array_push($subjects, $_POST['sub3']);
						array_push($subjects, $_POST['sub4']);
						array_push($subjects, $_POST['sub5']);
						array_push($subjects, $_POST['sub6']);
						array_push($subjects, $_POST['sub7']);
						array_push($subjects, $_POST['sub8']);
						array_push($subjects, $_POST['sub9']);
						array_push($subjects, $_POST['sub10']);
						array_push($subjects, $_POST['sub11']);
						array_push($subjects, $_POST['sub12']);
						array_push($subjects, $_POST['sub13']);
						array_push($subjects, $_POST['sub14']);
						array_push($subjects, $_POST['sub15']);
						array_push($subjects, $_POST['sub16']);
						array_push($subjects, $_POST['sub17']);
						array_push($subjects, $_POST['sub18']);
						array_push($subjects, $_POST['sub19']);
						array_push($subjects, $_POST['sub20']);
						
						$subjects = implode(',',$subjects);
						$class = $_SESSION['class'];
						echo $subjects;
						$query = "UPDATE classes SET subjects = '$subjects' WHERE id = $class";
						unset($class);
						mysqli_query($connection, $query);
						echo "<script type='text/javascript'>location.href = 'classManagement.php';</script>";
					}
				?>
			</div>
			
		</div>
		<div id="tab3">
			<h2>Správa členů</h2>
			
			<?php
				require_once('connect.php');
				$query = "SELECT id, name, memberIn, modIn, adminIn FROM `users` WHERE memberIn != 0";
				$result = mysqli_query($connection, $query);
				
				$admins = array();
				$mods = array();
				$members = array();
				
				while($data = mysqli_fetch_array($result))
				{
					$adminClasses = explode(',',$data['adminIn']);
					$modClasses = explode(',',$data['modIn']);
					$memberClasses = explode(',',$data['memberIn']);
					if (in_array($_SESSION['class'], $adminClasses)){array_push($admins, $data['name']);}
					else if (in_array($_SESSION['class'], $modClasses)){array_push($mods, $data['name']);}
					else if (in_array($_SESSION['class'], $memberClasses)){array_push($members, $data['name']);}
				}
				
				echo "<table border=1>";
				foreach($admins as $user)
				{
					echo "<tr><td class='rank3'>Administrátor</td><td class='username'>$user</td></tr>";
				}
				foreach($mods as $user)
				{
					echo "<tr><td class='rank2'>Moderátor</td><td class='username'>$user</td></tr>";
				}
				foreach($members as $user)
				{
					echo "<tr><td class='rank1'>Člen</td><td class='username'>$user</td></tr>";
				}
				echo "</table>";
			?>
			
		</div>
		<div id="tab4">
			<h2>Žádosti o přijetí</h2>
			
			<?php
				require_once('connect.php');
				$query = "SELECT * FROM applications ORDER BY age";
				$result = mysqli_query($connection, $query);
				mysqli_close($connection);
				$exist = 0;
				while($data = mysqli_fetch_array($result)){
					$exist++;
					if ($exist == 1){echo "<table border=1>";}
					$a = $data['nickname'];
					$b = $data['name'];
					$c = $data['surname'];
					$d = $data['message'];
					echo "<tr><td align='center'>$a</td><td align='center'>$b</td><td align='center'>$c</td><td align='center'>$d</td><td><button>Přijmout</button><br /><button>Odmítnout</button></td></tr>";
				}
				if($exist > 0){echo "</table>";}
				else {echo "Žádné žádosti o přijetí.";}
				
				unset($exist);
			?>
			
		</div>
	</body>
<html>