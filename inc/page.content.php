<?php
	// $mysqli = new msbMysqli('orderTest');
	$menu = new Menu;
	$menu->nest();			//хлебные крошки
	$foo = $menu->currentPath;
	$fcp = $menu->fullCurrentPath;
	$lvl = $menu->level;
	$string = "This is Katalog!";
	echo "<script language=''javascript''>\nme3.currentPath = '$foo', me3.currentLvl = $lvl,me3.fullCurrentPath = '$fcp';\n </script>";
if (isset($_SESSION["admin"])) {			//поведение для Одмина 		->
	switch($lvl){
		case 1:
			
			break;
		case 2:
			$admBiz = new Admin;
			$page->showFoldersList();
			$admBiz->folderForm($lvl);			//создаёт форму имя/кнока и запускает admBiz->makefolder()

			break;
		case 3:
			//$menu->showOneLevelDown();		//типы меню(второй уровень дерева, то, что ледит в каталоге)
			$admBiz = new Admin;
			$page->showFoldersList();
			$admBiz->folderForm($lvl);
			break;
		case 4:
			//$menu->showTwoLevelsDown();		//категории (третий уровень меню, то, что лежит в Литейке/Ювелирке/Вышивке)
			//$menu->showOneLevelDown();
			$admBiz = new Admin;		//типы меню(второй уровень дерева, то, что ледит в каталоге)
			$page->prepareGallery();			//показать содержимое папки третьего уровня (инстатсы категорий)
			$admBiz->folderForm($lvl);
			break;
		case 5:
			// $menu->showThreeLevelsDown();
			// $menu->showTwoLevelsDown();		//категории (третий уровень меню, то, что лежит в Литейке/Ювелирке/Вышивке)
			//$menu->showOneLevelDown();
			//типы меню(второй уровень дерева, то, что ледит в каталоге)
			$admBiz = new Admin;
			include_once("page.carousel.php");
			$page->makeOrderButton();
			$page->tellAboutCurrentItem();
			$admBiz->photoForm();			//photoForm создаёт и вставляет форму в которой Лейбл, инпут да кнопка,
			$admBiz->photoAdd(getcwd());		//photoForm создаёт и вставляет форму в которой Лейбл, инпут да кнопка,
			$admBiz->descForm();							
			$mysqli = new msbMysqli();
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
			$page->prepareGallery();	//показать содержимое папки третьего уровня (инстатсы категорий)
			break;
		case 5:
			//$menu->showThreeLevelsDown();
			//$menu->showTwoLevelsDown();		//категории (третий уровень меню, то, что лежит в Литейке/Ювелирке/Вышивке)
			//$menu->showOneLevelDown();		//типы меню(второй уровень дерева, то, что ледит в каталоге)
			include_once("page.carousel.php");
			$page->makeOrderButton();
			$page->tellAboutCurrentItem();
			break;
	 }
}

/*
//TODO:	moveToTrash() - в хедере цепляется jq на папки с div.folderDelete.click(ajax)->cases.php case: $admBiz->moveToTrash()...
//		про фотки:index.php ->content.php ->  photoForm ->action = php_self <[files['filename']]=''> photoAdd->move_upload_files(что, куда).
*/
/*В контенте :
//	Пятый LVL:				  	   / lvl1/   lvl2   /     lvl3    /		lvl4	  / 	lvl5	
//	getcwd(); 	  /Library/WebServer/Documents/msb/Каталог/Литейка/Проверочные Знаки/Знак свыше
//	_SERVER['PHP_SELF']:				Главная/Каталог/Литейка/Проверочные Знаки/Знак свыше/index.php
//	__FILE__: 			/Library/WebServer/Documents/msb/inc/page.content.php
*/
/*
//
//TODO/:	есть идея, если потребуется переписать ещё раз загрузку фоток, можно просто поставить
//	проверку по именам, и дописывать в логику agile текст fwrite'ом...
//
*/
/*
//[bool	]TODO:	По поводу баз и вывода заказов пользователя:
//		можно в момент определения пользователя поставить разблюдовку на админ/юзер 
//			и юзер GRANT USAGE ... тогда покупки надо будет из серии хранить в сессии и 
//			каждый раз #order.click.ajax(posession -> _SESSION['possession'])  и для вывода
//			foreach(_SESSION['posession'] as $posession => $value  ){
//			/	#доставать данные из таблицы
//				//хотя удобнее это делать сразу массивом...
//		}
//
//
*/
/*
//TODO:	надо обратить внимание на bool fnmatch ( string $pattern , string $string [, int $flags = 0 ] )
//	может ею переделаю проверку имён в загрузках фоток.
*/	
/*
//TODO:	resource tmpfile ( void ) - создаёт текстовый файл с уникальным именем и удаляет его по fclose();
//	вариант для замены тех же загрузок фото.
*/
/*
//TODO:	config php в папку в которой лежит нормальный билд
//
//
//	TODO:
//	TODO:  	-!-	 config php в папку в которой лежит нормальный билд		
//	TODO:  	-@--	 поставить xdebug
//	TODO:  	- 	приладить codebug
//
*/
	


/*
//TODO: сервер смотрит не в ту папку, когда загружает страницу. надо переносить всё в msb  тк у неё настр. php 
//
*/

/*
//
//
*/

/*
//
//
*/

?>