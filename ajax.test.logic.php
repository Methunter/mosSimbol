<?php
session_start();
$name=rawurlencode($_POST["name"]);
$quont = $_POST["quantity"];
setcookie("SC".$name,$quont);
if($_SESSION){
	$_SESSION[$name]=$quont;
}

rawurlencode( print_r($_SESSION));
?>
