<?php session_start(); ?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="images/transparentMarklessLogo.ico">
	<link rel="stylesheet" href="styles/index.css">
</head>
<body>
	<fieldset>
		<article>
			<div id="main">
				<div id="welcomeText">Welcome to examdirectory.online.<br />Click the button below to continue.</div>
				<a href="scripts/login.php"><button id="enterButton">Enter</button></a>
			</div>
		</article>
		
		<article>
			<div id="newsText">
				<span id="newsHeader">News</span>
				<?php
					include 'scripts/news.php';
				?>
			</div>
		</article>
	</fieldset>
</body>
