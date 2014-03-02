<?php

class  Page {
	
	public $iAmIn;//getcwd()
	public $content=array();//goGetIt()
	public $types;
	public $exts = array("jpg","png","gif"); 
	public $folderItem;
	public $files=array();
	public $dir;
	private $d;
	private $dom;
	
/*
	function __construct(){
		if (isset($_GET['width']) AND isset($_GET['height'])){
			echo "Ширина экрана: ". $_GET['width'] ."<br />\n"; 
			echo "Высота экрана: ". $_GET['height'] ."<br />\n"; 
		}else{
			echo "<script language='javascript'>\n"; 
			echo "document.location.href=\"${_SERVER['SCRIPT_NAME']}?${_SERVER['QUERY_STRING']}&width=\" + screen.width + \"&height=\" + screen.height;\n"; 
			echo "</script>\n"; 
			exit(); 
		}			
	}
*/

	function showFoldersList(){
		$this->d = dir(".");
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
	
	function showItToMe(){

		$this->d = dir(".");
		while (false !== ($entry = $this->d->read())){
			if(is_dir($entry)
			&& $entry!=="." 
			&& $entry!==".."){
				$this->dom = new DOMDocument('1.0', 'utf-8');
				$root = $this->dom->createElement('div');
				$root->setAttribute('class','signItem');
				$main = $this->dom->createElement('div');
				$main->setAttribute('class','main');
				$title=$this->dom->createElement("h2");
				$text = $this->dom->createTextNode("$entry");
				$title->setAttribute("class","title");
				$title->appendChild($text);
				$about=$this->dom->createElement("p");
				$mng=$this->dom->createElement("ul");
				$mng->setAttribute("class","minigal");	
				chdir("$entry");
				$d1=dir(".");
				while (false !== ($entry1 = $d1->read())){
					if (!is_dir($entry1)
			   		&& $entry1 !=="about.txt"){
						$img=$this->dom->createElement("img");
						$img->setAttribute("src", $entry."/".$entry1);
						$li=$this->dom->createElement("li");
						$li->appendChild($img);
						$mng->appendChild($li);
						$img->setAttribute("class","pic");
					}
					if($entry1 == "about.txt"){
				   		$txtAbout=file("about.txt");
				   		$txtAbout= $txtAbout[0];
				   		$textAbout=$this->dom->createTextNode($txtAbout);
				   		$about->appendChild($textAbout);
				   		$about->setAttribute("class","about");
				   	}
				   	$main->appendChild($about);
					$main->insertBefore($mng, $about);
				}
				$root->appendChild($main);
				$root->appendChild($title);
				$this->dom->appendChild($root);
				$d1->close();
			   	chdir("..");
			   	echo $this->dom->saveXML();   	
		   }
		}
		$this->d->close();
	}
	static function whereAmI(){
		echo"<br /><br /><br />************************************ <br />";
		echo "__DIR__ :    ".__DIR__."<br />";
		echo "getcwd() :     ".getcwd()."<br />";
		echo "Root :      $nbsp".$_SERVER['PHP_SELF']."<br />";
		echo"************************************ <br /><br /><br /><br />";
		
	}
	



	
} // the end of a class Page









