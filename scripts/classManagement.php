<?php
	session_start();
	require 'checker.php';
	check(true, true, true);
	require 'connect.php';
?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="../images/marklessLogo.ico">
		<link rel="stylesheet" href="../styles/classManagement.css">
		<script src="classManagement.js"></script>
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
			<div id="infoBox">
				<a href="info.php" id="infoLink">Informace</a>
			</div>
			<div id="homeBox">
				<a href="home.php" id="homeLink">Domů</a>
			</div>
			<div id="classBox">
				<a href="list.php" id="classLink">Třída</a>
			</div>
		</div>
		<div id="main">
			<nav>
				<a onclick="firstTab()">Obecné</a>
				<a onclick="secondTab()">Správa předmětů</a>
				<a onclick="thirdTab()">Správa členů</a>
				<a onclick="fourthTab()">Žádosti o přijetí</a>
			</nav>
			<div id="container">
				<div id="tab1">
					ID třídy:
					<?php
						//Displaying ID of the class
						echo $_SESSION['class'];
					?>
				</div>
				<div id="tab2">
					<?php
						//Displaying subjects in the class
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
								//Displaying subjects of the class as default values in the input fields
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
							<button onclick="hideForm(event)">Zrušit</button>
						</form>
						<?php
							//Handling form submit
							if(isset($_POST['save']))
							{
								$subjects = array();
								//TODO -make it look better
								//Nesting new subjects in the array
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
								
								//Connecting the subjects together
								$subjects = implode(',',$subjects);
								$class = $_SESSION['class'];
								
								//Updating the database
								$query = "UPDATE classes SET subjects = '$subjects' WHERE id = $class";
								unset($class);
								mysqli_query($connection, $query);
								
								//Reloading the page
								echo "<script type='text/javascript'>location.href = 'classManagement.php';</script>";
							}
						?>
					</div>
					
				</div>
				<div id="tab3">

					<?php
						//Displaying the table of members of the class
						require_once('connect.php');
						$query = "SELECT id, name, memberIn, modIn, adminIn FROM `users` WHERE memberIn != 0";
						$result = mysqli_query($connection, $query);
						
						$admins = array();
						$mods = array();
						$members = array();
						
						//Transforming data from the database into arrays
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
							//Displaying admins
							foreach($admins as $user)
							{
								echo "<tr><td class='rank3'>Administrátor</td><td class='username'>$user</td><td class='action'></td></tr>";
							}
							//Displaying moderators
							foreach($mods as $user)
							{
								echo "<tr><td class='rank2'>Moderátor</td><td class='username'>$user</td><td class='action'><select value='Moderátor'><option>Moderátor</option><option>Člen</option></select><button>Odstranit</button></td></tr>";
							}
							//Displaying members
							foreach($members as $user)
							{
								echo "<tr><td class='rank1'>Člen</td><td class='username'>$user</td><td class='action'><select value='Člen'><option>Moderátor</option><option>Člen</option></select><button>Odstranit</button></td></tr>";
							}
						echo "</table>";
					?>
					
				</div>
				<div id="tab4">
					<?php
						//Displaying applications to the class
						require_once('connect.php');
						$class = $_SESSION['class'];
						$query = "SELECT * FROM applications WHERE class='$class' ORDER BY age";
						$result = mysqli_query($connection, $query);
						mysqli_close($connection);
						$exist = 0;
						
						//Printing the table
						while($data = mysqli_fetch_array($result)){
							$exist++;
							if ($exist == 1){echo "<table border=1><tr><th align='center' id='nicknameHeader'>Přezdívka</th><th align='center' id='nameHeader'>Jméno</th><th align='center' id='surnameHeader'>Přijímení</th><th align='center' id='messageHeader'>Zpráva</th><th align='center' id='actionHeader'>Akce</td></tr>";}
							$a = $data['nickname'];
							$b = $data['name'];
							$c = $data['surname'];
							$d = $data['message'];
							echo "<tr><td align='center' class='nicknameColumn'>$a</td><td align='center' class='nameColumn'>$b</td><td align='center' class='surnameColumn'>$c</td><td align='center' class='messageColumn'><div class='messageBox'>$d</div></td><td align='center' class='actionColumn'><button onclick='accept(event)' class='acceptButton'>Přijmout</button><br /><button onclick='decline(event)' class='declineButton'>Odmítnout</button></td><td class='hiddenClass'>$class</td></tr>";
						}
						
						//Checking for an existing application
						if($exist > 0){echo "</table>";}
						else {echo "Žádné žádosti o přijetí.";}
						
						unset($exist);
					?>
				</div>
			</div>
		</div>
	</body>
<html>