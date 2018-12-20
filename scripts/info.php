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
		<h1>About</h1>
		<br />
		Creator: Jan Štěch
		<br />
		Created in 2018
	</span>
	<br />
	<div id="news">
		<?php
			include 'news.php';
		?>
	</div>
	<a href="javascript:history.go(-1)">Return</a>
</body>
