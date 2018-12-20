<?php
	require_once('connect.php');
	include 'logger.php';
	
	//Getting data from cookies
	$nickname = @$_COOKIE['nickname'];
	$message = @urldecode($_COOKIE['message']);
	$class = @$_COOKIE['class'];
	$admin = @$_COOKIE['admin'];
	$action = @$_COOKIE['action'];
	
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
			
			$email_subject = "Application for admission into class $classname.";
			//Building e-mail body
			$email_body = "
			<div style='width: 50%; border: 2px solid black; margin: auto; background-color: #FFFF99; padding:10px;text-align:center'>
				<h2 style='position:relative;left:0;right:0;margin:auto;'>Stav vaší žádosti</h2>
				<fieldset style='width: 50%; position: relative; left:0; right:0; margin: auto;border-radius:20px;'>
					<span style='font-size: 1.5em;'>
						Congratulations, your application for admission into class $classname has been<br /><b style='color:limegreen;'>approved</b>.<br />Your application was processed by $admin.
					</span>
				</fieldset>
				<br /><i>You can send more applications for admission into other classes on examdirectory.online.
				<br />If you want to leave the class, you can do so on the webpage with list of classes.
				<br />This e-mail has been generated automatically and therefore do not answer it.</i>
				<hr /><span style='color: rgb(102,102,102)';>Don't want to get more e-mails from us? Unsubscribe <a href='seznamtestu.chytrak.cz'>zde</a>.</span>
				<br /><span style='color: rgb(135,135,135)';>This will stop only automatically generated e-mails. If you send us your opinion, a question or a suggestion, you can still get manually written answer from the webmaster.</span>
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
						We are sorry, but your application for admission into class $classname has been <br /><b style='color:red;'>rejected</b>.<br />Your application was processed by $admin.
					</span>
				</fieldset>
				<br /><i>You can send a new application for admission on examdirectory.online.
				<br />If you want to apply for admission into the same class again, we recommend you to write a better content of the application.
				<br />This e-mail has been generated automatically and therefore do not answer it.</i>
				<hr /><span style='color: rgb(102,102,102)';>Don't want to get more e-mails from us? Unsubscribe <a href='seznamtestu.chytrak.cz'>zde</a>.</span>
				<br /><span style='color: rgb(135,135,135)';>This will stop only automatically generated e-mails. If you send us your opinion, a question or a suggestion, you can still get manually written answer from the webmaster.</span>
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
			
		case 'n':	//Changin name of the class
			$query = "UPDATE classes SET name='$class' WHERE name='$nickname'";
			break;
			
		case 'c':	//Closing the class
			$query = "UPDATE classes SET open=false WHERE name='$nickname'";
			break;
			
		case 'o':	//Opening the class
			$query = "UPDATE classes SET open=true WHERE name='$nickname'";
			break;
		
		case 'r':	//Removing all applications to the class
			$query = "DELETE FROM applications WHERE class=$class";
			break;
			
		case 'e':	//Erasing the class
			unset($_COOKIE['admin']);	//Erasing the admin password from the cookie
			$_COOKIE['admin'] = null;
			
			$query = "SELECT password FROM users WHERE name='$nickname'";
			$result = mysqli_query($connection, $query);
			$result = mysqli_fetch_array($result);
			$result = $result['password'];
			if (password_verify($admin, $result))
			{
				
			}
			break;
			
		case 'E':	//Erasing class coonfirmed
			$deletionTime = time() + 86400;	//86400 seconds = 1 day (24 hours)
			$query = "UPDATE classes SET deletionTime=$deletionTime WHERE admin=$nickname";
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
