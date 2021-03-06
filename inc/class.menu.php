<?php
class Menu{//класс, формирующий меню... 

	private $d;
	private $dom;
	public 	$level;
	public $currentPath;				//для js currentPath
	public $fullCurrentPath;			//для js fullCurrentPath
	public $currentLvl;				// для js currentLvl
	public $stringTest;
	public $nest;
	public $my_Self;
	
	function __construct(){
		$this->my_Self = $_SERVER['PHP_SELF'];			//забераем полный адрес от корня до файла в строку.
		$this->nest = explode('/', $this->my_Self);				//ломаем строку на массив, по папке на элемент.
		array_pop($this->nest);					//выкидываем из массива имя файла.
		$this->currentPath = implode("/", $this->nest);		//собираем массив обратно в строку
		$this->level=count($this->nest);
		$this->fullCurrentPath = getcwd();

		 }
	function menuMaker(){
		$this->d=dir(".");
		$this->dom = new DOMDocument('1.0', 'utf-8');
		$root = $this->dom->createElement('div');
		$root->setAttribute('class','catlist');
		while (false !== ($entry = $this->d->read())){
		   	if(is_dir($entry)
		   	&& $entry!=="." 
		   	&& $entry!==".."){
		   		$h2=$this->dom->createElement("h2");
		   		$text = $this->dom->createTextNode("$entry");
		   		$link = $this->dom->createElement("a");
		   		$link->setAttribute("href",$entry);
		   		$link->appendChild($text);
		   		$h2->appendChild($link);
		   		$root->appendChild($h2);
		   }
		}
		$this->dom->appendChild($root);
   		echo $this->dom->saveXML();
   	 }
	function nest(){							//так, ещё раз:
		$this->my_Self = $_SERVER['PHP_SELF'];			//забераем полный адрес от корня до файла в строку.
		$this->nest = explode('/', $this->my_Self);				//ломаем строку на массив, по папке на элемент.
		array_pop($this->nest);					//выкидываем из массива имя файла.
		$this->currentPath = implode("/", $this->nest);		//собираем массив обратно в строку
		$this->nest[0]="Главная";								//задаём первому элементу массива имя
		$this->level=count($this->nest);							//находим уровень файла, который читаем в данный момент
		echo "<div id=\"nest\">";							//начинаем строить хлебные крошки, открываем контейнер
		foreach($this->nest as $entry){							//основной луп(оснвной цикл)
			$path=dir(getcwd())->path."/"; 					//***на сервере не должно быть последнего следжа, он портит условие.
			$this->d=explode('/',$path);						//разбиваем путь на составляющие его папки, заносим данные в массив
			array_shift($this->d);							//
			array_shift($this->d);							//
			array_shift($this->d);							//убираем лишнее в начале пути
			array_shift($this->d);							//
			$s=$_SERVER["DOCUMENT_ROOT"];					//выясняем адрес корневого каталога
			if( $path !== $s){							//сравниваем путь файла, который читаем с корнем, определяем действия в данной связи
												//(на момент написания небыло механизма определения читаемого файла по уровням каталогов)
				$aherf.=$entry;						//если мы не на главной, добавляем каждый прочитанный элемент пути в сслыку
				if($aherf=="Главная"){					//если приходит первый элемент массива, записываем в ссылку следж
					$aherf="/";						//
				}else{
					$aherf.="/";						//если не первый элемент, добавляем в путь следж, можно юыло сделать в основной проверке ()
				}
				echo "<a href=\"$aherf \">".$entry."  </a> / ";		//непосредственно собираем ссылку и текст, которые будут крошками
			}									//выход из основной проверки
		}										//конец основного лупа
		echo "</div>";									//закрываем контейнер, заканчиваем строить хлебные крошки
		echo "<div class=\"clearfix\"></div>";					//чистим за собой правила стиля
	 }
	function showOneLevelDown(){											//показать предыдущий уровень
		$d=dir(".");														//создаём объект директории
		$origin=getcwd();													//указываем начальный адрес, что-бы вернуться
		chdir("..");														//уходим на предыдущий уровень
		$d=dir(".");														//объявляем новую папку
		$dom=new DOMDocument;												//
		$root = $dom->createElement("div");									//
		$root->setAttribute("id","oneLevelDown");							//
		$type=$dom->createElement("ul");									//
		while(false!==($entry=$d->read())){									//основной цикл, получаем содержание папки, пока оно не кончится
			if(is_dir($entry) && $entry!="." && $entry!=".."){				//
				$typeItem=$dom->createElement("li");						//
				$typeLink=$dom->createElement("a");							//
				$relpath=getcwd();											//
				$relpath=explode('/', $relpath);							//
				array_shift($relpath);										//
				array_shift($relpath);										//
				array_shift($relpath);										//
				array_shift($relpath);										//
				array_shift($relpath);										//
			//нужны только на сервере:
			//				array_shift($relpath);										//
			//				array_shift($relpath);										//
				$relpath= implode("/", $relpath);							//
				$typeLink->setAttribute("href","/".$relpath."/".$entry);	//
				$typeText=$dom->createTextNode($entry);						//
				$typeLink->appendChild($typeText);							//
				$typeItem->appendChild($typeLink);							//
				$type->appendChild($typeItem);								//
				$root->appendChild($type);									//
			}																//
		}																	//
		$dom->appendChild($root);											//
		echo $dom->saveXML();												//
		echo "<div class=\"clearfix\"></div>";								//
		$d->close();														//
		chdir($origin);														//
	 }																		//
	function showTwoLevelsDown(){
		$d=dir(".");
		$origin=getcwd();
		chdir("..");
		$d=dir(".");
		chdir("..");
		$d=dir(".");
		$dom=new DOMDocument;
		$root = $dom->createElement("div");
		$root->setAttribute("id","twoLevelsDown");
		$type=$dom->createElement("ul");
		
		while(false!==($entry=$d->read())){
			if(is_dir($entry) && $entry!="." && $entry!=".."){
				$typeItem=$dom->createElement("li");
				$typeLink=$dom->createElement("a");
				$relpath=getcwd();
				$relpath=explode('/', $relpath);
				array_shift($relpath);
				array_shift($relpath);
				//нужны только на сервере
				//				array_shift($relpath);										//
				//				array_shift($relpath);										//
				array_shift($relpath);
				array_shift($relpath);
				array_shift($relpath);
				$relpath= implode("/", $relpath);
				$typeLink->setAttribute("href","/".$relpath."/".$entry);
				$typeText=$dom->createTextNode($entry);
				$typeLink->appendChild($typeText);
				$typeItem->appendChild($typeLink);
				$type->appendChild($typeItem);
				$root->appendChild($type);
			}
		}
		$dom->appendChild($root);
		echo $dom->saveXML();
		echo "<div class=\"clearfix\"></div>";
		$d->close();
		chdir($origin);
	 }
	function showThreeLevelsDown(){
		$d=dir(".");
		$origin=getcwd();
		chdir("..");
		$d=dir(".");
		chdir("..");
		$d=dir(".");
		chdir("..");
		$d=dir(".");
		$dom=new DOMDocument;
		$root = $dom->createElement("div");
		$root->setAttribute("id","threeLevelsDown");
		$type=$dom->createElement("ul");
		
		while(false!==($entry=$d->read())){
			if(is_dir($entry) && $entry!="." && $entry!=".."){
				$typeItem=$dom->createElement("li");
				$typeLink=$dom->createElement("a");
				$relpath=getcwd();
				$relpath=explode('/', $relpath);
				array_shift($relpath);
				array_shift($relpath);
				array_shift($relpath);
				//нужны только на сервере
				//				array_shift($relpath);										//
				//				array_shift($relpath);										//
				array_shift($relpath);
				array_shift($relpath);
				$relpath= implode("/", $relpath);
				$typeLink->setAttribute("href","/".$relpath."/".$entry);
				$typeText=$dom->createTextNode($entry);
				$typeLink->appendChild($typeText);
				$typeItem->appendChild($typeLink);
				$type->appendChild($typeItem);
				$root->appendChild($type);
			}
		}
		$dom->appendChild($root);
		echo $dom->saveXML();
		echo "<div class=\"clearfix\"></div>";
		$d->close();
		chdir($origin);
	 }

		
	
}//end of class
$menu = new Menu;
?>

