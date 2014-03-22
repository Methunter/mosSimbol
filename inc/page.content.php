<?php
	$menu= new Menu;	//class.menu.php
	$page= new Page;	//class.page.php
	$menu->nest();			//хлебные крошки

	switch($menu->level){
		case 1:
			
			break;
		case 2:
			$page->showFoldersList();

			break;
		case 3:
			$menu->showOneLevelDown();		//типы меню(второй уровень дерева, то, что ледит в каталоге)
			$page->showFoldersList();

			break;
		case 4:
			$menu->showTwoLevelsDown();		//категории (третий уровень меню, то, что лежит в Литейке/Ювелирке/Вышивке)
			$menu->showOneLevelDown();		//типы меню(второй уровень дерева, то, что ледит в каталоге)
			$page->showItToMe();	//показать содержимое папки третьего уровня (инстатсы категорий)
			break;
		case 5:
			$menu->showThreeLevelsDown();
			$menu->showTwoLevelsDown();		//категории (третий уровень меню, то, что лежит в Литейке/Ювелирке/Вышивке)
			$menu->showOneLevelDown();		//типы меню(второй уровень дерева, то, что ледит в каталоге)
			include_once("page.carousel.php");
			include_once("piece.orderButtons.php");
			$page->tellAboutCurrentItem();
			break;
	}



?>