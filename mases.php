<?php    
session_save_path("/tmp");
session_start();
	echo "<pre>";
	print_r($GLOBALS);
	echo "</pre>";
?>