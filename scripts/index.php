<?php session_start(); ?>

<meta charset="utf-8">
<link rel="shortcut icon" href="../favicon.ico">
<link rel="stylesheet" href="styles/index.css">
<body>
	<div id="main">
		<div id="welcomeText">Vítej na seznamtestu.chytrak.cz.<br />Pro pokračování klikni na tlačítko.</div>
		<form action="scripts/login.php" id="enterForm">
			<input type=submit value="Vstoupit" id="enterButton">
		</form>
	</div>
	<hr />
	<div id="news">
	</div>
</body>