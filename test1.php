<?php
	header('Content-Type: text/html; charset=UTF8');
	include ("inc/implementation.php");
	setlocale(LC_ALL, 'ru_RU');
	var_dump(setlocale(LC_ALL, 'ru_RU.utf8'));
?>

<?



$page=new Page;
$mas=$page->categories();
print_r($mas);

echo "<br />";
$trash = array_shift($mas);
print_r($mas);
var_dump($mas);
$asd=array(1,2,3,4,5);
var_dump($asd);
$trash.=array_shift($asd);
var_dump($asd);
echo "<br />". $mas;
?>