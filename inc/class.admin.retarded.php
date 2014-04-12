<?php
	class Admin{
		public $lvl;
		public function folderForm($lvl){
			$this->lvl = $lvl;
			$dom = new DOMDocument('1.0', 'utf-8');
			$root = $dom->createElement('form');
			$root->setAttribute('accept-charset','utf-8');
			$root->setAttribute('method','POST');
			$root->setAttribute('id','mkFForm');
			$label=$dom->createElement("label");
			$label->setAttribute('for','folderName');
			$create = $dom->createTextNode("Создать");
			$label->appendChild($create);					//про первый инпут
			$text = $dom->createElement("input");				//про первый инпут	
			$text->setAttribute("type","text");					//про первый инпут
			$text->setAttribute("tabindex","1");					//про первый инпут
			$text->setAttribute("id","folderName");				//про первый инпут	
			$text->setAttribute("placeholder","Введите имя папки");		//про первый инпут			
			$buton = $dom -> createElement("input");
			$buton->setAttribute("type","submit");
			$buton->setAttribute("value","Создать");
			$buton->setAttribute("id","actionCreateFolder");
			
			$root->appendChild($label);
			$root->appendChild($text);
			$root->appendChild($buton);
			$dom->appendChild($root);

			echo $dom->saveXML();
		 }
		public function moveToTrash($curPath ,$folderName ){


			$wFolder = $curPath."/".$folderName;
			$trash = $_SERVER["DOCUMENT_ROOT"]."/Trash/".$folderName;					//	
			$delFile =$wFolder."/index.php";									//	
			$filesTodelete=[$wFolder."/index.php",$wFolder."/agile_carousel_data.php"];			//	сейчас, наверное нет, но позже надо 
			echo "[Class.Admin.php::folderRemove] :\n folderName". $folderName."\n";				//	проработать идею за просмотр папок
			echo "[Class.Admin.php::folderRemove] :\n __FILE__". __FILE__."\n";					//	и разбирательства по поводу файлов, чё
			echo "\n[Class.Admin.php::folderRemove] :\n папка: ".$wFolder."\n Файл: \t".$wFolder."/index.php";//	куда. 
			echo " \n\n[Class.Admin.php::folderRemove] :\n getcw".getcwd();					//	
			echo "\n\n\n[Class.Admin.php::folderRemove] :\n LOOK! ".$wFolder."\n\n";				//	из серии:
			mkdir($trash);												//	Эта папка-> файл, файл ... папка
			foreach ($filesTodelete as $dir) {									//	(копировать по адресу, создать alias..) 
				copy($dir,$trash);										//	и в ней ещё посмотреть.
				unlink($dir);											//	
																//	
			}																			
			rename($wFolder, $trash);
			//unlink($delFile);
			//rmdir($wFolder) ;		//на случай экстренного удаления...

		 }
		public function makefolder($name, $lvl){
			//echo "hello from MF!";
				chdir("..".$_POST['curPath']);

			if (isset($_POST['curPath'])) {
				if (isset($_POST['folderName'])) {
					$oldumask = umask(0);
					mkdir($name, 0777);
					umask($oldumask);
					copy($_SERVER['DOCUMENT_ROOT']."/canonical/index.php", $name."/index.php");
					if ($lvl == 4) {
						copy($_SERVER["DOCUMENT_ROOT"]."/canonical/agile_carousel_data.php", $name."/agile_carousel_data.php");
					}
				}

			}
		 }
		public function photoForm(){
			$dom = new DOMDocument('1.0', 'utf-8');
			$root = $dom->createElement('form');
			$root->setAttribute('accept-charset','utf-8');
			$root->setAttribute('id','test');
			$root->setAttribute('method','POST');
			$root->setAttribute('action',$_SERVER['PHP_SELF']);			//АТТЕНШЕН! файл работает сам в себя! 
			$root->setAttribute('enctype','multipart/form-data');			//нормальная, к стати, тема, для вставки "делай фотки" в контент...
			$label=$dom->createElement("label");				
			$label->setAttribute('for','folderName');				//
			$label->setAttribute('name','photoUpload');
			$upload = $dom->createTextNode("Загрузить");
			$label->appendChild($upload);					//про первый инпут
			$file = $dom->createElement("input");				//про первый инпут	
			$file->setAttribute("type","file");					//про первый инпут
			$file->setAttribute("name","filename");				//про первый инпут				
			$buton = $dom -> createElement("input");
			$buton->setAttribute("type","submit");
			$buton->setAttribute("value","Загрузить");
			$buton->setAttribute("id","buttonUpload");				//Таким образом имеем всего:
			$fakeInp = $dom->createElement("input");					//	фейковый инпут
			$fakeInp->setAttribute("style","display:none");				//	который не видать, 
			$fakeInp->setAttribute("type","text");					//	передаёт команду в cases
			$fakeInp->setAttribute("name","action");					//	в элементе action
			$fakeInp->setAttribute("value","photoUpload");
			$root->appendChild($label);						//Лейбл
			$root->appendChild($file);						//файловый инпут
			$root->appendChild($buton);						//да кнопку
			$root->appendChild($fakeInp);						//и фейковый инпут.
												//и фейковый инпут.
			
			$dom->appendChild($root);							//	Я молодец!
			
			echo $dom->saveXML();

			if (!isset($_SESSION['tagPhoto'])) {
				  $_SESSION['tagPhoto'] = 0;
				} else {
				  $_SESSION['tagPhoto']++;
				}
			$far = self::photoAdd();
			$date = $GLOBALS['date'];		//вот эту можно оставить)
			if(self::photoAdd()){
				$handle = fopen($_SERVER['DOCUMENT_ROOT']."/photoAdd worked.txt", "a+");
				fwrite($handle, "Try #". $_SESSION['tagPhoto']."\t".date_format($date,'l jS \of F Y h:i:s A')."  type of far: $far -  ".gettype($far).$log. PHP_EOL);
				fclose($handle);
			}else{
				$handle = fopen($_SERVER['DOCUMENT_ROOT']."/photoAdd worked.txt", "a+");
				fwrite($handle, "\t\t\t\t\tTry #". $_SESSION['tagPhoto']."\t".date_format($date,'l jS \of F Y h:i:s A')."  type of far: $far -  "
					.gettype($far).$log. PHP_EOL);
				fclose($handle);
			}
		 }
		public function photoAdd(){	
			// unset($_FILES["filename"]);
			// print_r(array_values($_FILES["filename"]));
			if (!isset($_FILES["filename"])) {
				return false;
				exit();
				break;
			}
			else{
				$fullPathToCurrentFolder = getcwd();			//папка, в которой я от корня.
				$allowedExts = array("jpg", "jpeg", "gif", "png","jp2"); 
				$myCurrentExtension = strtolower(end(explode(".", $_FILES["filename"]["name"]))); 
				$fullPathToTempFile = $_FILES["filename"]["tmp_name"];
				$originalFile =  $_FILES["filename"]["name"];		//имя и расширение
				$mimeTypes = ["image/gif","image/jpeg", "image/jp2", "image/png","image/pjpeg"];
				$photoCounter = 0;
				$d=dir($fullPathToCurrentFolder);
						
				while (false !== ($entry = $d->read())){
					if (strtolower(end(explode(".", $entry)))=="jpg") {
						$photoCounter++;
					}
				}
				$fullFileNameJpg = basename(getcwd()).$photoCounter.".jpg";
				$fullFileNamePng = basename(getcwd()).$photoCounter.".png";
				$fullPathToFinalJpgFile = $fullPathToCurrentFolder."/".$fullFileNameJpg;
				$fullPathToFinalPngFile = $fullPathToCurrentFolder."/".$fullFileNamePng;
				if (in_array($_FILES["filename"]["type"] , $mimeTypes)
				&& ($_FILES["filename"]["size"] < 1024*2*1024) 
				&& in_array($myCurrentExtension, $allowedExts)){

					if ($_FILES["filename"]["error"] > 0) { 
						echo "Return Code: " . $_FILES["filename"]["error"] . "<br>"; 
					} 
					else { 
						echo "<br /><br /><ul style='list-style: none;position: absolute;float: left;top: 400px;right: -100px;padding: 0px'><li>Имя Оригинального файла: " . $originalFile  . "</li>"; 
						echo 		"<li>Имя созданного файла: " . $fullFileNameJpg  . " </li>"; 
						echo 		"<li>Тип файла: " . $_FILES["filename"]["type"] . "</li>"; 
						echo 		"<li>Размер файла: " . ($_FILES["filename"]["size"] / 1024) . " kB</li>"; 
						echo 		"<li>Временное имя файла: " . $_FILES["filename"]["tmp_name"] . "</li></ul>"; 
						if (in_array($_FILES["filename"]["name"] , $_SESSION)) { 
							echo  "Такой файл уже есть. "; 

						} else { 
							copy($fullPathToTempFile,$fullPathToFinalPngFile);
							move_uploaded_file($fullPathToTempFile,$fullPathToFinalJpgFile); 
							echo "Stored in:  $fullPathToFinalJpgFile\n\n<br />"; 
							echo "	<script type='text/javascript'>
									alert('hi!');
								<script>";
						 } 	//переместить файлы и похвастать
					}
					unset($_FILES['filename']);
					return 0;
					exit();
					echo 		"Имя созданного файла: " . $_FILES["filename"]["name"]  . " "; 

				 } else { 
					if (isset($_FILES['filename'])) {
						echo "Invalid file right here!<br />"; 
					}else{
						echo "<div>Грузи свои фотки..)</div><br />";
					}
			 	}
			 }
 	 	return true;
 	 	}
		public function descForm(){
			$dom = new DOMDocument('1.0', 'utf-8');
			$root = $dom->createElement('form');
			$root->setAttribute('accept-charset','utf-8');
			$root->setAttribute('method','POST');
			$root->setAttribute('id','mkTextAbout');
			$root->setAttribute('action','/inc/cases.php');
			$textarea = $dom->createElement("textarea");
			$textarea->setAttribute("type","textarea");
			$textarea->setAttribute("form","mkTextAbout");
			$textarea->setAttribute("name","descForm");
			$textarea->setAttribute("cols","75");
			$textarea->setAttribute("raws","50");
			$textarea->setAttribute("tabindex","1");
			$textarea->setAttribute("placeholder","Введите описание товара");
			$fuf = $dom->createTextNode("");
			$buton=$dom->createElement("input");
			$buton->setAttribute("type","submit");
			$buton->setAttribute("id","actionCreateDesc");
			$buton->setAttribute("name","descButton");
			$fakeInp = $dom->createElement("input");					//	фейковый инпут
			$fakeInp->setAttribute("style","display:none");				//	который не видать, 
			$fakeInp->setAttribute("type","text");						//	передаёт команду в cases
			$fakeInp->setAttribute("name","action");					//	в элементе action
			$fakeInp->setAttribute("value","deskForm");					//					Я молодец!

			$textarea->appendChild($fuf);

			$root->appendChild($buton);
			$root->appendChild($textarea);
			$root->appendChild($fakeInp);
			$dom->appendChild($root);

			echo $dom->saveXML();
		 }
		public function deskAdd($descForm){
			//$handle = fopen($_SERVER['PHP_SELF']."/about.txt", 'c+');
			//fwrite($handle, $deskForm);
			//fclose($handle);
			echo "<h1>".$_SERVER['PHP_SELF']."</h1>";
		 }
	}
$admBiz = new Admin; 
?>
