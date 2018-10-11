<?php
	if ($_SERVER['SCRIPT_FILENAME'] == "/3w/chytrak.cz/s/seznamtestu/index.php"){$read = file("news.txt");}
	else{$read = file("../news.txt");}
	
	foreach ($read as $line){echo $line."<br />";}
?>