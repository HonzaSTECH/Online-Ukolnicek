<?php
	session_start(); 
	require 'checker.php';
	check(true);
?>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../images/transparentMarklessLogo.ico">
	<link rel="stylesheet" href="../styles/info.css">
</head>
<body>
	<span>
		<h1>O aplikaci</h1>
		<br />
		Tvůrce: Jan Štěch
		<br />
		Vytvořeno v roce 2018
	</span>
	<br />
	<div id="news">
		<?php
			include 'news.php';
		?>
	</div>
	<a href="home.php">Návrat</a>
</body>