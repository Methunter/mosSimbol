<?php
/*
	создаёт элемент, в котором прописываются пути к файлам и прочий дебагинфо
*/

	class Debug {

		
	 function crDebEl(){
		

		/*
 $dom = new DOMDocument('1.0', 'utf-8');
				$root = $dom->createElement('div');
				$root->setAttribute('id','debug');
					$p1=$dom->createElement("p");
						$text = $dom->createTextNode("************************************ ");
						$p1->appendChild($text);
						$root->appendChild($p1);
					$p2=$dom->createElement("p");
						$text = $dom->createTextNode("<pre>".print_r($_COOKIE)."</pre>");
						$p2->appendChild($text);
						$root->appendChild($p2);
*/
						echo "<pre>".print_r($_COOKIE)."</pre>";
					/*
$p3=$dom->createElement("p");
						$text = $dom->createTextNode("getcwd() :     ".getcwd());
						$p3->appendChild($text);
						$root->appendChild($p3);
					$p4=$dom->createElement("p");
						$text = $dom->createTextNode("Root :      $nbsp".$_SERVER['PHP_SELF']);
						$p4->appendChild($text);
						$root->appendChild($p4);
					$p5=$dom->createElement("p");
						$text = $dom->createTextNode("************************************");
						$p5->appendChild($text);
						$root->appendChild($p5);
					$p6=$dom->createElement("p");
						$text = $dom->createTextNode("basename getcwd: ". dirname($_SERVER['PHP_SELF'])."/".$entry1);
						$p6->appendChild($text);
						$root->appendChild($p6);
*/
/*
					$p7=$dom->createElement("p");
					$d = dir(".");
					while (false !== ($entry = $d->read())){
						if(is_dir($entry)
						&& $entry!=="." 
						&& $entry!==".."){
							chdir("$entry");
							$netxPath = "dirname getcwd: ". dirname(getcwd());
							chdir("..");
						
						$text = $dom->createTextNode($nextPath);
						$p7->appendChild($text);
						$root->appendChild($p7);
*/
					$dom->appendChild($root);
			print $dom->saveXML();


		}

	}

?>
