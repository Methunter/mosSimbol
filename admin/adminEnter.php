<?php

	session_save_path("/tmp");
	session_start();
	if (!isset($_SESSION['admin'])) {
		$_SESSION["admin"]=true;
		# code...
	}elseif (isset($_SESSION)) {
		unset($_SESSION);
		session_unset();
		session_destroy();
	}
$kyka = "foo bar string";

header('Set-cookie: foo1=bar11');
	setcookie("admin",$kyka,time()+3600);
	setcookie("TestCookie", $kyka, time()+3600);
	header("Location: ../index.php");
?>