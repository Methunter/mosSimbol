<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/inc/class.page.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/inc/class.debug.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/inc/class.menu.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/inc/functions.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/inc/class.database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/inc/class.order.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/inc/class.admin.php");
			//Так, раз уж такая пьянка, можно создавать отдельный элемент массива, cases, например, и свитчём его прогонять на экшны.
			//а пока так...
	$fullcurrentpathPHP=$_POST['fullCurPath'];
	$currentlvlPHP = $_POST['curLvl'];					//приходит из script.js  <---->настоящий уровень страницы
	$curpathPHP = $_POST['curPath'];	//приходит из script.js  <---->настоящий адрес (/Каталог/ и так далее)
	$foldnamePHP = $_POST['folderName'];				//приходит из script.js  <---->имя рабочей папки
	$debugInfo = "\n<br />[Cases.php] : __DIR__ is : ".__DIR__."\n<br />[Cases.php] : _SERVER['ROOT'] is : ".$_SERVER['DOCUMENT_ROOT']."\n<br />[Cases.php] : getcwd() is : ".getcwd()."\n<br />[Cases.php] : php self is : ".$_SERVER['PHP_SELF']."<br />\n[Cases.php] : CP: $curpathPHP\n[Cases.php] : FN: $foldnamePHP\n[Cases.php] : FCP: $fullcurrentpathPHP\n";

	//$d=dir(".");

	if (isset($_POST['action'])){
		switch ($_POST['action']) {

			case 'mkDir':
				echo "[Cases.php?action:mkDir] : working...\n[Cases.php] :  CP: $curpathPHP\n[Cases.php] : FN: $foldnamePHP\nFCP: $fullcurrentpathPHP\n"; 
				$admBiz->makefolder($fullcurrentpathPHP."/".$foldnamePHP,$currentlvlPHP);
				unset($_POST['action']);
				break;
			case 'delete':
				//echo "[Cases.php->action:delete] : working...\n[Cases.php] :  CP: $curpathPHP\n[Cases.php] : FN: $foldnamePHP\nFCP: $fullcurrentpathPHP\n"; 
				$admBiz->moveToTrash($fullcurrentpathPHP,$foldnamePHP);
				unset($_POST['action']);
				break;
			case 'deskForm':
				$admBiz->deskAdd($_POST['deskForm']);
				unset($_POST['action']);
				break;
			case 'photoUpload':
				echo "[Cases.php?action:photoUpload] : working...\n[Cases.php] :  CP: $curpathPHP\n[Cases.php] : FN: $foldnamePHP\nFCP: $fullcurrentpathPHP\n"; 
				//$admBiz->photoAdd($fullcurrentpathPHP);
				print_r($_FILES);
				unset($_POST['action']);				

				break;
			case 'setDesc':
				$admBiz->appendDescription($fullcurrentpathPHP, $_POST['text']);
				unset($_POST['action']);
				break;
			case 'makeOrder':
				$admBiz->makeOrder($foldnamePHP);
				unset($_POST['action']);
				break;
		}
	}


//	if (isset($_POST['delete']) &&  $_POST['delete'] == "positive") {
//			$admBiz->moveToTrash($curpathPHP,$foldnamePHP);
//			//
//			//каменты для массовости
//			}
//	if (isset($_POST['action']) && $_POST['action'] == "mkDir") {
//			$admBiz->makefolder($curpathPHP."/".$foldnamePHP,$currentlvlPHP);
//			echo "[Cases.php?action:mkDir] : working...\n CP: $curpathPHP\nFN: $foldnamePHP"; 
//	}
//	if (isset($_POST['action']) && $_POST['action'] == "photoUpdate") {
//		echo "photo1";
//	 }
//	if (isset($_POST['action']) && $_POST['action'] == "photoUpload2") {				//временно откладываем идею,
//		if (isset($_FILES["filename"])) {								с путями проблемы, но главное
//			$admBiz->photoAdd();							переход после исполнения формы..(
//			unset($_FILES['filename']["name"]);				
//			unset($_FILES['filename']["type"]);				
//			unset($_FILES['filename']["tmp_name"]);			
//			unset($_FILES['filename']["error"]);				deskForm
//			unset($_FILES['filename']["size"]);				
//		 }
//	echo "\n\n__FILE__: 		".  __FILE__		."\n"	;		
//	echo "getcwd(); 		".  getcwd()		."\n"	;		
//	echo "_SERVER['PHP_SELF']: 	". $_SERVER['PHP_SELF'] ."\n"	;
//	 }
?>
