<?php
	session_save_path("/tmp");
	session_start();
	ini_set('error_reporting', E_ALL);
	header('Content-Type: text/html; charset=utf-8');
	date_default_timezone_set('Europe/Moscow');
$_SESSION["username"]="me2sa";
if (!isset($_SESSION['count'])) {
  $_SESSION['count'] = 0;
} else {
  $_SESSION['count']++;
}
print_r($_SESSION)
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6"  lang="ru"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7"     lang="ru"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8"     lang="ru"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html         lang="ru"> <![endif]-->
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<html>
<head><!--  -->
	<!-- JScripts
==================================================================================== -->
	<script src="/js/jquery-1.11.0.min.js"      type="text/javascript"></script>
	<script src="/js/fromTheInternet.js"        type="text/javascript"></script>
	<script src="/js/functions.js"              type="text/javascript"></script>
	<script src="/js/agile_carousel.alpha.js"   type="text/javascript"></script>
	<script src="/js/mainCarousel.js"           type="text/javascript"></script>
	<script src="/js/script.js"                 type="text/javascript"></script>
<?php
	echo "  <script type='text/javascript'>var me3 = {};</script>"   ;

	spl_autoload_register(function ($classname) {
		include_once ("class.". $classname .".php");
		echo "  <script type='text/javascript'>
				me3.class += ('class.$classname.php loaded');
			</script>\n";
	});
	
	/*
spl_autoload_register( function($name) {
    if (is_file("class.". $name .".php")) {
    	$classname = 'class.'.$name.'.php';
        include_once($classname);
    }else{
    	echo $classname;
    }
});
*/
	$menu = new Menu;
	$page = new Page;
?>

	<!-- Basic Page Needs
================================================== -->
	<meta charset="utf-8">
	<title>Моссимвол</title>
	<meta name="description" content="значки">
	<meta name="author" content="Dmithiy Okhotnikov me3sa@me.com">
	<!-- Mobile Specific Metas
================================================== -->
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta name="format-detection" content="telephone=yes"> -->



<?php

/*===========================
				admin case:
===========================*/



if (isset($_SESSION["admin"])) {
	ini_set('display_errors',1);
		echo "i'm admin";
			echo '<h1 id=\"foldersLevel\">' .$menu->level.'</h1>';    
			
			echo "<script type='text/javascript'>

					  $('docunent').ready(function(){ 
								var del = '<div class=\"folderDelete\"></div>';
								$('.catlist a').css({'color':'#3a51a5'});  
								$('.catlist h2').append(del);
								$('.folderDelete').css({ 'position' : 'absolute !important','top' : '0px !important','z-index':'100000000'});
								$('.signItem').append(del);\n me3.adm = 'TRUE';\n";

	$headers = $_POST;
		foreach ($headers as $header => $value) {
			echo "me3.$header = '$value';\n";
		}//   $('.catlist a : after').css({'content':'none' });                                del=$('.folderDelete');
			echo "\n});\n
var myCock ={
			";
		foreach ($_COOKIE as $mycock => $value) {
			echo "\t'".$mycock."' : '".$value."' ,\n";
		}
		
  echo "};\n

var myPost ={
			";
		foreach ($_POST as $mysess => $value) {
			echo "\t'".$mysess."' : '".$value."' ,\n";
		}
		echo "};\n

var myServ ={
			";
		foreach ($_SERVER as $myserv => $value) {
			echo "\t'".$myserv."' : '".$value."' ,\n";
		}
		echo "};\n
var myEnv ={
			";
		foreach ($_ENV as $myenv => $value) {
			echo "\t'".$myenv."' : '".$value."' ,\n";
		}
		echo "};\n
		</script>\n";
}
?>

	<!-- CSS
================================================== -->
	<link rel="stylesheet" href="/stylesheets/style.css" 				type="text/css" />
	<link rel="stylesheet" href="/stylesheets/slides.css" 				type="text/css" />
<!--     <link rel="stylesheet" href="/stylesheets/oddScreen.css" 			type="text/css" /> -->
	<link rel="stylesheet" href="/stylesheets/agile_carousel.css"		type="text/css" />
<!-- 	<link rel="stylesheet" href="/stylesheets/bootstrap-responsive.css"	type="text/css" /> -->
<!-- 	<link rel="stylesheet" href="/stylesheets/bootstrap.css"			type="text/css" /> -->

	<!-- Favicons
================================================== -->
	<link rel="shortcut icon" href="                    /images/favicon.ico">
	<link rel="apple-touch-icon" href="                 /images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="   /images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href=" /images/apple-touch-icon-114x114.png">
   
</head>

<body>
	<header>
	<?php

		  
	?>
		<a href="/index.php"><img src="/images/logo.gif" id='img' alt="MosSimbl"></a>

		<h1 id="phone"><a href="tel:+7-495-502-28-80"><span style="color:#777777">+7&nbsp;(495)</span> 502-28-80</a></h1><br>


	</header>

	<div id='room'>