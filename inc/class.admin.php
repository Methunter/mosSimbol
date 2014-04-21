<?php
class Admin{
	public $lvl;

	public  function folderForm($lvl){
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
		$buton->setAttribute("id","actionCreatekFolder");
		
		$root->appendChild($label);
		$root->appendChild($text);
		$root->appendChild($buton);
		//$dom->appendChild($buton);
		$dom->appendChild($root);

		echo $dom->saveXML();
		/*return $dom->saveXML();*/
	 }
	public function moveToTrash($curPath ,$folderName ){
		//curPath приходит из script.js  <---->настоящий адрес (/Каталог/ и так далее)
		//folderName приходит из script.js  <---->имя рабочей папки

		//но, сначала, почистим всё из папки:
		$timeZone = new DateTimeZone("Europe/Moscow");
		$date = new DateTime("now",$timeZone);
		$carpeDiem = $date->format('H:i:s');
		$wFolder = $curPath."/".$folderName;
		$d=dir($wFolder);												//	
		$trash = $_SERVER["DOCUMENT_ROOT"]."/Trash/".$folderName;						//	
		$delFile =$wFolder."/index.php";										//	
		$filesTodelete=[$wFolder."/index.php",$wFolder."/agile_carousel_data.php"];				//	сейчас, наверное нет, но позже надо 
		//echo "[Class.Admin.php::folderRemove] :\n folderName". $folderName."\n";					//	проработать идею за просмотр папок
		//echo "[Class.Admin.php::folderRemove] :\n __FILE__". __FILE__."\n";						//	и разбирательства по поводу файлов, чё
		//echo "\n[Class.Admin.php::folderRemove] :\n папка: ".$wFolder."\n Файл: \t".$wFolder."/index.php";	//	куда. 
		//echo " \n\n[Class.Admin.php::folderRemove] :\n getcw".getcwd();						//	
		/*date_default_timezone_set('Europe/Moscow');*/
		echo "\n[Class.Admin.php::folderRemove] :\n wFolder! ".$wFolder."\n";					//	из серии:
		$newFolderInTrash = $trash."_".$carpeDiem;
		rename($wFolder, $newFolderInTrash);
		while (false !== ($entry = $d->read())) {										//	по адресу, создать alias..) и в ней ещё посмотреть.
			if (is_dir($entry) && $entry!=="." && $entry!=="..") {
				chdir($entry);
				while (false != ($entry1 = $d->read())) {	
					if ($entry!=="index.php" && !is_dir($entry1)) {
						rename($curPath."/".$entry1,$trash."/".$entry);	
						unlink($curPath."/".$entry1);	
						chdir("..");
					}
				}
			}
			elseif ($entry!=="index.php" && !is_dir($entry)) {
				rename($curPath."/".$entry,$trash."/".$entry);	
				unlink($curPath."/".$entry);		
			}
													//	
													//	
																//	
		}																			
		//unlink($delFile);
		//rmdir($wFolder) ;		//на случай экстренного удаления...

	 }
	public function makefolder($name, $lvl){
		//echo "hello from MF!";
			//chdir("..".$_POST['curPath']);
			echo "\n";
			echo $name."\n";
		//	if (isset($lvl) {
			if (isset($name)) {
				$oldumask = umask(0);
				mkdir($name, 0744);
				umask($oldumask);
				copy($_SERVER['DOCUMENT_ROOT']."/canonical/index.php", $name."/index.php");
				if ($lvl == 4) {
					copy($_SERVER["DOCUMENT_ROOT"]."/canonical/agile_carousel_data.php", $name."/agile_carousel_data.php");
					copy($_SERVER["DOCUMENT_ROOT"]."/canonical/agile_carousel_data.php", $name."/upldPhotos.php.php");
				}
			}
		//}
		echo "[admBiz->makeFolder] : Finished working";
	 }
	public function photoForm(){
		$dom = new DOMDocument('1.0', 'utf-8');
		$root = $dom->createElement('form');
		$root->setAttribute('accept-charset','utf-8');
		$root->setAttribute('id','photoForm');
		$root->setAttribute('method','POST');
		$root->setAttribute("enctype","multipart/form-data");
		//$root->setAttribute('action',"/inc/cases.php");	//Вот попробуем через cases, если чё бекап ниже. 
		$root->setAttribute('action',$_SERVER['PHP_SELF']);	//АТТЕНШЕН! файл работает сам в себя! 
									//нормальная, к стати, тема, для вставки "делай фотки" в 
		$label=$dom->createElement("label");		//контент...
		$label->setAttribute('for','folderName');		//
		$label->setAttribute('name','photoUpload');			
		$upload = $dom->createTextNode("Загрузить");
		$label->appendChild($upload);			//про первый инпут
		$file = $dom->createElement("input");		//про первый инпут	
		$file->setAttribute("type","file");			//про первый инпут
		$file->setAttribute("name","filename");		//про первый инпут				
		$buton = $dom -> createElement("input");
		$buton->setAttribute("type","submit");
		$buton->setAttribute("value","Загрузить");
		$buton->setAttribute("id","buttonUpload");		//Таким образом имеем всего:
		$fakeInp = $dom->createElement("input");		//	фейковый инпут
		$fakeInp  ->setAttribute("type","hidden");			
		$fakeInp->setAttribute("name","action");		//	в элементе action
		$fakeInp->setAttribute("value","photoUpload");	//		Я молодец!
		
		$lkInp4Path = $dom->createElement("input");			
		$lkInp4Path->setAttribute("type","hidden");			
		$lkInp4Path->setAttribute("name","fullCurPath");		
		$lkInp4Path->setAttribute("value",getcwd());	
		
		 /*	$fkFrom = $dom->createElement("input");
		 	$fkFrom->setAttribute("type","hidden");	
		 	$fkFrom->setAttribute("name","from");
		 	$fkFrom->setAttribute("value",$prevNameInCurrentPhoto);	 
		 	$noExt = $dom->createElement("input");					//	фейковый инпут
		 	$noExt->setAttribute("type","hidden");			
		 	$noExt->setAttribute("name","action");					//	в элементе action
		 	$noExt->setAttribute("value",$noExtUpload);				//					Я молодец!
		 	$root->appendChild($fkFrom);						//и фейковый инпут.
		 	$root->appendChild($noExt);						//и фейковый инпут.
		 */
		$root->appendChild($label);			//Лейбл
		$root->appendChild($file);			//файловый инпут
		$root->appendChild($buton);			//да кнопку
		$root->appendChild($fakeInp);		//и фейковый инпут.
		$root->appendChild($lkInp4Path);		//и фейковый инпут.
		
		$dom->appendChild($root);
		echo $dom->saveXML();
		 /*	echo '<pre>';
		 	print_r($_POST);
		 	echo '</pre>';
		  */
	 
	 }
	public function photoAdd($pathToCurrentFolder){
		$names_I_Have = array();
		$allowedExts = array("jpg", "jpeg", "gif", "png","jp2"); 
		$_SESSION['names']=array();
		$_SESSION['names']['I__H']=$names_I_Have;
		$mimeTypes = ["image/gif","image/jpeg", "image/jp2", "image/png","image/pjpeg"];
		$photoCounter = 0;
		$d=dir($pathToCurrentFolder);
		while (false !== ($entry = $d->read())){
			$crushedEntry= explode (".", $entry);
			if ( strtolower ( end  ($crushedEntry))=="jpg") {
				$names_I_Have[$photoCounter]=(explode(".",$entry)[count((explode(".",$entry)))-2]);
				$photoCounter++;
				$input = explode(".", $entry);
				/*echo "<pre>" .$entry;
				print_r(array_slice($input, 0, 2)); 
				echo "</pre>";*/
				// array_push($names_I_Have ,(explode(".",$entry)[count((explode(".",$entry)))-2]));

			}
		}
		$d->close();

		if (isset($_FILES["filename"])){
			$destination =  $pathToCurrentFolder."/". $_FILES["filename"]["name"];		//имя и расширение
			$fullPathToTempFile = $_FILES["filename"]["tmp_name"];
			$cuttenName=explode(".", $_FILES["filename"]["name"]);
			$currentFileExtension = strtolower(end(($cuttenName))); 
			$fullPathToFinalJpgFile = $pathToCurrentFolder."/".basename($pathToCurrentFolder)."_".$photoCounter."-"
			.current(explode(".",$_FILES['filename']['name'])).".jpg";
			$fullPathToFinalPngFile = $pathToCurrentFolder."/".basename($pathToCurrentFolder)."_".$photoCounter."-".
			current(explode(".",$_FILES['filename']['name'])).".png";
				
			if(in_array($_FILES["filename"]["type"] , $mimeTypes)
			&& ($_FILES["filename"]["size"] < 1024*2*1024) 
	  		&& in_array($currentFileExtension, $allowedExts)){

				if ($_FILES["filename"]["error"] > 0) { 
					echo "Return Code: " . $_FILES["filename"]["error"] . "<br>"; 
				}else { 
				echo "<ul style=\"list-style:none\"><li>Upload: " . $_FILES["filename"]["name"] . "</li>"; 
					echo 		"<li>Type: " . $_FILES["filename"]["type"] . "</li>"; 
					echo 		"<li>Size: " . ($_FILES["filename"]["size"] / 1024) . " kB</li>"; 
					echo 		"<li>Temp file: " . $_FILES["filename"]["tmp_name"] . "</li></ul>"; 
					$prevNameInCurrentPhoto =(explode(".",$fullPathToFinalJpgFile));
					$prevNameInCurrentPhoto =$prevNameInCurrentPhoto [count(	$prevNameInCurrentPhoto)-2];
					echo 'type is: '.gettype($prevNameInCurrentPhoto);
					$noExtUpload = current(explode(".",$_FILES["filename"]["name"])) ;
					$_SESSION['names']['noExt']=$noExtUpload;
					$_SESSION['names']['prevName']=(explode(".",$fullPathToFinalJpgFile)[count((explode(".",$fullPathToFinalJpgFile)))-2]);
					if ( in_array($noExtUpload, $names_I_Have)) { 
						echo"\n\n\t\n<br />" .$_FILES["filename"]["name"] . " уже есть. \n<br />\n"; 
					} else { 
						if (!file_exists($fullPathToFinalJpgFile)) {
							copy 			($_FILES["filename"]["tmp_name"],	$fullPathToFinalPngFile);
							move_uploaded_file 	($_FILES["filename"]["tmp_name"],	$fullPathToFinalJpgFile); 
							echo "Stored in:  $fullPathToFinalJpgFile"; 
						}
				 	} 
				}
			}
		} else { 
			if (isset($_FILES['filename'])) {
			echo "Invalid file right here!<br />"; 
	
			}else{
				echo "Грузи свои фотки..)";

			}
		}

	 }
	public function descForm(){
		$dom = new DOMDocument('1.0', 'utf-8');
		$root = $dom->createElement('form');
		$root->setAttribute('accept-charset','utf-8');
		$root->setAttribute('id','itemDescriptionForm');
		//$root->setAttribute('method','POST');
		//$root->setAttribute('action','/inc/cases.php');
		$textarea = $dom->createElement("textarea");
		$textarea->setAttribute("type","textarea");
		$textarea->setAttribute("form","itemDescriptionForm");
		//$textarea->setAttribute("name","descForm");
		$textarea->setAttribute("id","descForm");
		$textarea->setAttribute("cols","75");
		$textarea->setAttribute("raws","50");
		$textarea->setAttribute("tabindex","1");
		$textarea->setAttribute("placeholder","Введите описание товара");
		$fuf = $dom->createTextNode("");
		$buton=$dom->createElement("input");
		$buton->setAttribute("type","submit");
		$buton->setAttribute("id","actionCreateDesc");
		//$buton->setAttribute("name","descButton");

		$fakeInp = $dom->createElement("input");	//фейковый инпут который не видать, 
		$fakeInp->setAttribute("type","hidden");	//передаёт команду в cases
		$fakeInp->setAttribute("name","action");	//в элементе action
		$fakeInp->setAttribute("value","setDescription");//		Я молодец!

		$textarea->appendChild($fuf);

		$root->appendChild($textarea);
		$root->appendChild($buton);
		// $root->appendChild($fakeInp);
		
		$dom->appendChild($root);
		echo $dom->saveXML();

		//self::appendDescription(getcwd(),$_POST['text']);
	 }
	/*public function appendDescription($fullCurrentPath,$itemDescriprion){
		echo "[admBiz->appendDescription] :\n $itemDescriprion";
		$itemDescriprion = fopen($fullCurrentPath."/about.txt", 'c+');
		//fwrite($itemDescriprion, $itemDescriprion);
		fclose($itemDescriprion);
	 }
	*/
 	public function deskAdd($path,$descriptionText){
		$handle = fopen($path."/about.txt", 'c+');
	
		$write = fwrite($handle, $descriptionText);
		fclose($handle);
		/*		if(file_put_contents($path."/about.txt", $descriptionText)){
					echo "rigdt";
				}
		*/		echo "<pre> descAdd _POST: ";
			print_r($_POST);
		echo "</pre>\n path: $path/about.txt\n
		text : '$descriptionText' is type of: ".gettype($descriptionText)."\n
		write = $write\n
		descAdd End.";
		 }
}
?>
