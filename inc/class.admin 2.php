<?php

/*
	нормально грузятся фотки.
*/
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
			//$dom->appendChild($buton);
			$dom->appendChild($root);

			echo $dom->saveXML();
		}
		public function moveToTrash($curPath ,$folderName ){
			//curPath приходит из script.js  <---->настоящий адрес (/Каталог/ и так далее)
			//folderName приходит из script.js  <---->имя рабочей папки

			//но, сначала, почистим всё из папки:

			$wFolder = $curPath."/".$folderName;
			$d=dir($wFolder);												//	
			$trash = $_SERVER["DOCUMENT_ROOT"]."/Trash/".$folderName;						//	
			$delFile =$wFolder."/index.php";										//	
			$filesTodelete=[$wFolder."/index.php",$wFolder."/agile_carousel_data.php"];				//	сейчас, наверное нет, но позже надо 
			echo "[Class.Admin.php::folderRemove] :\n folderName". $folderName."\n";					//	проработать идею за просмотр папок
			echo "[Class.Admin.php::folderRemove] :\n __FILE__". __FILE__."\n";						//	и разбирательства по поводу файлов, чё
			echo "\n[Class.Admin.php::folderRemove] :\n папка: ".$wFolder."\n Файл: \t".$wFolder."/index.php";	//	куда. 
			echo " \n\n[Class.Admin.php::folderRemove] :\n getcw".getcwd();						//	
			echo "\n\n\n[Class.Admin.php::folderRemove] :\n LOOK! ".$wFolder."\n\n";					//	из серии:
			mkdir($trash);													//	Эта папка-> файл, файл ... папка(копировать
			foreach ($filesTodelete as $dir) {										//	по адресу, создать alias..) и в ней ещё посмотреть.
				copy($dir,$trash);											//	
				unlink($dir);												//	
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
			$root->setAttribute('id','photoForm');
			$root->setAttribute('method','POST');
			$root->setAttribute("enctype","multipart/form-data");
			//$root->setAttribute('action',"/inc/cases.php");			//Вот попробуем через cases, если чё бекап ниже. 
			$root->setAttribute('action',$_SERVER['PHP_SELF']);			//АТТЕНШЕН! файл работает сам в себя! 
												//нормальная, к стати, тема, для вставки "делай фотки" в 
			$label=$dom->createElement("label");				//контент...
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
			$fakeInp->setAttribute("value","photoUpload");				//					Я молодец!
			
			$fIPath = $dom->createElement("input");			
			$fIPath->setAttribute("type","hidden");			
			$fIPath->setAttribute("name","curPath");		
			$fIPath->setAttribute("value",getcwd());	

			$root->appendChild($label);						//Лейбл
			$root->appendChild($file);						//файловый инпут
			$root->appendChild($buton);						//да кнопку
			//	$dom->appendChild($buton);						//да кнопку
			$root->appendChild($fakeInp);						//и фейковый инпут.
			$root->appendChild($fIPath);						//и фейковый инпут.
			
			$dom->appendChild($root);
			
			echo $dom->saveXML();
			if(isset($_POST['action']) && $_POST['action']=="photoUpload"){
				self::photoAdd(getcwd());
				unset($_POST['action']);
			}			
			$date = $GLOBALS['date'];
			echo "<pre>";
			print_r($_SESSION);
			echo "</pre>";
			echo "<pre>";
			print_r($_POST);
			echo "</pre>";
			if (!isset($_FILES)) {
				echo "not set";
			}else{
				echo "set files";
			}

		 }
		public function photoAdd($pathToCurrentFolder){
			
			$allowedExts = array("jpg", "jpeg", "gif", "png","jp2"); 
			$currentFileExtension = strtolower(end(explode(".", $_FILES["filename"]["name"]))); 
			$fullPathToTempFile = $_FILES["filename"]["tmp_name"];
			$mimeTypes = ["image/gif","image/jpeg", "image/jp2", "image/png","image/pjpeg"];
			$photoCounter = 0;
			$destination =  $pathToCurrentFolder."/". $_FILES["filename"]["name"];		//имя и расширение
			$d=dir($pathToCurrentFolder);
			while (false !== ($entry = $d->read())){
				if (strtolower(end(explode(".", $entry)))=="jpg") {
					$photoCounter++;
				}
			}
			$_SESSION['uploadedPhotos']['photoCounter'] = $photoCounter;
			$fullPathToFinalJpgFile = $pathToCurrentFolder."/".basename($pathToCurrentFolder).$photoCounter.".jpg";
			$fullPathToFinalPngFile = $pathToCurrentFolder."/".basename($pathToCurrentFolder).$photoCounter.".png";

			if (in_array($_FILES["filename"]["type"] , $mimeTypes)
			&& ($_FILES["filename"]["size"] < 1024*2*1024) 
			&& in_array($currentFileExtension, $allowedExts)){
				if ($_FILES["filename"]["error"] > 0) { 
					echo "Return Code: " . $_FILES["filename"]["error"] . "<br>"; 
				}else { 
				echo "<ul style=\"list-style:none\"><li>Upload: " . $_FILES["filename"]["name"] . "</li>"; 
					echo 		"<li>Type: " . $_FILES["filename"]["type"] . "</li>"; 
					echo 		"<li>Size: " . ($_FILES["filename"]["size"] / 1024) . " kB</li>"; 
					echo 		"<li>Temp file: " . $_FILES["filename"]["tmp_name"] . "</li></ul>"; 

					if (($_FILES["filename"]["name"] =$_SESSION['previouslyLoadedPhotos'])) { 
						echo $_FILES["filename"]["name"] . " уже есть. "; 
						//array_push($_SESSION['previouslyLoadedPhotos'], $_FILES["filename"]["name"] );
						
					} else { 
						copy 			($_FILES["filename"]["tmp_name"],	$fullPathToFinalPngFile);
						move_uploaded_file 	($_FILES["filename"]["tmp_name"],	$fullPathToFinalJpgFile); 
						echo "Stored in:  $fullPathToFinalJpgFile"; 
						unset($_FILES);
						//unset($_SESSION['Loaded'] );
						$_SESSION['Loaded']  = true;
						$_SESSION['previouslyLoadedPhotos'] = $_FILES["filename"]["name"] ;
						goto end;
				 	} 
				}
				//unset($_FILES);
			} else { 
				if (isset($_FILES['filename'])) {
				echo "Invalid file right here!<br />"; 
		
				}else{
					echo "Грузи свои фотки..)";
					//unset($GLOBALS['pA_spy']);
				}
			}
		end:
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
			$fakeInp->setAttribute("type","text");					//	передаёт команду в cases
			$fakeInp->setAttribute("name","action");					//	в элементе action
			$fakeInp->setAttribute("value","deskForm");				//					Я молодец!

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
