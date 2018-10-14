<?php session_start(); ?>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="images/transparentMarklessLogo.png">
	<link rel="stylesheet" href="styles/index.css">
</head>
<body>
	<div id="main">
		<div id="welcomeText">Vítej na seznamtestu.chytrak.cz.<br />Pro pokračování klikni na tlačítko.</div>
		<form action="scripts/login.php" id="enterForm">
			<input type=submit value="Vstoupit" id="enterButton">
		</form>
	</div>
	<hr />
	<div id="news">
		<?php
			include 'scripts/news.php';
		?>
	</div>
</body>