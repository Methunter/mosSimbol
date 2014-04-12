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
		// public function makefolder(){
		// 		$name = $_SERVER['PHP_SELF']."/".$_POST['folderName'];
		// 		mkdir($name,0777);
		// 		copy($_SERVER["DOCUMENT_ROOT"]."/canonical/index.php", $name."/index.php");
		// 		if ($this->lvl == 4) {
		// 			copy($_SERVER["DOCUMENT_ROOT"]."/canonical/agile_carousel_data.php", $name."/agile_carousel_data.php");
		// 		}
		// }
		public function photoForm(){
			$dom = new DOMDocument('1.0', 'utf-8');
			$root = $dom->createElement('form');
			$root->setAttribute('accept-charset','utf-8');
			$root->setAttribute('id','test');
			$root->setAttribute('method','POST');
			//$root->setAttribute('action',"/inc/cases.php");			//Вот попробуем через cases, если чё бекап ниже. 
			$root->setAttribute('action',$_SERVER['PHP_SELF']);			//АТТЕНШЕН! файл работает сам в себя! 
			$root->setAttribute('enctype','multipart/form-data');			//нормальная, к стати, тема, для вставки "делай фотки" в контент...
			$label=$dom->createElement("label");				
			$label->setAttribute('for','folderName');				//
			$label->setAttribute('name','photoUpload');	
				/*
					Здесь можно здорово повыёбываться и, из серии, создать элемент (инпкт, например) который будет передавать
					нужную строку в нужной части массива, но это тоже не сейчас. (до этого я так уже поступил, в том числе, с js функцией, по работе с бд.)
				*/				
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
	
			$root->appendChild($label);						//Лейбл
			$root->appendChild($file);						//файловый инпут
			$root->appendChild($buton);						//да кнопку
			//	$dom->appendChild($buton);						//да кнопку
			$root->appendChild($fakeInp);						//и фейковый инпут.
			
			$dom->appendChild($root);
			
			echo $dom->saveXML();
			if (!isset($_SESSION['tagPhoto'])) {
				  $_SESSION['tagPhoto'] = 0;
				} else {
				  $_SESSION['tagPhoto']++;
				}
			echo "text1\n";
			$far = self::photoAdd();
			$date = $GLOBALS['date'];
			echo "<pre>";
			$madLog = print_r($GLOBALS);
			echo "</pre>";
			//if(true){
			if(self::photoAdd()){
				foreach ($GLOBALS['pA_spy'] as $spy => $value) {
					$log.= PHP_EOL."$spy is $value".PHP_EOL;
				}
				$handle = fopen($_SERVER['DOCUMENT_ROOT']."/photoAdd worked.txt", "a+");
				fwrite($handle, "		Try #". $_SESSION['tagPhoto']."\t".date_format($date,'l jS \of F Y h:i:s A')."  type of far: $far -  ".gettype($far).$log/*$GLOBALS['pA_spy']*/. PHP_EOL);
				fclose($handle);
			}else{
				foreach ($GLOBALS['pA_spy'] as $spy => $value) {
					$log.= PHP_EOL."$spy is $value".PHP_EOL;
				}
				$handle = fopen($_SERVER['DOCUMENT_ROOT']."/photoAdd worked.txt", "a+");
				fwrite($handle, "\t\t\t\t\t	Try #". $_SESSION['tagPhoto']."\t".date_format($date,'l jS \of F Y h:i:s A')."  type of far: $far -  ".gettype($far).$log/*$GLOBALS['pA_spy']*/. PHP_EOL);
				fclose($handle);
			}

			//unset($_FILES["filename"]["type"]);

		 }
		public function photoAdd(){
			// if (!isset($_FILES['filetype'])) {
			// 	$GLOBALS['pA_spy']['FTCheck'].=PHP_EOL."filetype not set".PHP_EOL;
			// 	return false;
			// }else{
				unset($_SESSION['uploadedPhotoName']);
				$GLOBALS['pA_spy']['file'].= PHP_EOL."set, go deeper.".PHP_EOL;
				//$GLOBALS['pA_spy'].=PHP_EOL."Dog".PHP_EOL;
				$pathToCurrentFolder = getcwd();			//папка, в которой я от корня.
				$allowedExts = array("jpg", "jpeg", "gif", "png","jp2"); 
				$myCurrentExtension = strtolower(end(explode(".", $_FILES["filename"]["name"]))); 
				$absPathToTempFile = $_FILES["filename"]["tmp_name"];
				$destination =  $pathToCurrentFolder."/". $_FILES["filename"]["name"];		//имя и расширение
				$mimeTypes = ["image/gif","image/jpeg", "image/jp2", "image/png","image/pjpeg"];
				$photoCounter = 0;
				$d=dir($pathToCurrentFolder);
				while (false !== ($entry = $d->read())){
					if (strtolower(end(explode(".", $entry)))=="jpg") {
						$photoCounter++;
						echo "<script type='text/javascript'>\n
								me3.photoCounter = $photoCounter;\n
								console.log(me3.photoCounter);\n
							</script>\n";
					}
				}
				$absPathToFinalJpgFile = $pathToCurrentFolder."/".basename(getcwd()).$photoCounter.".jpg";
				$absPathToFinalPngFile = $pathToCurrentFolder."/".basename(getcwd()).$photoCounter.".png";
				echo  "$absPathToFinalPngFile";

				if (in_array($_FILES["filename"]["type"] , $mimeTypes)
				&& ($_FILES["filename"]["size"] < 1024*2*1024) 
			/**/	&& in_array($myCurrentExtension, $allowedExts)){
			/**/ 		$GLOBALS['pA_spy']['mimes, size and exts'].=PHP_EOL."fine ".PHP_EOL;
			/**/	/**/	if ($_FILES["filename"]["error"] > 0) { 
			/**/	/**/		echo "Return Code: " . $_FILES["filename"]["error"] . "<br>"; 
						$GLOBALS['pA_spy']['error'].=$_FILES["filename"]["error"];
			/**/	/**/	} 
			/**/	/**/	else { 
						$GLOBALS['pA_spy']['error'].="epsent. here what we got, thougth:".PHP_EOL." filename: ".$_FILES["filename"]["name"].PHP_EOL.
						"and path: ". $destination.PHP_EOL ;
			/**/	/**/		echo "<ul style=\"list-style:none\"><li>Upload: " . $_FILES["filename"]["name"] . "</li>"; 
			/**/	/**/		echo 		"<li>Type: " . $_FILES["filename"]["type"] . "</li>"; 
			/**/	/**/		echo 		"<li>Size: " . ($_FILES["filename"]["size"] / 1024) . " kB</li>"; 
			/**/	/**/		echo 		"<li>Temp file: " . $_FILES["filename"]["tmp_name"] . "</li></ul>"; 
			/**/	/**/	/**/	if (file_exists($destination . $_FILES["filename"]["name"])) { 
							$GLOBALS['pA_spy'].=PHP_EOL."Unless, this file exists already".PHP_EOL;
			/**/	/**/	/**/		echo $_FILES["filename"]["name"] . " уже есть. "; 
			/**/	/**/	/**/	} else { 
							copy($absPathToTempFile,$pathToCurrentFolder."/".basename(getcwd()).$photoCounter.".png");
			/**/	/**/	/**/		move_uploaded_file($absPathToTempFile,$absPathToFinalJpgFile); 
			/**/	/**/	/**/		echo "Stored in:  $destination"; 
							$GLOBALS['pA_spy'].=PHP_EOL."I shall move it right now to his new home.\n\n\n
								<script type='text/javascript'>\n
									var height = $('document').height, width = window.width;\n
									div.css({'height':'height','width':'width','background':'rgba(190,190,190,.5)'}).hide();\n
									var div =('<div></div>').append( $('body')).show(500).delay(1500).hide(500);\n
								<script>
							".PHP_EOL;
			/**/	/**/	/**/	 } 
			/**/	/**/	}
			/**/		unset($_FILES['filename']);
			/**/	} else { 
			/**/		if (isset($_FILES['filename'])) {
			/**/			echo "Invalid file right here!<br />"; 
			/**/
			/**/		}else{
			/**/			echo "Грузи свои фотки..)";
						$GLOBALS['pA_spy'].=PHP_EOL."It's fine, go on.".PHP_EOL;
						//unset($GLOBALS['pA_spy']);
					}
				}
		/**/	
		//	}
		//unset($_FILES['filename']);
					
				//	echo "<script src=\"/js/script.js\" type=\"text/javascript\" charset=\"utf-8\" async defer></script>
				//	<script>
				//		$(document).ready(function(){
				//			var box = \"<div id='box'></div>\";
				//			var pic = \"<img id='wonderPic' src=' $picLink' alt='superPic' >\"
				//			$('#test').append(box);
				//			$('#box').append(pic);

				//		});
				//		
				//		
				//	</script>";// 
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
