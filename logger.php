<?php
	function fileLog($message, $file='log.txt', $prefix='DATE'){
		
		if($prefix == 'DATE'){$prefix = '['.date('d. m. y - H:i:s').'] ';}
		
		$logFile = fopen($file, 'a');
		fwrite($logFile, $prefix.$message.'~'.PHP_EOL);
		fclose($logFile);
	}
?>