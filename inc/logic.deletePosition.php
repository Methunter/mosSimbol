<?php
	$name = $_POST["name"];
	require_once('class.database.php');
	$orderTest = new Database("orderTest");
	$orderTest->deleteRaw($name);
	echo $name."\n";
	echo $orderTest->phpsessid;
?>