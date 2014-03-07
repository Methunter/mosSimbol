<?php
    session_start();
$_SESSION["username"]="me2sa";
if (!isset($_SESSION['count'])) {
  $_SESSION['count'] = 0;
} else {
  $_SESSION['count']++;
}
header('Content-Type: text/html; charset=UTF-8');
include_once("inc/class.page.php");
include_once("inc/class.debug.php");
include_once("inc/class.menu.php");
include_once("inc/functions.php");
include_once("inc/class.database.php");
include_once("inc/class.order.php");

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
<head>
    <!-- Basic Page Needs
================================================== -->
    <meta charset="utf-8">

    <title>Моссимвол</title>
    <meta name="description" content="значки">
    <meta name="author" content="Dmithiy Okhotnikov me3sa@me.com">
    <!-- Mobile Specific Metas
================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="format-detection" content="telephone=yes">
    <!-- CSS
================================================== -->
    <link rel="stylesheet" href="stylesheets/style.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/slides.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/oddScreen.css" type="text/css">
	<link rel="stylesheet" href="stylesheets/agile_carousel.css">

    <!-- Favicons
================================================== -->
    <link rel="shortcut icon" href="                    /images/favicon.ico">
    <link rel="apple-touch-icon" href="                 /images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="   /images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href=" /images/apple-touch-icon-114x114.png">
    <!-- JScripts
================================================== -->

    <script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="js/fromTheInternet.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script src="js/functions.js" type="text/javascript"></script>
	<script src="js/agile_carousel.alpha.js"></script>
</head>

<body>
    <header>
        <a href="/index.php"><img src="/images/logo.gif" id='img' alt="MosSimbl"></a>

        <h1 id="phone"><a href="tel:+7-495-502-28-80"><span style="color:#777777">+7&nbsp;(495)</span> 502-28-80</a></h1><br>
        <?php
            
            
            $page=new Page;
            $menu=new Menu;
            $menu->nest();
            echo "<h1 id=\"foldersLevel\">" . $menu->level."</h1>";
            

        //echo "http refer ". $_SERVER['HTTP_REFERER'] .  " !accept! ".$_SERVER['PHP_SELF']." <br />";
        ?>
    </header>

    <div id='room'>