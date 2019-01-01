<?php
	session_start();
	include 'scripts/languageHandler.php';
?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	<!-- This has no use so far -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="stylesheet" href="styles/index.css">
	<title><?php echo $lang['title']; ?></title>
</head>
<body>
	<fieldset>
		<article>
			<div id="main">
				<div id="welcomeText"><?php echo $lang['welcome1']; ?><br /><?php echo $lang['welcome2']; ?></div>
				<a href="scripts/login.php<?php echo $urlExtension; ?>"><button id="enterButton"><?php echo $lang['enter']; ?></button></a>
			</div>
		</article>
		
		<article>
			<div id="newsText">
				<span id="newsHeader"><?php echo $lang['news']; ?></span>
				<?php
					include 'scripts/news.php';
				?>
			</div>
		</article>
	</fieldset>
</body>
