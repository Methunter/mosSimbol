<?php
	$menu->nest();			//хлебные крошки
	$foo = $menu->currentPath;
	$fcp = $menu->fullCurrentPath;
	$lvl = $menu->level;
	echo "<script language=''javascript''>\nvar me3 = {};\nme3.currentPath = '$foo', me3.currentLvl = $lvl,me3.fullCurrentPath = '$fcp';\n </script>";
if (isset($_SESSION["admin"])) {			//поведение для Одмина 		->
	switch($lvl){
		case 1:
			
			break;
		case 2:
			$page->showFoldersList();
			$admBiz->folderForm($lvl);			//создаёт форму имя/кнока и запускает admBiz->makefolder()

			break;
		case 3:
			//$menu->showOneLevelDown();		//типы меню(второй уровень дерева, то, что ледит в каталоге)
			$page->showFoldersList();
			$admBiz->folderForm($lvl);
			break;
		case 4:
			//$menu->showTwoLevelsDown();		//категории (третий уровень меню, то, что лежит в Литейке/Ювелирке/Вышивке)
			//$menu->showOneLevelDown();		//типы меню(второй уровень дерева, то, что ледит в каталоге)
			$page->showItToMe();			//показать содержимое папки третьего уровня (инстатсы категорий)
			$admBiz->folderForm($lvl);
			break;
		case 5:
			// $menu->showThreeLevelsDown();
			// $menu->showTwoLevelsDown();		//категории (третий уровень меню, то, что лежит в Литейке/Ювелирке/Вышивке)
			//$menu->showOneLevelDown();		//типы меню(второй уровень дерева, то, что ледит в каталоге)
			include_once("page.carousel.php");
			include_once("piece.orderButtons.php");
			$page->tellAboutCurrentItem();
			$admBiz->photoForm();			//photoForm создаёт и вставляет форму в которой Лейбл, инпут да кнопка,
			$admBiz->descForm();							
			break;
	}
}								
else{										//Поведение для смертных 	->
	switch($menu->level){
		case 1:
			
			break;
		case 2:
			$page->showFoldersList();

			break;
		case 3:
			//$menu->showOneLevelDown();		//типы меню(второй уровень дерева, то, что ледит в каталоге)
			$page->showFoldersList();

			break;
		case 4:
			//$menu->showTwoLevelsDown();		//категории (третий уровень меню, то, что лежит в Литейке/Ювелирке/Вышивке)
			//$menu->showOneLevelDown();		//типы меню(второй уровень дерева, то, что ледит в каталоге)
			$page->showItToMe();	//показать содержимое папки третьего уровня (инстатсы категорий)
			break;
		case 5:
			//$menu->showThreeLevelsDown();
			//$menu->showTwoLevelsDown();		//категории (третий уровень меню, то, что лежит в Литейке/Ювелирке/Вышивке)
			//$menu->showOneLevelDown();		//типы меню(второй уровень дерева, то, что ледит в каталоге)
			include_once("page.carousel.php");
			include_once("piece.orderButtons.php");
			$page->tellAboutCurrentItem();
			break;
	 }
}

/*
//	moveToTrash() - в хедере цепляется jq на папки с div.folderDelete.click(ajax)->cases.php case: $admBiz->moveToTrash()...
//	про фотки:index.php ->content.php ->  photoForm ->action = php_self <[files['filename']]=''> photoAdd->move_upload_files(что, куда).
*/
/*В контенте :
//		Пятый LVL:
//		__FILE__: 				/Library/WebServer/Documents/msb/inc/page.content.php
//		getcwd(); 				/Library/WebServer/Documents/msb/Каталог/Литейка/Проверочные Знаки/Знак свыше
//		_SERVER['PHP_SELF']: 			/Каталог/Литейка/Проверочные Знаки/Знак свыше/index.php
*/
/*
//
//	есть идея, если потребуется переписать ещё раз загрузку фоток, можно просто поставить
//	проверку по именам, и дописывать в логику agile текст fwrite'ом...
//
//
//
*/
	



?>