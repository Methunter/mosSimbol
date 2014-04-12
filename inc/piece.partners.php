<link rel="stylesheet" type="text/css" href="../stylesheets/style.css">

<?php
	$d=dir("../images/partners");
	echo "<div id='partners'>";
	echo "<div id='partnersWindow'>";
	while (false !== ($entry = $d->read())){
		if($entry!=="." 
		&& $entry!==".."
		&& $entry!==".DS_Store"){		
			echo "<img src='/images/partners/".$entry."'' />";
		}
	}
	echo "</div>";
	echo "</div>";



?>

<!-- 
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
	} -->