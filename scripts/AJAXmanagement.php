<?php
	session_start();
	require_once('connect.php');
	include 'logger.php';
	include 'languageHandler.php';
	
	//Getting data from cookies
	$nickname = @$_COOKIE['nickname'];
	$message = @urldecode($_COOKIE['message']);
	$class = @$_COOKIE['class'];
	$admin = @$_COOKIE['admin'];
	$action = @$_COOKIE['action'];
	//if(empty($action)){$action = $_GET['action'];}
	
	//Perform a action depending on $action value
	switch($action){
		case 'a':	//Accepting the application
			//Updating users's memberIn list in the database
			$query = "SELECT memberIn FROM users WHERE name='$nickname'";
			$result = mysqli_query($connection, $query);
			if(!$result){echo mysqli_error($connection);}
			else
			{
				$result = mysqli_fetch_array($result);
				$result = $result['memberIn'];
				if($result == "0"){$result = $class;}
				else{$result .= (','.$class);}
				$query = "UPDATE users SET memberIn = '$result' WHERE name='$nickname'";
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
			
			$email_subject = $lang['classManagementEmailSubject']." $classname.";
			//Building e-mail body
			$email_body = "
			<div style='width: 50%; border: 2px solid black; margin: auto; background-color: #FFFF99; padding:10px;text-align:center'>
				<h2 style='position:relative;left:0;right:0;margin:auto;'>".$lang['classManagementEmailHeader']."</h2>
				<fieldset style='width: 50%; position: relative; left:0; right:0; margin: auto;border-radius:20px;'>
					<span style='font-size: 1.5em;'>
						".$lang['classManagementEmailSuccessLore1']."$classname".$lang['classManagementEmailLore2']."<br /><b style='color:limegreen;'>".$lang['classManagementEmailSuccessLore3']."</b>.<br />".$lang['classManagementEmailLore4']."$admin.
					</span>
				</fieldset>
				<br /><i>".$lang['classManagementEmailSuccessFooter1']."
				<br />".$lang['classManagementEmailSuccessFooter2']."
				<br />".$lang['EmailBottomLore']."</i>
				<hr /><span style='color: rgb(102,102,102)';>".$lang['applyEmailFooter1']." <a href='seznamtestu.chytrak.cz'>".$lang['hereLink']."</a>.</span>
				<br /><span style='color: rgb(135,135,135)';>".$lang['applyEmailFooter2']."</span>
			</div>
			";
			
			//Sending e-mail to the user
			require_once('mailer.php');
			sendEmail($email,$email_subject,$email_body);
            
			//Logging the accpetence
			filelog("Uživatel $nickname byl přijat do třídy $classname uživatelem $admin.");
			
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
			
			$email_subject = "".$lang['classManagementEmailSubject']." $classname.";
			//Building e-mail body
			$email_body = "
			<div style='width: 50%; border: 2px solid black; margin: auto; background-color: #FFFF99; padding:10px;text-align:center'>
				<h2 style='position:relative;left:0;right:0;margin:auto;'>".$lang['classManagementEmailHeader']."</h2>
				<fieldset style='width: 50%; position: relative; left:0; right:0; margin: auto;border-radius:20px;'>
					<span style='font-size: 1.5em;'>
						".$lang['classManagementEmailFailLore1']."$classname".$lang['classManagementEmailLore2']."<br /><b style='color:red;'>".$lang['classManagementEmailFailLore3']."</b>.<br />".$lang['classManagementEmailLore4']."$admin.
					</span>
				</fieldset>
				<br /><i>".$lang['classManagementEmailFailFooter1']."
				<br />".$lang['classManagementEmailFailFooter2']."
				<br />".$lang['EmailBottomLore']."</i>
				<hr /><span style='color: rgb(102,102,102)';>".$lang['applyEmailFooter1']." <a href='seznamtestu.chytrak.cz'>".$lang['hereLink']."</a>.</span>
				<br /><span style='color: rgb(135,135,135)';>".$lang['applyEmailFooter2']."</span>
			</div>
			";
			
			//Sending e-mail to the user
			require_once('mailer.php');
			sendEmail($email,$email_subject,$email_body);
			
			//Logging the declinence
			filelog("Žádost uživatel $nickname o přijetí do třídy $classname byla zamítnuta uživatelem $admin.");
			
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
			$nickname = $_GET['admin'];
			$query = "SELECT password FROM users WHERE name='$nickname'";
			$result = mysqli_query($connection, $query);
			$result = mysqli_fetch_array($result);
			$result = $result['password'];
			$admin = $_GET['pass'];
			if (password_verify($admin, $result))
			{
				echo "confirmed";
			}
			else
			{
				echo "error";
			}
			unset($query);
			break;
			
		case 'E':	//Erasing class confirmed
			$classId = $_SESSION['class'];
			$deletionTime = time() + 86400;	//86400 seconds = 1 day (24 hours)
			$query = "UPDATE classes SET deletionTime=$deletionTime WHERE id=$classId";
			break;
			
		case 's':	//Canceling the deletion process
			$classId = $_SESSION['class'];
			$query = "UPDATE classes SET deletionTime='0' WHERE id=$classId";
			break;
		
		case 't':	//Reloading time to deletion
			$classId = $_SESSION['class'];
			$query = "SELECT deletionTime FROM classes WHERE id=$classId";
			$result = mysqli_query($connection, $query);
			$result = mysqli_fetch_array($result);
			$result = $result['deletionTime'];
			$timeToDeletion = (int)$result - time();
			$hoursToDeletion = floor($timeToDeletion / 3600);
			$timeToDeletion %= 3600;
			$minutesToDeletion = floor($timeToDeletion / 60);
			$secondsToDeletion = $timeToDeletion % 60;
			echo "$hoursToDeletion:$minutesToDeletion:$secondsToDeletion";
			unset($query);
			break; 
		
		case 'k':	//Kicking a user out of class
			$query = "SELECT memberIn,modIn,adminIn FROM users WHERE name='".$nickname."'";
			$result = mysqli_query($connection,$query);
			$result = mysqli_fetch_array($result);
			$memberClasses = $result['memberIn'];
			$modClasses = $result['modIn'];
			$adminClasses = $result['adminIn'];
			
			$classId = $_SESSION['class'];
			
			$memberClasses = explode(',',$memberClasses);
			$modClasses = explode(',',$modClasses);
			$adminClasses = explode(',',$adminClasses);
			
			$key = array_search($classId, $memberClasses);
			unset($memberClasses[$key]);
			$key = array_search($classId, $modClasses);
			unset($modClasses[$key]);
			$key = array_search($classId, $adminClasses);
			unset($adminClasses[$key]);
			
			if (count($memberClasses) >= 2){$memberClasses = implode(',',$memberClasses);}
			else if (count ($memberClasses) == 1){$memberClasses = $memberClasses[0];}
			else {$memberClasses = "0";}
			
			if (count($modClasses) >= 2){$modClasses = implode(',',$modClasses);}
			else if (count ($modClasses) == 1){$modClasses = $modClasses[0];}
			else {$modClasses = "0";}
			
			if (count($adminClasses) >= 2)$adminClasses = implode(',',$adminClasses);
			else if (count ($adminClasses) == 1){$adminClasses = $adminClasses[0];}
			else {$adminClasses = "0";}
			
			$query = "UPDATE users SET memberIn='$memberClasses',modIn='$modClasses',adminIn='$adminClasses' WHERE name='$nickname'";
			echo $query;
			break;
			
		case 'u':
			$classId = $_SESSION['class'];
			$query = "SELECT modIn FROM users WHERE nickname=$nickname";
			$result = mysqli_query($connection, $query);
			$result = mysqli_fetch_array($result);
			$modClasses = $result['modIn'];
			$modClasses = explode(',',$modClasses);
			
			if($message == "mod")
			{
				if(!in_array($classId, $modClasses))
				{
					//Adding the ID of the class into the array of moderator classes
					$modClasses[count($modClasses)] = $classId;
					asort($modClasses);	//Sorting in ascending order
				}
			}
			else if($message == "member")
			{
				if(in_array($classId, $modClasses))
				{
					//Removing the ID of the class from the array of moderator classes
					$key = array_search($classId, $modClasses);
					unset($modClasses[$key]);
					asort($modClasses);	//Sorting in ascending order
				}
			}
			$modClasses = implode(',',$modClasses);
			$query = "UPDATE users SET modIn='$modClasses' WHERE name='$nickname'";
			
			break;
	}
	
	//echo "\n";				//Controll output
	//echo $query;				//Controll output
	if(isset($query)){$result = mysqli_query($connection, $query);}
	
	//Check for errors
	if(!$result){echo mysqli_error($connection);}
	mysqli_close($connection);
	//echo "Database has been altered.";	//Controll output
?>
