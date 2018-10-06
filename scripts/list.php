<?php
	session_start();
	require 'checker.php';
	check(true, true);
?>
<html>
	<head>
        <title>Ukolníček - 
		<?php
			require_once('connect.php');
			$classId = $_SESSION['class'];
			$query = "SELECT name FROM classes WHERE id=$classId";
			$result = mysqli_query($connection, $query);
			$name = mysqli_fetch_array($result);
			$name = $name['name'];
			echo $name;
		?>
		</title>
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" href="../styles/list.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src=list.js></script>
		<meta charset="utf-8">
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
			<?php
				require_once('connect.php');
				$classId = $_SESSION['class'];
				$username = $_SESSION['user'];
				$query = "SELECT admin FROM classes WHERE id='$classId'";
				$result = mysqli_query($connection, $query);
				$result = mysqli_fetch_array($result);
				$result = $result['admin'];
				if($result == $username)
				{
					echo "<div id='classManagementBox'>
						<a href='classManagement.php' id='classManagementLink'>Správa třídy</a>
					</div>";
				}
			?>
		</div>
		<div id="home">
			<div id="noRecord">Žádný záznam</div>
			<table id="data" border="1">
				<tr>
					<th id="date">
						Datum
					</th>
					<th id="subject">
						Předmět
					</th>
					<th id="description">
						Popis
					</th>
					<th id="author">
						Přidal/a
					</th>
					<th id="dateOfAdding">
						Přidáno
					</th>
					<th id="likes">
						<strong>^</strong>
					</th>
					<th id="akce">
						Akce
					</th>
				</tr>
				<?php
					function liked($username, $likers)
					{
						global $connection;
						$query = "SELECT id FROM users WHERE name='$username'";
						$query = mysqli_query($connection, $query);
						$query = mysqli_fetch_array($query);
						$user = $query['id'];
						$likers = explode(",",$likers);
						return (in_array($user, $likers));
					}
				
					require_once("connect.php");
					
					$query = "SELECT id, date, subject, description, author, dateOfAdding, priority, likes, likers FROM records WHERE class=$classId ORDER BY date";
					$records = mysqli_query($connection, $query);
					if($records){
						while($row = mysqli_fetch_array($records)){
							switch($row['priority']){
								case "1":
									$recordColor = "#FF8888";
									break;
								case "2":
									$recordColor = "#FFCC88";
									break;
								case "3":
									$recordColor = "#FFFF77";
									break;
								case "4":
									$recordColor = "#88EE88";
									break;
								case "5":
									$recordColor = "#9999FF";
									break;
								default:
									$recordColor = "#FFFF77";
							}
							
							$row['date'] = date_format(date_create($row['date']), "d. m. Y");
							$row['dateOfAdding'] = date_format(date_create($row['dateOfAdding']), "d. m. Y");
							
							echo "<tr>
							<td align='center' class='column1' BGCOLOR=".$recordColor.">".$row['date']."</td>
							<td align='center' class='column2' BGCOLOR=".$recordColor.">".$row['subject']."</td>
							<td align='center' class='column3' BGCOLOR=".$recordColor.">".$row['description']."</td>
							<td align='center' class='column4' BGCOLOR=".$recordColor.">".$row['author']."</td>
							<td align='center' class='column5' BGCOLOR=".$recordColor.">".$row['dateOfAdding']."</td>
							<td align='center' class='column6' BGCOLOR=".$recordColor.">".$row['likes']."</td>
							<td align='center' class='column7' BGCOLOR=".$recordColor.">";
							if($_SESSION['user'] == $row['author']){echo "<button class='action2' onclick='editRecord(event)'>Edit</button><button class='action3' onclick='removeRecord(event)'>Delete</button>";}
							else{
								if(!liked($_SESSION['user'], $row['likers'])){echo "<button class='action1' onclick='upvoteRecord(event)'>Like</button>";}
								$user = $_SESSION['user'];
								$query = "SELECT modIn, adminIn FROM users WHERE name = '$user'";
								$result = mysqli_query($connection, $query);
								$result = mysqli_fetch_array($result);
								$adminClasses = explode(',', $result['adminIn']);
								$modClasses = explode(',', $result['modIn']);
								if(in_array($classId, $adminClasses) || in_array($classId, $modClasses)){echo "<button class='action2' onclick='editRecord(event)'>Edit</button><button class='action3' onclick='removeRecord(event)'>Delete</button>";}
							}
							echo "</td>
							</tr>";
						}
					}
					else{
						echo "An error occured while trying to get data from the database: ".mysqli_error($connection);
						mysqli_close($connection);
					}
				?>
			</table>
			<button id="addRecord" onclick="addRecord()">Přidat záznam</button>
		</div>
		<div id="form">
			<div id="formTitle">Přidat záznam</div>
			<form method="POST" onsubmit="newRecord(event)">
				<span id="form1Text">Datum:</span>
				<input type="date" id="form1" name="date" required>
				<br />
				<span id="form2Text">Předmět:</span>
				<select id="form2" name="subject" required>
					<?php
						require_once('connect.php');
						$class = $_SESSION['class'];
						$query = "SELECT subjects FROM classes WHERE id=$class";
						unset($class);
						$result = mysqli_query($connection,  $query);
						$result = mysqli_fetch_array($result);
						$result = explode(',', $result['subjects']);
						
						foreach($result as $subject)
						{
							if($subject == ''){continue;}
							echo "<option>$subject</option>";
						}
					?>
					<option>---</option>
				</select>
				<br />
				<span id="form3Text">Popis:</span>
				<textarea type="message" id="form3" name="description" required placeholder="Opakovací test" maxlength=100></textarea>
				<br />
				<span id="form5Text">Priorita:</span>
					<div id="priority1">
						<input type="radio" name="priority" value="1" id="pr1">
						<br />
						<label for="pr1">1</label>
					</div>
					<div id="priority2">
						<input type="radio"  name="priority" value="2"  id="pr2">
						<br />
						<label for="pr2">2</label>
					</div>
					<div id="priority3">
						<input type="radio" name="priority" value="3"  id="pr3" checked>
						<br />
						<label for="pr3">3</label>
					</div>
					<div id="priority4">
						<input type="radio" name="priority" value="4"  id="pr4">
						<br />
						<label for="pr4">4</label>
					</div>
					<div id="priority5">
						<input type="radio" name="priority" value="5"  id="pr5">
						<br />
						<label for="pr5">5</label>
					</div>
					<br />
				<input type="submit" id="formSubmit" name="send" value="Potrvrdit">
			</form>
			<button id="formCancel" onclick="closeForm()">Zrušit</button>
		</div>
    </body>
</html>
