<?php
	session_start();
	include 'languageHandler.php';
	require 'checker.php';
	check($urlExtension, true, true, true);
	require 'connect.php';
?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="../images/transparentMarklessLogo.ico">
		<link rel="stylesheet" href="../styles/classManagement.css">
		<script src="classManagement.js"></script>
		<script>//Functions requiring translations
				function changeClassName(originalValue)
				{
					document.getElementById("className").removeAttribute("disabled");
					document.getElementById("changeClassName").innerHTML = "<?php echo $lang['saveButton']; ?>";
					document.getElementById("changeClassName").setAttribute("onclick","saveClassName('" + originalValue + "')");
					document.getElementById("cancelNameChange").style.display = "inline";
				}
				
				function saveClassName(originalValue)
				{
					document.getElementById("className").setAttribute("disabled", "1");
					document.getElementById("changeClassName").innerHTML = "<?php echo $lang['changeButton']; ?>";
					document.getElementById("changeClassName").setAttribute("onclick","changeClassName()");
					document.getElementById("cancelNameChange").style.display = "none";
					
					var newName = document.getElementById("className").value;
					document.cookie = "nickname=" + originalValue;
					document.cookie = "class=" + newName;
					document.cookie = "action=n"
					
					getRequest("AJAXmanagement.php", testFunc, testFunc);
				}
				
				function cancelNameChange(originalValue)
				{
					document.getElementById("className").setAttribute("disabled", "1");
					document.getElementById("className").innerHTML = originalValue;
					document.getElementById("changeClassName").innerHTML = "<?php echo $lang['changeButton']; ?>";
					document.getElementById("changeClassName").setAttribute("onclick","changeClassName()");
					document.getElementById("cancelNameChange").style.display = "none";
				}
				
				function changeClassStatus(originalValue, classNm, classId)
				{
					var action;
					if(originalValue == true || originalValue == 1){action = "close";}
					else{action = "open"}
					
					var newButtonValue = (action == "open") ? "<?php echo $lang['lockButton']; ?>" : "<?php echo $lang['openButton']; ?>";
					var newValue = (action == "open") ? 1 : 0;
					var newText = (action == "open") ? "<?php echo $lang['openedClass']; ?>" : "<?php echo $lang['closedClass']; ?>";
					
					document.getElementById("changeClassStatus").innerHTML = newButtonValue;
					document.getElementById("changeClassStatus").setAttribute("onclick", "changeClassStatus(" + newValue + ",'" + classNm +"'," + classId +")");
					document.getElementById("classStatus").innerHTML = newText;
					
					document.cookie = "nickname=" + classNm;
					document.cookie = "action=" + action.charAt(0);		//c or o
					
					getRequest("AJAXmanagement.php", testFunc, testFunc);
					
					if(action == "close")
					{
						var clearApplications = confirm("<?php echo $lang['classLockAlertText']; ?>");
						if(clearApplications == true)
						{
							document.cookie = "nickname=" + classNm;
							document.cookie = "class=" + classId;
							document.cookie = "action=r";
					
							getRequest("AJAXmanagement.php", testFunc, testFunc);
						}
					}
				}
				
				function deleteClass(username)
				{
					document.getElementById("deleteClassInfo").style.display = "block";
					document.getElementById("deleteClassInput").style.display = "inline";
					document.getElementById("deleteClassCancel").style.display = "inline";
					document.getElementById("deleteClass").innerHTML = "<?php echo $lang['confirm']; ?>";
					document.getElementById("deleteClass").setAttribute("onclick","deleteClass2('" + username + "')");
				}
				function cancelClassDelete(){
					document.getElementById("deleteClassInfo").style.display = "none";
					document.getElementById("deleteClassInput").style.display = "none";
					document.getElementById("deleteClassCancel").style.display = "none";
					document.getElementById("deleteClassInput").value = "";
					document.getElementById("deleteClass").setAttribute("onclick","deleteClass('<?php echo $_SESSION['user']; ?>')");
					document.getElementById("deleteClass").innerHTML = "<?php echo $lang['deleteButton']; ?>";
				}
				function deleteClass2(username)
				{
					var adminPass = document.getElementById("deleteClassInput").value;
					document.getElementById("deleteClassInput").value = "";
					document.cookie = "action=e";
					getRequest(("AJAXmanagement.php?pass=" + adminPass + "&admin=" + username), deleteClass3, testFunc);
				}
				function deleteClass3(response)
				{
					console.log(response);
					if(response != "confirmed")
					{
						alert("<?php echo $lang['passFailLogin']; ?>!");
					}
					else if(response === "confirmed")
					{
						var confirmation = confirm("<?php echo $lang['deleteClassFinal1']; ?>\n<?php echo $lang['deleteClassFinal2']; ?>");
						if(confirmation == true)
						{
							//Affecting the DOM
							document.getElementById("deleteClass").style.display = "none";
							document.getElementById("deleteClassCancel").style.display = "none";
							document.getElementById("deleteClassInput").style.display = "none";
							document.getElementById("deleteClassInfo").style.display = "none";
							document.getElementById("timeToDeletion").style.display = "block";
							document.getElementById("recoverClass").style.display = "inline";
							document.getElementById("timeToDeletion").innerHTML = "<?php echo $lang['timeToDelete']; ?> 24:00:00 <span>    </span><button onclick='reloadDeletionTime()' id='timeReloadButton'><img src='../images/reload.png'/ ></button>";
							document.getElementById("deleteClass").innerHTML = "<?php echo $lang['deleteButton']; ?>";
							
							//Saving action into cookie, so PHP can access it
							document.cookie = "action=E";
							
							//Opening AJAX request
							getRequest("AJAXmanagement.php", testFunc, testFunc);
						}
					}
				}
				function updateDeletionTime(response)
				{
					document.getElementById("timeToDeletion").innerHTML = "<?php echo $lang['timeToDelete']; ?> " + response + "<span>    </span><button onclick='reloadDeletionTime()' id='timeReloadButton'><img src='../images/reload.png'/ ></button>";
					document.getElementById("deleteClass").style.display = "none";	//I don't know why, but the button gets displayed after reloading the time
				}
				function recoverClass()
				{
					//Affecting DOM
					document.getElementById("deleteClass").setAttribute("onclick","deleteClass('<?php echo $_SESSION['user']; ?>')");
					document.getElementById("deleteClass").style.display = "inline";
					document.getElementById("timeToDeletion").style.display = "none";
					document.getElementById("recoverClass").style.display = "none";
					
					//Saving action into cookie, so PHP can access it
					document.cookie = "action=s";
					
					//Opening AJAX request
					getRequest("AJAXmanagement.php", testFunc, testFunc);
					
				}
				function updateRank(event)
				{
					var nickname = event.target.parentNode.parentNode.childNodes[1].innerHTML;
					var newRank = event.target.value;	//"member" or "mod"
					
					//Affecting DOM
					if (newRank == "mod")
					{
						event.target.parentNode.parentNode.childNodes[0].innerHTML = "<?php echo $lang['mod']; ?>";
						event.target.parentNode.parentNode.childNodes[0].setAttribute("class","rank2");
					}
					if (newRank == "member")
					{
						event.target.parentNode.parentNode.childNodes[0].innerHTML = "<?php echo $lang['member']; ?>";
						event.target.parentNode.parentNode.childNodes[0].setAttribute("class","rank1");
					}
					
					//Saving action into cookie, so PHP can access it
					document.cookie = "nickname=" + nickname;
					document.cookie = "message=" + newRank;
					document.cookie = "action=u";
					
					getRequest("AJAXmanagement.php", testFunc, testFunc)
				}
				function kickUser(event)
				{
					var confirmation = confirm("<?php echo $lang['kickConfirm']; ?>");
					if (confirmation == true)
					{
						var user = event.target.parentNode.parentNode.childNodes[1].innerHTML;
						var admin = document.getElementById("username").innerHTML.split(" ");
						admin = admin[admin.length - 1];
						
						//Removing the user from DOM
						event.target.parentNode.parentNode.parentNode.removeChild(event.target.parentNode.parentNode);
						
						//Save nickname of the user, admin's nickname and action into cookie so PHP can access it
						document.cookie = "nickname=" + user;
						document.cookie = "admin=" + admin;
						document.cookie = "action=k";
						
						getRequest("AJAXmanagement.php", testFunc, testFunc);
					}
				}
				function accept(event)
				{
					//Getting application details
					var nickname = event.target.parentNode.parentNode.childNodes[0].innerHTML;
					var message =  event.target.parentNode.parentNode.childNodes[3].childNodes[0].innerHTML;
					var applyClass = event.target.parentNode.parentNode.childNodes[5].innerHTML;
					
					var user = document.getElementById("username").innerHTML.split(" ");
					user = user[user.length - 1];
					
					//Removing the application from DOM
					event.target.parentNode.parentNode.parentNode.removeChild(event.target.parentNode.parentNode);
					
					message = message.replace(/\r\n/g, '<br>').replace(/[\r\n]/g, '<br>');
					
					//Save nickname, message and class value into cookie so PHP can access it
					document.cookie = "nickname=" + nickname;
					document.cookie = "message=" + encodeURIComponent(message);
					document.cookie = "class=" + applyClass;

					document.cookie = "admin=" + user;
					document.cookie = "action=a";
					
					//Opening AJAX request
					getRequest("AJAXmanagement.php<?php echo $urlExtension; ?>", testFunc, testFunc);
				}
				function decline(event)
				{
					//Getting application details
					var nickname = event.target.parentNode.parentNode.childNodes[0].innerHTML;
					var message =  event.target.parentNode.parentNode.childNodes[3].childNodes[0].innerHTML;
					var applyClass = event.target.parentNode.parentNode.childNodes[5].innerHTML;
					
					var user = document.getElementById("username").innerHTML.split(" ");
					user = user[user.length - 1];
					
					//Removing the application from DOM
					event.target.parentNode.parentNode.parentNode.removeChild(event.target.parentNode.parentNode);
					
					message = message.replace(/\r\n/g, '<br>').replace(/[\r\n]/g, '<br>');
					
					//Save nickname, message and class value into cookie so PHP can access it
					document.cookie = "nickname=" + nickname;
					document.cookie = "message=" + encodeURIComponent(message);
					document.cookie = "class=" + applyClass;

					document.cookie = "admin=" + user;
					document.cookie = "action=d";
					
					//Opening AJAX request
					getRequest("AJAXmanagement.php<?php echo $urlExtension; ?>", testFunc, testFunc);
				}
		</script>
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
			<a href="list.php<?php echo $urlExtension; ?>">
				<div id="classBox">
					<span id="classLink"><?php echo $lang['class']; ?></span>
				</div>
			</a>
		</div>
		<div id="main">
			<nav>
				<a onclick="firstTab()"><?php echo $lang['generalTab']; ?></a>
				<a onclick="secondTab()"><?php echo $lang['subjectsTab']; ?></a>
				<a onclick="thirdTab()"><?php echo $lang['membersTab']; ?></a>
				<a onclick="fourthTab()"><?php echo $lang['applicationsTab']; ?></a>
			</nav>
			<div id="container">
				<div id="tab1">
					<?php echo $lang['classId'].": "; ?>
					<?php
						//Displaying ID of the class
						echo $_SESSION['class'];
					?>
					<br />
					
					<?php echo $lang['className'].": "; ?>
					<?php
						//Displaying name of the class
						$classId = $_SESSION['class'];
						$query = "SELECT name FROM classes WHERE id=$classId";
						$result = mysqli_query($connection, $query);
						$result = mysqli_fetch_array($result);
						$className = $result['name'];
						echo "<input type='text' id='className' value='$className' disabled>    ";
					?>
					<button onclick="changeClassName('<?php echo $className; ?>')" id="changeClassName"><?php echo $lang['changeButton']; ?></button>
					<button onclick="cancelNameChange('<?php echo $className; ?>')" id="cancelNameChange"><?php echo $lang['cancel']; ?></button>
					<br />
					
					<?php echo $lang['classStatus']; ?>
					<?php
						//Displaying status (opened/locked) of the class
						$query = "SELECT open FROM classes WHERE id=$classId";
						$result = mysqli_query($connection, $query);
						$result = mysqli_fetch_array($result);
						$result = $result['open'];
						
						if(empty($result)){$result = false;}	//Just to make sure
						else {$result = true;}
						
						if ($result == true){echo "<span id='classStatus'>".$lang['openedClass']."</span>"; $statusAction = $lang['lockButton'];}
						else{echo "<span id='classStatus'>".$lang['closedClass']."</span>"; $statusAction = $lang['openButton'];}
					?>
					<button onclick="changeClassStatus(<?php echo $result.",'".$className."' ,".$classId; ?>)" id="changeClassStatus"><?php echo $statusAction; ?></button>
					<br />

					<span id="deleteClassInfo">
						<?php echo $lang['deleteClassPassword1']; ?>
						<br />
						<?php echo $lang['deleteClassPassword2']; ?>
					</span>
					<input id="deleteClassInput" type="password"/>
					<button onclick="deleteClass('<?php echo $_SESSION['user']; ?>')" id="deleteClass"><?php echo $lang['deleteButton']; ?></button>
					<button onclick="cancelClassDelete()" id="deleteClassCancel"><?php echo $lang['cancel']; ?></button>
					<div id="timeToDeletion">
					<?php echo $lang['timeToDelete'];
						$query = "SELECT deletionTime FROM classes WHERE name='$className'";
						$result = mysqli_query($connection, $query);
						$result = mysqli_fetch_array($result);
						$result = $result['deletionTime'];
						if(!empty($result))
						{
							echo "<style>#deleteClass{display:none;}</style>";
							$timeToDeletion = $result - time();
							$hoursToDeletion = floor($timeToDeletion / 3600);
							$timeToDeletion %= 3600;
							$minutesToDeletion = floor($timeToDeletion / 60);
							$secondsToDeletion = $timeToDeletion % 60;
							echo "$hoursToDeletion:$minutesToDeletion:$secondsToDeletion";
						}
						else
						{
							echo "
							<style>
								#timeToDeletion{display: none;}
								#recoverClass{display: none;}
							</style>
							";
						}
					?>
						<span>    </span>
						<button onclick="reloadDeletionTime()" id="timeReloadButton"><img src="../images/reload.png"/></button>
					</div>
					<button onclick="recoverClass()" id="recoverClass"><?php echo $lang['stopDelete']; ?></button>
				</div>
				<div id="tab2">
					<?php
						//Displaying subjects in the class
						$class = $_SESSION['class'];
						$query = "SELECT subjects,subjectsColors FROM classes WHERE id='$class'";
						$result = mysqli_query($connection, $query);
						$result = mysqli_fetch_array($result);
						$subjects = $result['subjects'];
						$subColors = $result['subjectsColors'];
						$subjects = explode(',',$subjects);
						$subColors = explode(',',$subColors);
						echo "<table><tr><td></td><td>".$lang['subjectAbb']."</td><td>".$lang['subjectColor']."</td></tr>";
						$i = 0;
						foreach ($subjects as $subject)
						{
							$color = $subColors[$i];
							$i++;
							echo "<tr><td>$i. </td><td>";
							if ($subject!=''){echo $subject;}
							else {echo $lang['subjectNotSet'];}
							echo "</td><td style='background-color: $color'></td></tr>";
						}
						echo "</table>";
					?>
					
					<button id="changeSubjects" onclick="changeSubjects()"><?php echo $lang['editSubjects']; ?></button>
					
					<div id="subjectsForm">
						<form method="POST" action="classManagement.php<?php echo $urlExtension; ?>">
							<?php
								//Displaying subjects of the class as default values in the input fields
								$class = $_SESSION['class'];
								$query = "SELECT subjects,subjectsColors FROM classes WHERE id='$class'";
								$result = mysqli_query($connection, $query);
								$result = mysqli_fetch_array($result);
								$subjects = $result['subjects'];
								$colors = $result['subjectsColors'];
								$subjects = explode(',',$subjects);
								$colors = explode(',',$colors);
								
								for ($i = 1; $i <= 20; $i++)
								{
									echo "<input type=text maxlength=3 name='sub$i'";
									$j = $i - 1;
									if($subjects[$j] != ''){echo "value='$subjects[$j]'";}
									echo ">";
									$col = $colors[$j];
									echo "<input type=color name='col$i' value=$col>";
									echo"<br />";
								}
							?>
							<input type=submit value="<?php echo $lang['saveButton']; ?>" name="save">
							<button onclick="hideForm(event)"><?php echo $lang['cancel']; ?></button>
						</form>
						<?php
							//Handling form submit
							if(isset($_POST['save']))
							{
								$subjects = array();
								$colors = array();
								//TODO - make it look better
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
								
								array_push($colors, $_POST['col1']);
								array_push($colors, $_POST['col2']);
								array_push($colors, $_POST['col3']);
								array_push($colors, $_POST['col4']);
								array_push($colors, $_POST['col5']);
								array_push($colors, $_POST['col6']);
								array_push($colors, $_POST['col7']);
								array_push($colors, $_POST['col8']);
								array_push($colors, $_POST['col9']);
								array_push($colors, $_POST['col10']);
								array_push($colors, $_POST['col11']);
								array_push($colors, $_POST['col12']);
								array_push($colors, $_POST['col13']);
								array_push($colors, $_POST['col14']);
								array_push($colors, $_POST['col15']);
								array_push($colors, $_POST['col16']);
								array_push($colors, $_POST['col17']);
								array_push($colors, $_POST['col18']);
								array_push($colors, $_POST['col19']);
								array_push($colors, $_POST['col20']);
								
								//Connecting the subjects and colors together
								$subjects = implode(',',$subjects);
								$colors = implode(',',$colors);
								$class = $_SESSION['class'];

								//Updating the database
								$query = "UPDATE classes SET subjects = '$subjects', subjectsColors = '$colors' WHERE id = $class";
								unset($class);
								
								mysqli_query($connection, $query);
								
								//Reloading the page
								header("Refresh:0");
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
								echo "<tr><td class='rank3'>".$lang['admin']."</td><td class='username'>$user</td><td class='action'></td></tr>";
							}
							//Displaying moderators
							foreach($mods as $user)
							{
								echo "<tr><td class='rank2'>".$lang['mod']."</td><td class='username'>$user</td><td class='action'><select onchange='updateRank(event)'><option value='mod' selected>".$lang['mod']."</option><option value='member'>".$lang['member']."</option></select><button class='kickButton' onclick='kickUser(event)'>".$lang['memberKick']."</button></td></tr>";
							}
							//Displaying members
							foreach($members as $user)
							{
								echo "<tr><td class='rank1'>".$lang['member']."</td><td class='username'>$user</td><td class='action'><select onchange='updateRank(event)'><option value='mod'>".$lang['mod']."</option><option value='member' selected>".$lang['member']."</option></select><button class='kickButton' onclick='kickUser(event)'>".$lang['memberKick']."</button></td></tr>";
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
							if ($exist == 1){echo "<table border=1><tr><th align='center' id='nicknameHeader'>".$lang['nickname']."</th><th align='center' id='nameHeader'>".$lang['fName']."</th><th align='center' id='surnameHeader'>".$lang['lName']."</th><th align='center' id='messageHeader'>".$lang['applyPlaceholder']."</th><th align='center' id='actionHeader'>".$lang['action']."</td></tr>";}
							$a = $data['nickname'];
							$b = $data['name'];
							$c = $data['surname'];
							$d = $data['message'];
							echo "<tr><td align='center' class='nicknameColumn'>$a</td><td align='center' class='nameColumn'>$b</td><td align='center' class='surnameColumn'>$c</td><td align='center' class='messageColumn'><div class='messageBox'>$d</div></td><td align='center' class='actionColumn'><button onclick='accept(event)' class='acceptButton'>".$lang['approve']."</button><br /><button onclick='decline(event)' class='declineButton'>".$lang['reject']."</button></td><td class='hiddenClass'>$class</td></tr>";
						}
						
						//Checking for an existing application
						if($exist > 0){echo "</table>";}
						else {echo $lang['noApplications'];}
						
						unset($exist);
					?>
				</div>
			</div>
		</div>
	</body>
<html>
