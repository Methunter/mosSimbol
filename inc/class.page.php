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
	// private $botto  n;

		
	function getExtension(/*string*/ $filename) {
		$crushedName=explode (".", $filename);
		return end ($crushedName);
  	 }
  	function folders(){
  		$d = dir(".");
		while (false !== ($entry = $d->read())){
			if(is_dir($entry)
			&& $entry!=="." 
			&& $entry!==".."){
				echo( "$entry \n");
			}
		}
  	 }  	
  	function files(){
  		$d = dir(".");
		while (false !== ($entry = $d->read())){
			if(!is_dir($entry)){
				echo "$entry \n";
			}
		}
  	 }
	function showFoldersList(){
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
		
		$d->close(); 			
	 }
	/*function navigationList){
		$d = dir("/Library/WebServer/Documents/msb/Каталог/");
		$origin = getcwd();
		echo "gtc = ".getcwd();
		// echo "<br />\norig = $origin\n\n\n\n";
		//chdir("/");
		// chdir("Каталог");
		// print_r(get_include_path());
		// echo getcwd();
		$dom = new DOMDocument('1.0', 'utf-8');
		$root = $dom->createElement('div');
		$root->setAttribute('class','catlist');
		while (false !== ($entry = $d->read())){
		   	if(is_dir($entry)
		   	&& $entry!=="." 
		   	&& $entry!==".."){
		   		$p=$dom->createElement("p");
		   		$text = $dom->createTextNode("$entry");
		   		$link = $dom->createElement("a");
		   		$link = $dom->createElement("a");
		   		$link->setAttribute("href",$entry);
		   		
		   		$link->appendChild($text);
		   		$p->appendChild($link);
		   		$root->appendChild($p);
		   }
		}
		$dom->appendChild($root);
		echo $dom->saveXML();
		chdir($origin);
		$d->close(); 			
	 }*/
	function prepareGallery(){
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
					if(strtolower($this->getExtension($entry1))=="jpg"){
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
				$txtAbout=file('about.txt');
				$myTxtAbout= $txtAbout[0];
				$textAbout=$this->dom->createTextNode($myTxtAbout);
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
	public function makeOrderButton(){
		$dom = new DOMDocument('1.0', 'utf-8');
		$root = $dom->createElement('form');
		$root->setAttribute('accept-charset','utf-8');
		$button=$dom->createElement('input');
		$button->setAttribute('type','submit');
		$button->setAttribute('name','action');
		$button->setAttribute('value','order');
		$button->setAttribute('id','order');

		$root->appendChild($button);
		$dom->appendChild($root);

		echo $dom->saveXML();
	 }
	public function makeCall(){
			$this->dom = new DOMDocument('1.0', 'utf-8');
				$root = $this->dom->createElement('div');
				$root->setAttribute('id','content');
				$root = $this->dom->createElement('div');
				$root->setAttribute('id','content');
				$txtAbout=file('about.txt');
				$myTxtAbout= $txtAbout[0];
				$textAbout=$this->dom->createTextNode($myTxtAbout);
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
	static function whereAmI(){
		echo"<br /><br /><br />************************************ <br />";
		echo "__DIR__ :    ".__DIR__."<br />";
		echo "getcwd() :     ".getcwd()."<br />";
		echo "php self :      $nbsp".$_SERVER['PHP_SELF']."<br />";
		echo"************************************ <br /><br /><br /><br />";
		
	 }
	

/*
//TODO: найти и установить checkinstall , и в целом, разобраться что написано на этом сайте.
//
*/
/*
//TODO: 	!----- httpd: stable 2.2.27==> Caveats brew httpd
//http://httpd.apache.org/
//Not installed
//From: https://github.com/homebrew/homebrew-dupes/commits/master/httpd.rb
//
//To have launchd start httpd at login:
//    ln -sfv /usr/local/opt/httpd/*.plist ~/Library/LaunchAgents
//Then to load httpd now:
//    launchctl load ~/Library/LaunchAgents/homebrew.mxcl.httpd.plist
////
//
//
*/

	
} // the end of a class Page





