<?php
	require_once('connect.php');
	include 'logger.php';
	
	//Getting data from cookies
	$nickname = $_COOKIE['nickname'];
	$message = urldecode($_COOKIE['message']);
	$class = $_COOKIE['class'];
	$admin = $_COOKIE['admin'];
	$action = $_COOKIE['action'];
	
	//Perform a action depending on $action value
	switch($action){
		case 'a':	//Accepting the application
			//Updating users's memberIn list in the database
			$query = "SELECT memberIn FROM users WHERE name='$nickname'";
			$result = mysqli_query($connection, $query);
			if(!$result){echo mysqli_error($connection);}
			else{
				$result = mysqli_fetch_array($result);
				$result = $result['memberIn'];
				if($result == "0"){$result = $class;}
				else{$result .= (','.$class);}
				$query = "UPDATE users SET memberIn = $result WHERE name='$nickname'";
			}
			unset($result);
			$result = mysqli_query($connection, $query);
			
			//Check for errors
			if(!$result){echo mysqli_error($connection);}
			unset($result);
			
			//Building e-mail for the user
			
			$query = "SELECT name FROM classes WHERE id='$class'";
			$result = mysqli_query($connection, $query);
			$result = mysqli_fetch_array($result);
			$classname = $result['name'];
			
			$query = "SELECT email FROM users WHERE name='$nickname'";
			$result = mysqli_query($connection, $query);
			$result = mysqli_fetch_array($result);
			$email = $result['email'];
			
			$email_subject = "Žádost o přijetí do třídy $classname.";
			//Building e-mail body
			$email_body = "
			<div style='width: 50%; border: 2px solid black; margin: auto; background-color: #FFFF99; padding:10px;text-align:center'>
				<h2 style='position:relative;left:0;right:0;margin:auto;'>Stav vaší žádosti</h2>
				<fieldset style='width: 50%; position: relative; left:0; right:0; margin: auto;border-radius:20px;'>
					<span style='font-size: 1.5em;'>
						Blahopřejeme, vaše žádost o přijetí do třídy $classname byla<br /><b style='color:limegreen;'>schválena</b>.<br />Vaší žádost vyřizoval uživatel $admin.
					</span>
				</fieldset>
				<br /><i>Žádosti o přijetí do dalších tříd můžete zaslat na stránkách seznamtestu.chytrak.cz.
				<br />Pokud chcete tuto třídu opustit, můžete tak učinit na stránce se seznamam tříd.
				<br />Tento e-mail byl vygenerován automaticky a tudíž na něj neodpovídejte.</i>
				<hr /><span style='color: rgb(102,102,102)';>Nechcete od nás dostávat další e-maily? Odhlašte se z odběru e-mailů <a href='seznamtestu.chytrak.cz'>zde</a>.</span>
				<br /><span style='color: rgb(135,135,135)';>Toto zruší pouze automaticky odesílané e-maily. Pokud odešlete dotaz nebo připomínku, stále můžete dostat webmasterem psanou odpověď.</span>
			</div>
			";
			
			//Sending e-mail to the user
			require_once('mailer.php');
			sendEmail($email,$email_subject,$email_body);
            
			//Logging the accpetence
			filelog("Uživatel $nickname byl přijat do třídy $result uživatelem $admin.");
			
			echo "$nickname\n$message\n$class\n$action\n$admin";	//Controll outputs
			echo "\n $message";

			//Remove answered application from the database
			$query = "DELETE FROM applications WHERE nickname='$nickname' AND message='$message' AND class='$class'";
			
			break;
			
		case 'd':	//Declining the application
			//Building e-mail for the user
			
			$query = "SELECT name FROM classes WHERE id='$class'";
			$result = mysqli_query($connection, $query);
			$result = mysqli_fetch_array($result);
			$classname = $result['name'];
			
			$query = "SELECT email FROM users WHERE name='$nickname'";
			$result = mysqli_query($connection, $query);
			$result = mysqli_fetch_array($result);
			$email = $result['email'];
			
			$email_subject = "Žádost o přijetí do třídy $classname.";
			//Building e-mail body
			$email_body = "
			<div style='width: 50%; border: 2px solid black; margin: auto; background-color: #FFFF99; padding:10px;text-align:center'>
				<h2 style='position:relative;left:0;right:0;margin:auto;'>Stav vaší žádosti</h2>
				<fieldset style='width: 50%; position: relative; left:0; right:0; margin: auto;border-radius:20px;'>
					<span style='font-size: 1.5em;'>
						Je nám líto, ale vaše žádost o přijetí do třídy $classname byla<br /><b style='color:red;'>zamítnuta</b>.<br />Vaší žádost vyřizoval uživatel $admin.
					</span>
				</fieldset>
				<br /><i>Novou žádost můžete zaslat na stránkách seznamtestu.chytrak.cz.
				<br />Pokud chcete znovu zažádat o přijetí do této třídy, doporučujeme vám napsat lepší text žádosti.
				<br />Tento e-mail byl vygenerován automaticky a tudíž na něj neodpovídejte.</i>
				<hr /><span style='color: rgb(102,102,102)';>Nechcete od nás dostávat další e-maily? Odhlašte se z odběru e-mailů <a href='seznamtestu.chytrak.cz'>zde</a>.</span>
				<br /><span style='color: rgb(135,135,135)';>Toto zruší pouze automaticky odesílané e-maily. Pokud odešlete dotaz nebo připomínku, stále můžete dostat webmasterem psanou odpověď.</span>
			</div>
			";
			
			//Sending e-mail to the user
			require_once('mailer.php');
			sendEmail($email,$email_subject,$email_body);
			
			//Logging the declinence
			filelog("Žádost uživatel $nickname o přijetí do třídy $class byla zamítnuta uživatelem $admin.");
			
			echo "$nickname\n$message\n$class\n$action\n$admin";	//Controll outputs
			echo "\n $message";

			//Remove answered application from the database
			$query = "DELETE FROM applications WHERE nickname='$nickname' AND message='$message' AND class='$class'";
			
			break;
			
			case 'n'://Changin name of the class
				echo $class;
				$query = "UPDATE classes SET name= '$class' WHERE name='$nickname'";
				break;
	}
	
	echo "\n";
	echo $query;
	$result = mysqli_query($connection, $query);
	
	//Check for errors
	if(!$result){echo mysqli_error($connection);}
	mysqli_close($connection);
	echo "Database has been altered.";	//Controll output
?>