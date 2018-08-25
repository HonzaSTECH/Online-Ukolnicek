<?php
	session_start();
	require 'checker.php';
	check(true, true);
?>
<!DOCTYPE html>
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
		?></title>
		<link rel="stylesheet" href="../styles/list.css">
		<script src=JS.js></script>
                <meta charset="utf-8">
    </head>
    <body>
		<div id="header">
			<a href="login.php">Odhlásit se</a><br />
			<a href="home.php">Zpět na seznam tříd</a><br />
			<a href="classManagement.php">Správa třídy</a><br />
		</div>
		<div id="home">
			<div id="noRecord">Žádný záznam</div>
			<table id="data" border="2">
				<tr>
					<td id="date">
						Datum
					</td>
					<td id="subject">
						Předmět
					</td>
					<td id="description">
						Popis
					</td>
					<td id="author">
						Přidal/a
					</td>
					<td id="dateOfAdding">
						Přidáno
					</td>
					<td id="likes">
						<strong>^</strong>
					</td>
					<td id="akce">
						Akce
					</td>
				</tr>
				<?php
					require_once("connect.php");
					
					$query = "SELECT id, date,subject, description, author, dateOfAdding, priority, likes FROM records WHERE class=$classId ORDER BY date";
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
							echo "<tr>
							<td align='center' class='column1' BGCOLOR=".$recordColor.">".$row['date']."</td>
							<td align='center' class='column2' BGCOLOR=".$recordColor.">".$row['subject']."</td>
							<td align='center' class='column3' BGCOLOR=".$recordColor.">".$row['description']."</td>
							<td align='center' class='column4' BGCOLOR=".$recordColor.">".$row['author']."</td>
							<td align='center' class='column5' BGCOLOR=".$recordColor.">".$row['dateOfAdding']."</td>
							<td align='center' class='column6' BGCOLOR=".$recordColor.">".$row['likes']."</td>
							<td align='center' class='column7' BGCOLOR=".$recordColor."><button class='action1'>Like</button><button class='action2'>Edit</button><button class='action3'>Delete</button></td>
							</tr>";
						}
					}
					else{
						echo "An error occured while trying to get data from the database: ".mysqli_error($connection);
						mysqli_close($connection);
					}
				?>
			</table>
			<button id="addRecord">Přidat záznam</button>
		</div>
		<div id="form">
			<form method="POST" action=list.php>
				<span id="form1Text">Datum:</span>
				<input type="date" id="form1" name="date" required>
				<br />
				<span id="form2Text">Předmět:</span>
				<select id="form2" name="subject" required>
					<option>ČJ</option>
					<option>AJ</option>
					<option>NJ</option>
					<option>ZSV</option>
					<option>D</option>
					<option>Z</option>
					<option>Bi</option>
					<option>M</option>
					<option>Fy</option>
					<option>Ch</option>
					<option>EVV</option>
					<option>EVH</option>
					<option>TV</option>
					<option>IVT</option>
				</select>
				<br />
				<span id="form3Text">Popis:</span>
				<textarea type="message" id="form3" name="description" required placeholder="Opakovací test"></textarea>
				<br />
				<span id="form4Text">Přidal:</span>
				<input type="text" id="form4" name="author" required placeholder="Jméno Přijímení">
				<br />
				<span id="form5Text">Priorita:</span>
					<div id="priority1">
						<input type="radio" name="priority" value="1">1
					</div>
					<div id="priority2">
						<input type="radio"  name="priority" value="2">2
					</div>
					<div id="priority3">
						<input type="radio" name="priority" value="3" checked> 3
					</div>
					<div id="priority4">
						<input type="radio" name="priority" value="4"> 4
					</div>
					<div id="priority5">
						<input type="radio" name="priority" value="5"> 5
					</div>
					<br />
				<input type="submit" id="formSubmit" name="send" value="Potrvrdit">
			</form>
			<button id="formCancel">Zrušit</button>
		</div>
               <!-- <a href="server.php">PHP testing area</a>	-->
    </body>
</html>
<?php
    require_once('connect.php');
	include 'logger.php';
	
	if(isset($_POST['send'])){
	
		$a = $_POST['date'];
		$b = $_POST['subject'];
		$c = $_POST['description'];
		$d = $_POST['author'];
		$e = $_POST['priority'];
	/*
		echo $a."<br />";
		echo $b."<br />";
		echo $c."<br />";
		echo $d."<br />";
		echo $e."<br />";
	*/	
		$query = "INSERT INTO records (date, subject, description, author, dateOfAdding, priority, class) values ('$a', '$b', '$c', '$d', NOW(), '$e', '$classId')";
		$result = mysqli_query($connection, $query);
		if ($result){
			echo "
				<script>
					document.getElementsByClassName('action1')[recordCount].onclick = upvoteRecord;
					document.getElementsByClassName('action2')[recordCount].onclick = editRecord;
					document.getElementsByClassName('action3')[recordCount].onclick = removeRecord;
				</script>";
				$user = $_SESSION['user'];
				fileLog("Uživatel $user přidal ve třídě $name záznam: $a - $b - $c - $e. priorita");
		}
		else{
            echo "An error occured: ".mysqli_error($connection);
            mysqli_close($connection);
        }
	}
    else{mysqli_close($connection);}
?>