<?php

class  Page {
	
	public $iAmIn;//getcwd()
	public $content=array();//goGetIt()
	public $types;
	public $exts = array("jpg","png","gif"); 
	public $folderItem;
	public $files=array();
	public $dir;
	
	
	function __construct(){
		$this->iAmIn = getcwd();
	}

	function showFoldersList(){//бекап внизу страницы
		$d = dir(".");
		$dom = new DOMDocument('1.0', 'utf-8');
		$root = $dom->createElement('div');
		$root->setAttribute('class','catlist');
		while (false !== ($entry = $d->read())){
		   	if(is_dir($entry)
		   	&& $entry!=="." 
		   	&& $entry!==".."){
		   		$h2=$dom->createElement("h2");
		   		$text = $dom->createTextNode("$entry");
		   		$link = $dom->createElement("a");
		   		$link->setAttribute("href",$entry);
		   		$link->appendChild($text);
		   		$h2->appendChild($link);
		   		$root->appendChild($h2);
		   }
		}
					$dom->appendChild($root);
			   		echo $dom->saveXML();
	}
	function showItToMe(){
		$d = dir(".");
		while (false !== ($entry = $d->read())){
			if(is_dir($entry)
			&& $entry!=="." 
			&& $entry!==".."){
				$dom = new DOMDocument('1.0', 'utf-8');
				$root = $dom->createElement('div');
				$root->setAttribute('class','signItem');
				$h2=$dom->createElement("h2");
				$text = $dom->createTextNode("$entry");
				$h2->setAttribute("class","title");
				$h2->appendChild($text);
				$root->appendChild($h2);
				$dom->appendChild($root);
				$mng=$dom->createElement("ul");
				$mng->setAttribute("class","minigal");	
				chdir("$entry");
				$d1=dir(".");
				while (false !== ($entry1 = $d1->read())){
				   		if ($entry==="about.txt"){
					   		$about=$dom->createElement("div");
				   		}
						if($entry1!=="." 
						&& $entry1!==".."
						&& $entry1!=="about.txt"){

							$img=$dom->createElement("img");
							$img->setAttribute("src",basename(getcwd())."/".$entry1);
							$li=$dom->createElement("li");
							$li->appendChild($img);
							$mng->appendChild($li);
							$img->setAttribute("class","pic");
						}
					}
					$root->appendChild($mng);
					$d1->close();
				   	chdir("..");
				   	echo $dom->saveXML();
		   }
		 //  chdir("../");
		}
		$d->close();
	
	}
	function showMeFuture(){
		$d=dir("./");
	}
	static function whereAmI(){
		echo"<br /><br /><br />************************************ <br />";
		echo "__DIR__ :    ".__DIR__."<br />";
		echo "getcwd() :     ".getcwd()."<br />";
		echo "Root :      $nbsp".$_SERVER['PHP_SELF']."<br />";
		echo"************************************ <br /><br /><br /><br />";
		
	}
	
	static function arrayShower($arr){//так удобнее
		echo "<pre>";
		print_r($arr);
		echo"</pre>";		
	}

	function tellAbout(){
		/*
			получаем содержание about.txt
		*/
		$text= file($this->adress."/about.txt")[0] ."<br />";
		
		/*
			debig, если чё
		*/
		//echo "<br />This is a text: ".$text."<br />";
		//echo "This is a getcwd: ".getcwd()	   ."<br />";
		//echo "This is an adress var: ".$this->adress."<br />";

	}	
	function showExts(){
		self::arrayShower($this->exts);
	}

	
} // the end of a class Page


/*
	дописать создание нового элемента
*/
$dom = new DOMDocument('1.0', 'utf-8');

$element = $dom->createElement('test', 'This is the root element!');

// We insert the new element as root (child of the document)
$dom->appendChild($element);








