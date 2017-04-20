<?php	
	$log_file = "sound_log.txt";
	$hds = $_POST["data"];
	date_default_timezone_set["UTC"];
	$str = gmdate("M d Y H:i:s",time()).";".$hds."\r\n";

	$fp = fopen($log_file,"a");			//Save to file sound_log.txt for Google API version
	fwrite($fp,$str);
	fclose($f);
	
	$f = fopen("sound.log","a");
	fwrite($f,$_POST["data"]."\r\n");	//Save to file sound.log for old version
	fclose($f);
?>