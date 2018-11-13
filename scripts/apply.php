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
	<div id="header">
		<span id="username">
			<?php
			echo "Jsi přihlášen jako ";
			echo $_SESSION['user'];
			?>
		</span>
		<a href="login.php">
			<div id="logoutBox">
				<span id="logoutLink">Odhlásit se</span>
			</div>
		</a>
		<a href="info.php">
			<div id="infoBox">
				<span id="infoLink">Informace</span>
			</div>
		</a>
		<a href="home.php">
			<div id="homeBox">
				<span id="homeLink">Domů</span>
			</div>
		</a>
	</div>
	<div id="container">
		<div id="infoText">
			<h2>Zažádat o přijetí do existující třídy</h2>
			<span id=subtext>
				Vyber si třídu do které se chceš přidat a zadej osobní údaje jako informace pro adminitrátora nebo moderátory třídy kteří budou muset tvojí žádost o přijetí potvrdit.
			</span>
		</div>
		<form action="apply.php" method="POST">
			<fieldset id=classSelect>
				<?php	//Printing list of classes to join 
					require_once("connect.php");
					
					//Getting names of all avilibe classes from the database
					$user = $_SESSION['user'];
					$query = "SELECT memberIn FROM users WHERE name='$user'";
					$result = mysqli_query($connection, $query);
					$alreadyMemberIn = mysqli_fetch_array($result);
					$alreadyMemberIn = $alreadyMemberIn['memberIn'];
					if(!$alreadyMemberIn == 0){$alreadyMemberIn = explode(',',$alreadyMemberIn);}
					else{$alreadyMemberIn = array(0);}
					$count = count($alreadyMemberIn);
					$query = "SELECT name FROM classes WHERE id NOT IN (";
					foreach($alreadyMemberIn as $class)
					{
						$count--;
						$query .= $class;
						if($count > 0){$query .= ", ";}
						else{$query .= ");";}
					}
					$result = mysqli_query($connection, $query);
					
					//Getting amount of needed columns for the table
					$count = mysqli_num_rows($result);
					if($count == 0){$columns = 0;}
					else if($count <= 4){$columns = 1;}
					else if($count <= 8){$columns = 2;}
					else if($count <= 12){$columns = 3;}
					else if($count > 12){$columns = 4;}
					
					if($columns == 0){echo "Jsi již členem ve všech existujících třídách.";}
					
					//Getting amount of needed rows for the table
					if($columns <= 1){$rowCount = $count;}
					else if($columns <= 3){$rowCount = ceil($count / $columns);}
					else{$rowCount = ceil($count / 3);}
					
					//Setting width for each column depending on columns count
					switch($columns)
					{
						case 1:
							$width = 24;
							break;
						case 2:
							$width = 12;
							break;
						case 3:
							$width = 8;
							break;
						case 4:
							$width = 8;
							break;
						default:
							//No available classes
							$width = 0;
							break;
					}
					
					//Getting names of all avalibe classes in to numeric array
					$classes = array();
					while($row = mysqli_fetch_array($result))
					{
						$name = $row['name'];
						array_push($classes, $name);
					}
					//Creating rows of the table and printing it
					echo "<table>";
					
					for($i = 0; $i < $rowCount; $i++)
					{
						$row = array();
						for($j = 0; $j < $columns; $j++)
						{
							$index = ($rowCount * $j) + $i;
							if(!isset($classes[$index])){break;}
							array_push($row, $classes[$index]);
						}
						//Printing
						echo "<tr>";
							for($k = 0; $k < $columns; $k++)
							{
								if(!isset($row[$k])){break;}
								$classname = $row[$k];
								echo "<td style='width:".$width."vw; min-width:".$width."vw; max-width:".$width."vw;'><label>";
									echo"<input type=radio name='applyTo' value='$classname' required>$classname";
								echo "</label></td>";
							}
						echo "</tr>";
					}
					echo "</table>";
				?>
			</fieldset>
			<fieldset>
				<input type=text name="name" placeholder="Jméno" id="name" required>
				<input type=text name="surname" placeholder="Přijímění" id="surname" required>
				<textarea type="message" name="message" placeholder="Dodatečné informace" id="text" required>Ahoj. Rád bych se přidal do vaší třídy. Přijmete prosím mojí žádost?</textarea>
				<input type=submit name="posted" value="Odeslat žádost" id="submitButton" <?php	if($count <= 0){echo "disabled";}	?>>
				</fieldset>
		</form>

		<?php
			//require_once("connect.php");
			include 'logger.php';

			if(isset($_POST['posted'])){
				
				//Getting ID of the class
				$className = $_POST['applyTo'];
				$query = "SELECT id FROM classes WHERE name='$className'";
				$result = mysqli_query($connection, $query);
				$result = mysqli_fetch_array($result);
				$class = $result['id'];
				unset($_SESSION['applyClass']);
				
				//Getting e-mail of the admin of the class
				$query = "SELECT admin FROM classes WHERE id='$class'";
				$result = mysqli_query($connection, $query);
				if (!$result){echo "An error occured. Error: ".mysqli_error();}
				$admin = mysqli_fetch_array($result);
				$admin = $admin['admin'];
				$query = "SELECT email FROM users WHERE name='$admin'";
				$result = mysqli_query($connection, $query);
				if (!$result){echo "An error occured. Error: ".mysqli_error();}
				$email = mysqli_fetch_array($result);
				$email = $email['email'];

				//Getting application details
				$user = $_SESSION['user'];
				$name = $_POST['name'];
				$surname = $_POST['surname'];
				$message = $_POST['message'];
				
				//Replacing linebreaks with <br>
				$message = str_replace(array("\r\n"), '<br>', $message);
				
				//Writing the application into the database
				$timestamp = time();
				$query = "INSERT INTO applications (nickname, name, surname, message, class, age) VALUES ('$user', '$name', '$surname', '$message', '$class', '$timestamp')";
				$result = mysqli_query($connection, $query);
				
				//Checking for error
				if(!$result){echo "An Error occured. Error: ".mysqli_error($connection);}
				
				//Building e-mail for the admin
				//str_replace("<br>", "\n", $message);
				$message = wordwrap($message, 70, "<br />");
				
				$email_subject = "Nová žádost o přijetí do třídy $className od $name $surname";
				//Building e-mail body
				$email_body = "
				<div style='width: 50%; border: 2px solid black; margin: auto; background-color: #FFFF99; padding:10px;text-align:center'>
					<h2 style='position:relative;left:0;right:0;margin:auto;'>Detaily žádosti:</h2>
					<fieldset style='width: 50%; position: relative; left:0; right:0; margin: auto;border-radius:20px;'>
						<b>Jméno:</b> $name
						<br /><b>Přijímení:</b> $surname
						<br /><b>Text žádosti:</b>
						<br />
						<div style='border: 1px solid black; width: 50%;padding:5px;margin:auto;position:relative;left:0;right:0;'>
							$message
						</div>
						<br />
					</fieldset>
					<br /><i>Žádost můžete přijmout nebo zamítnout na stránce se seznamem testů.
					<br />Tuto Žadost schvalte pouze v případě, že jste si jistí kdo tento uživatel ve skutečnosti je.
					<br />Tento e-mail byl vygenerován automaticky a tudíž na něj neodpovídejte.</i>
					<hr /><span style='color: rgb(102,102,102)';>Nechcete od nás dostávat další e-maily? Odhlašte se z odběru e-mailů <a href='seznamtestu.chytrak.cz'>zde</a>.</span>
					<br /><span style='color: rgb(135,135,135)';>Toto zruší pouze automaticky odesílané e-maily. Pokud odešlete dotaz nebo připomínku, stále můžete dostat webmasterem psanou odpověď.</span>
				</div>
				";
				
				//$headers = "From: Seznam testů info <info@seznamtestu.chytrak.cz>\n";
				//$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
				//Sending e-mail to the admin of the class
				require_once('mailer.php');
				sendEmail($email,$email_subject,$email_body);
				
				//Logging the application
				$user = $_SESSION['user'];
				fileLog("Uživatel $user zažádal o přijetí do třídy $class");
				
				//Redirecting to the home page
				echo "<script>alert('Vaše žádost o přijetí do této třídy byla odeslána. O přijetí nebo zamítnutí požadavku se dozvíte pomocí e-mailu.');</script>";
				echo "<script type='text/javascript'>location.href = 'home.php';</script>";
			}
		?>
	</div>
</body>
