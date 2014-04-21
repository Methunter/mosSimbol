<?php
    session_save_path("/tmp");
    session_start();
	spl_autoload_register(function ($classname) {
   		 include "class.". $classname .".php";
	});
	$admBiz = new Admin;
			//Так, раз уж такая пьянка, можно создавать отдельный элемент массива, cases, например, и свитчём его прогонять на экшны.
			//а пока так...
	$fullcurrentpathPHP=$_POST['fullCurPath'];
	$currentlvlPHP = $_POST['curLvl'];					//приходит из script.js  <---->настоящий уровень страницы
	$curpathPHP = $_POST['curPath'];	//приходит из script.js  <---->настоящий адрес (/Каталог/ и так далее)
	$foldernamePHP = $_POST['folderName'];				//приходит из script.js  <---->имя рабочей папки
	$debugInfo = "\n<br />[Cases.php] : __DIR__ is : ".__DIR__."\n<br />[Cases.php] : _SERVER['ROOT'] is : ".$_SERVER['DOCUMENT_ROOT']."\n<br />[Cases.php] : getcwd() is : ".getcwd()."\n<br />[Cases.php] : php self is : ".$_SERVER['PHP_SELF']."<br />\n[Cases.php] : CP: $curpathPHP\n[Cases.php] : FN: $foldernamePHP\n[Cases.php] : FCP: $fullcurrentpathPHP\n";
	
	// $msbOTmsqli = new msbMysqli('orderTest');
	//$d=dir(".");

	if (isset($_POST['action'])){	
		switch ($_POST['action']) {
			case 'order':
				if($msbOTmsqli instanceof msbMysqli){
				$msbOTmsqli->makeOrder($fullcurrentpathPHP);
					$posession=end(explode("/", $fullcurrentpathPHP));
					$isThisField=$msbOTmsqli->isThisField($posession);
				 }
				// unset($_POST['action']);
			 break;
			case 'mkDir':
				echo "[Cases.php?action:mkDir] : working...\n[Cases.php] :  CP: $curpathPHP\n[Cases.php] : FN: $foldernamePHP\nFCP: $fullcurrentpathPHP\n"; 
				$admBiz->makefolder($fullcurrentpathPHP."/".$foldernamePHP,$currentlvlPHP);
				unset($_POST['action']);
			 break;
			case 'delete':
				//echo "[Cases.php->action:delete] : working...\n[Cases.php] :  CP: $curpathPHP\n[Cases.php] : FN: $foldernamePHP\nFCP: $fullcurrentpathPHP\n"; 
				$admBiz->moveToTrash($fullcurrentpathPHP,$foldernamePHP);
				unset($_POST['action']);
			 break;
			case 'photoUpload':
				echo "[Cases.php?action:photoUpload] : working...\n[Cases.php] :  CP: $curpathPHP\n[Cases.php] : FN: $foldernamePHP\nFCP: $fullcurrentpathPHP\n"; 
				$admBiz->photoAdd($fullcurrentpathPHP);
				echo "<pre>";
				print_r($_POST);
				echo "</pre>";
				echo "<pre>";
				print_r($_SESSION['names']);
				echo "</pre>";
				unset($_POST['action']);
				unset($_FILES);
			 break;
			case 'setDescription':
				$admBiz->deskAdd($fullcurrentpathPHP, $_POST['text']);
				echo "cases: ".$_POST['test']."\n$fullcurrentpathPHP\n
				if($msbOTmsqli instanceof msbMysqli){
					$currentlvlPHP\n";
					echo "<pre> cases _POST: ";
						print_r($_POST);
					echo "</pre>";
				//unset($_POST['action']);
				break;
			case 'deleteRaw' :
				$msbOTmsqli->deleteRaw($_POST['name']);
			 break;
		 }
	 }
		


//	if (isset($_POST['delete']) &&  $_POST['delete'] == "positive") {
//			$admBiz->moveToTrash($curpathPHP,$foldernamePHP);
//			//
//			//каменты для массовости
//			}
//	if (isset($_POST['action']) && $_POST['action'] == "mkDir") {
//			$admBiz->makefolder($curpathPHP."/".$foldernamePHP,$currentlvlPHP);
//			echo "[Cases.php?action:mkDir] : working...\n CP: $curpathPHP\nFN: $foldernamePHP"; 
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
