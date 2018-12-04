<?php
	if ($_SERVER['SCRIPT_FILENAME'] == "/home/u203826608/domains/examdirectory.online/public_html/index.php"){$read = file("news.txt");}
	else{$read = file("../news.txt");}
	
	foreach ($read as $line){echo $line."<br />";}
?>