<?php
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


						if($entry1 == "about.txt"){
					   		$txtAbout=file("about.txt");
					   		$txtAbout= $txtAbout[0];
					   		$textAbout=$dom->createTextNode($txtAbout);
					   		$about=$dom->createElement("p");
					   		$about->appendChild($textAbout);
					   		$about->setAttribute("class","about");
					   		$root->appendChild($about);
					   		
					  }
				   		if (!is_dir($entry1)
				   		&& $entry1 !=="about.txt"){
							$img=$dom->createElement("img");
							$img->setAttribute("src", $entry."/".$entry1);
							$li=$dom->createElement("li");
							$li->appendChild($img);
							$mng->appendChild($li);
							$img->setAttribute("class","pic");
				   		
				   		
						}
						$root->appendChild($mng);
						
				}
				
				
				$d1->close();
			   	chdir("..");
			   	echo $dom->saveXML();
			   	
		   }
		 //  chdir("../");
		}
		$d->close();
		
	}
	?>