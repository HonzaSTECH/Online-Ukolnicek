<?php
	session_start();
	if(empty($_SESSION['class'])){$_SESSION['class'] = $_POST['classSelect'];}
	include 'languageHandler.php';
	require 'checker.php';
	check($urlExtension, true, true);
?>
<html>
	<head>
        <title><?php 
		echo $lang['title']." - ";
		
		//Displaying the name of the class
		require_once('connect.php');
		$classId = $_SESSION['class'];
		$query = "SELECT name FROM classes WHERE id=$classId";
		$result = mysqli_query($connection, $query);
		$name = mysqli_fetch_array($result);
		$name = $name['name'];
		echo $name;
		?>
		</title>
		<link rel="shortcut icon" href="../images/transparentMarklessLogo.ico">
		<link rel="stylesheet" href="../styles/list.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src=list.js></script>
		<meta charset="utf-8">
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
			<a href="home.php<?php echo $urlExtension; ?>">
				<div id="homeBox">
					<span id="homeLink"><?php echo $lang['home']; ?></span>
				</div>
			</a>
			<?php
				//Checking for user being admin of the class and displaying the classManagement link in case he is
				require_once('connect.php');
				$classId = $_SESSION['class'];
				$username = $_SESSION['user'];
				$query = "SELECT admin FROM classes WHERE id='$classId'";
				$result = mysqli_query($connection, $query);
				$result = mysqli_fetch_array($result);
				$result = $result['admin'];
				if($result == $username)
				{
					echo "
					<a href='classManagement.php".$urlExtension."'>
						<div id='classManagementBox'>
							<span id='classManagementLink'>".$lang['classManagement']."</span>
						</div>
					</a>
					";
				}
			?>
		</div>
		<div id="home">
			<table id="data" border="1">
				<tr>
					<th id="date">
						<?php echo $lang['date']; ?>
					</th>
					<th id="subject">
						<?php echo $lang['subject']; ?>
					</th>
					<th id="description">
						<?php echo $lang['desc']; ?>
					</th>
					<th id="author">
						<?php echo $lang['author']; ?>
					</th>
					<th id="dateOfAdding">
						<?php echo $lang['dateOfAdding']; ?>
					</th>
					<th id="likes">
						<strong>^</strong>
					</th>
					<th id="akce">
						<?php echo $lang['action']; ?>
					</th>
				</tr>
				<?php
					function liked($username, $likers)
					{
						//Function returning if the user already liked the record
						global $connection;
						$query = "SELECT id FROM users WHERE name='$username'";
						$query = mysqli_query($connection, $query);
						$query = mysqli_fetch_array($query);
						$user = $query['id'];
						$likers = explode(",",$likers);
						return (in_array($user, $likers));
					}
				
					require_once("connect.php");
					
					//Getting all records of the class from the database
					$query = "SELECT id, date, subject, description, author, dateOfAdding, priority, likes, likers FROM records WHERE class=$classId ORDER BY date";
					$records = mysqli_query($connection, $query);
					
					//Checking for query result
					if($records)
					{
						//Printing the records
						while($row = mysqli_fetch_array($records))
						{
							$exist = true;
							
							//Getting records priority / color
							switch($row['priority'])
							{
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
							
							//Formating dats in the record
							$row['date'] = date_format(date_create($row['date']), "d. m. Y");
							$row['dateOfAdding'] = date_format(date_create($row['dateOfAdding']), "d. m. Y");
							
							//Printing the table cells
							echo "<tr>
								<td align='center' class='column1' BGCOLOR=".$recordColor.">".$row['date']."</td>
								<td align='center' class='column2' BGCOLOR=".$recordColor.">".$row['subject']."</td>
								<td align='center' class='column3' BGCOLOR=".$recordColor.">".$row['description']."</td>
								<td align='center' class='column4' BGCOLOR=".$recordColor.">".$row['author']."</td>
								<td align='center' class='column5' BGCOLOR=".$recordColor.">".$row['dateOfAdding']."</td>
								<td align='center' class='column6' BGCOLOR=".$recordColor.">".$row['likes']."</td>
								<td align='center' class='column7' BGCOLOR=".$recordColor.">";
									//Printing action buttons
									if($_SESSION['user'] == $row['author'])
									{
										//Current user is author of the record - displaying edit and delete button
										echo "<button class='action2' onclick='editRecord(event)'>".$lang['edit']."</button><button class='action3' onclick='removeRecord(event)'>".$lang['delete']."</button>";
									}
									else
									{
										//Current user is NOT author of the record - displaying like button (if hasn't liked yet)
										if(!liked($_SESSION['user'], $row['likers'])){echo "<button class='action1' onclick='upvoteRecord(event)'>".$lang['upvote']."</button>";}
										
										//Checking if the user is mod or admin of the class - displaying edit and delete buttons
										$user = $_SESSION['user'];
										$query = "SELECT modIn, adminIn FROM users WHERE name = '$user'";
										$result = mysqli_query($connection, $query);
										$result = mysqli_fetch_array($result);
										$adminClasses = explode(',', $result['adminIn']);
										$modClasses = explode(',', $result['modIn']);
										if(in_array($classId, $adminClasses) || in_array($classId, $modClasses)){echo "<button class='action2' onclick='editRecord(event)'>".$lang['edit']."</button><button class='action3' onclick='removeRecord(event)'>".$lang['delete']."</button>";}
									}
								echo "</td>
							</tr>";
						}
						//Displaying NO RECORD message if no record exist
						if (!isset($exist)){echo "<tr><td colspan='7' BGCOLOR='#CCCCCC'><div id='noRecord'>".$lang['noRecord']."</div></td></tr>";}
					}
					else
					{
						//Error checking
						echo "An error occured while trying to get data from the database: ".mysqli_error($connection);
						mysqli_close($connection);
					}
				?>
			</table>
				
			<button id="addRecord" onclick="addRecord()"><?php echo $lang['newRecord']; ?></button>
		</div>
		<div id="form">
			<div id="formTitle"><?php echo $lang['newRecord']; ?></div>
			<form method="POST" onsubmit="newRecord(event)">
				<span id="form1Text"><?php echo $lang['date'].":"; ?></span>
				<input type="date" id="form1" name="date" required>
				<br />
				<span id="form2Text"><?php echo $lang['subject'].":"; ?></span>
				<select id="form2" name="subject" required>
					<?php
						//Displaying possible subjects in the form
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
					<!-- Default option -->
					<option>---</option>
				</select>
				<br />
				<span id="form3Text"><?php echo $lang['desc'].":"; ?></span>
				<textarea type="message" id="form3" name="description" required placeholder="<?php echo $lang['descPlaceholder']; ?>" maxlength=100></textarea>
				<br />
				<span id="form5Text"><?php echo $lang['priority'],":"; ?></span>
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
				<input type="submit" id="formSubmit" name="send" value="<?php echo $lang['confirm']; ?>">
			</form>
			<button id="formCancel" onclick="closeForm()"><?php echo $lang['cancel']; ?></button>
		</div>
    </body>
</html>
