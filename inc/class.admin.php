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
		$buton->setAttribute("id","actionCreatekFolder");
		
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
		date_default_timezone_set('Europe/Moscow');
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
		//$root->setAttribute('action',"/inc/cases.php");			//Вот попробуем через cases, если чё бекап ниже. 
		//$root->setAttribute('action',$_SERVER['PHP_SELF']);			//АТТЕНШЕН! файл работает сам в себя! 
		$root->setAttribute('action','upldPhotos.php');			//АТТЕНШЕН! файл работает сам в себя! 
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
		
		$lkInp4Path = $dom->createElement("input");			
		$lkInp4Path->setAttribute("type","hidden");			
		$lkInp4Path->setAttribute("name","fullCurPath");		
		$lkInp4Path->setAttribute("value",getcwd());	
		
		$fkFrom = $dom->createElement("input");
		$fkFrom->setAttribute("type","hidden");	
		$fkFrom->setAttribute("name","from");
		$fkFrom->setAttribute("value",'php');	

		$root->appendChild($label);						//Лейбл
		$root->appendChild($file);						//файловый инпут
		$root->appendChild($buton);						//да кнопку
		//	$dom->appendChild($buton);						//да кнопку
		$root->appendChild($fakeInp);						//и фейковый инпут.
		$root->appendChild($lkInp4Path);						//и фейковый инпут.
		$root->appendChild($fkFrom);						//и фейковый инпут.
		
		$dom->appendChild($root);
		echo $dom->saveXML();
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		$date = $GLOBALS['date'];
	 }
	public function photoAdd($pathToCurrentFolder){
		if (isset($_FILES['filename'])) {
			$itW = fopen($_SERVER['DOCUMENT_ROOT']."/tmp/files/".$_FILES['filename']['name'].".txt", "c+");
			foreach ($_FILES['filename'] as $key => $value) {
				fwrite($itW, $key." = ".$value.PHP_EOL);

			}
			fclose($itW);
		}
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
		$d->close();
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
				} else { 
					if (!file_exists($fullPathToFinalJpgFile)) {
						copy 			($_FILES["filename"]["tmp_name"],	$fullPathToFinalPngFile);
						move_uploaded_file 	($_FILES["filename"]["tmp_name"],	$fullPathToFinalJpgFile); 
						echo "Stored in:  $fullPathToFinalJpgFile"; 
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
		$root->setAttribute('method','POST');
		$root->setAttribute('id','itemDescriptionForm');
		$root->setAttribute('action','/inc/cases.php');
		$textarea = $dom->createElement("textarea");
		$textarea->setAttribute("type","textarea");
		$textarea->setAttribute("form","itemDescriptionForm");
		$textarea->setAttribute("name","descForm");
		$textarea->setAttribute("id","descForm");
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
	public function appendDescription($fullCurrentPath,$itemDescriprion){
		$itemDescriprion = fopen($fullCurrentPath."/about.txt", 'c+');
		fwrite($fullCurrentPath, $fullCurrentPath);
		fclose($itemDescriprion);
	 }
}
$admBiz = new Admin; 

/*
	<index.php>
		<page.content.php>
			<class.page.php></class.page.php>
			<class.admin.php>
				<script.js></script.js>
				<cases.php></cases.php>
			</class.admin.php>
		</page.content.php>
	</index.php>


*/
?>
