<?php

	session_start();
	if(isset($_COOKIE["name"])){
		$username=$_COOKIE["name"];
	}else{$username= $_GET["u"];}
	
	$password= null;//$_POST["userpass"];
	$_SESSION["name"]=$username;
	$_SESSION["pass"]=$password;
	setcookie("name",$username,time()+(60*60*24*7));
	$_COOKIE
?>
<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
	<?php
		
		echo $username.":".$password."<br />";
		echo "массив сессии:<br />";
		echo "<pre>";
		print_r($_SESSION);
		echo "<pre>";
		echo "массив куков:<br />";
		echo "<pre>";
		print_r($_COOKIE);
		echo "<pre>";			
	?>
	</body>
</html>