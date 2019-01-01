<?php
	$language = $_GET['lang'];
	if (empty($language))
	{
		$language = 'en';
	}
	$urlExtension = "?lang=$language";
	
	
	$avalibeLanguages = array('en','pl');
	
	if (in_array($language,$avalibeLanguages))
	{
		if ($_SERVER['SCRIPT_FILENAME'] == "/home/u203826608/domains/examdirectory.online/public_html/index.php")
		{
			$langFile = "lang/$language.php";
		}
		else
		{
			$langFile = "../lang/$language.php";
		}
		include "$langFile";
	}
	else
	{
		echo "Selected language is unavalible";
	}
?>