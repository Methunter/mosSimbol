<?php 	

if (isset($_POST['username']) && isset($_POST["password"])) {
		if ($_POST['username'] == 'me3sa' && $_POST['password'] == 'love' ){
				session_save_path("/tmp");
				session_start(); 
				$_SESSION["admin"]=1;
				header("Location: ../index.php");
		}
	}			
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>login</title>
	<link rel="stylesheet" href="/stylesheets/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
<?php 

	
	echo "<pre> ses";
	print_r($_SESSION);
	echo "</pre>";
	echo "<pre> pos";
	print_r($_POST);
	echo "</pre>";
	//unset($_POST['password']);
	//unset($_POST['username']);
	//unset($_SESSION['admin']);
?>

<form action="<?=$_SERVER['PHP_SELF']?>" id='myForm' method="post" accept-charset="utf-8">
	<label  for="username">Логин: 
		<input type="text" id="username" name="username">
	</label>
	<label for="userpass">Пароль: 
		<input type="password" id="userpass" name="password">
	</label>
	<input id="submit" type="submit" value="Войти">

</form>


<script type='text/javascript'>
	$( "#myForm" ).click(function(event) {
		console.log( "test");
		//event.preventDefault();
	});
</script>


</body>
</html>