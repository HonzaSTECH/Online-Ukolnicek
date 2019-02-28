<?php
	$language = $_GET['lang'];
	if (empty($language))
	{
		$language = 'en';
	}
	$urlExtension = "?lang=$language";
	
	
	$avalibeLanguages = array('en','pl','cn','cs');
	
	if (!in_array($language,$avalibeLanguages))
	{
		echo "Selected language is unavalible";
		$language = 'en';
	}
	
	if ($_SERVER['SCRIPT_FILENAME'] == "/home/u203826608/domains/examdirectory.online/public_html/index.php")
	{
		$langFile = "lang/$language.php";
	}
	else
	{
		$langFile = "../lang/$language.php";
	}
	include "$langFile";
	
	//echo "<script>console.log('Selected language: ".$_SESSION['langTemp']."');</script>"; //For debug reasons only*/
}
	
?>