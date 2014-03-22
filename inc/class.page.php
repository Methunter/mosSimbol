<?php

class  Page {
	
	public $iAmIn;//getcwd()
	public $content=array();//goGetIt()
	public $types;
	public $pics = array("jpg","png","gif"); 
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
	function getExtension($filename) {
    return end(explode(".", $filename));
  }

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
		$d = dir(".");
		while (false !== ($entry = $d->read())){
			if(is_dir($entry)
			&& $entry!=="." 
			&& $entry!==".."){
				$dom = new DOMDocument('1.0', 'utf-8');
				$root = $dom->createElement('div');
				$root->setAttribute('class','signItem');
				$title=$dom->createElement("h2");
				$link=$dom->createElement("a");
				$link->setAttribute("href",$entry);
				$title->setAttribute("class","title");
				$text = $dom->createTextNode("$entry");
				$title->appendChild($text);
				$mainPic=$dom->createElement("img");
				$mainPic->setAttribute("class","titlePic");
				chdir($entry);
				$d1=dir(".");
				while (false !== ($entry1 = $d1->read())){
					if($this->getExtension($entry1)=="JPG"){
						if(strcasecmp($entry1, "main")){
							$mainPic->setAttribute("src","$entry/$entry1");
							$link->appendChild($mainPic);
						}
					}
				}
				$link->appendChild($title);
				$root->appendChild($link);
				$dom->appendChild($root);
				chdir("..");
				echo $dom->saveXML();
			}
		}
	}
				
	function tellAboutCurrentItem(){
		$d = dir(getcwd());
		while (false !== ($entry = $d->read())){
			if($this->getExtension($entry)==="txt"){
				$this->dom = new DOMDocument('1.0', 'utf-8');
				$root = $this->dom->createElement('div');
				$root->setAttribute('id','aboutItem');
				$txtAbout=file("about.txt");
				$txtAbout= $txtAbout[0];
				$textAbout=$this->dom->createTextNode($txtAbout);
				$title=$this->dom->createElement("h2");
				$path=basename(getcwd());
				$titleText=$this->dom->createTextNode($path);
				$title->appendChild($titleText);
				$about=$this->dom->createElement("p");
				$about->setAttribute("class","about");
				$title->setAttribute("id","title");
				$about->appendChild($textAbout);	
				$root->appendChild($title);
				$root->appendChild($about);
				$this->dom->appendChild($root);
				
			   	echo $this->dom->saveXML();

			}
		
		}
$d->close();
	}
	static function whereAmI(){
		echo"<br /><br /><br />************************************ <br />";
		echo "__DIR__ :    ".__DIR__."<br />";
		echo "getcwd() :     ".getcwd()."<br />";
		echo "Root :      $nbsp".$_SERVER['PHP_SELF']."<br />";
		echo"************************************ <br /><br /><br /><br />";
		
	}
	



	
} // the end of a class Page









