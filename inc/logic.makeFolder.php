<?php 

	$name = $_POST['folderName']; //$_POST['currentPath']."/".
	echo "$name\n\n";
	echo "До :\t\t " .getcwd();
	chdir("..".$_POST['currentPath']);
	echo "\n\nПосле:\t".getcwd()."\n\n";
	echo "where I copy from: " .$_SERVER["DOCUMENT_ROOT"]."/canonical/index.php\n\n";
	if (isset($_POST['currentPath'])) {
		if (isset($_POST['folderName'])) {
			$oldumask = umask(0);
			mkdir($name, 0777);
			umask($oldumask);
			copy($_SERVER['DOCUMENT_ROOT']."/canonical/index.php", $name."/index.php");
		}
	}
 	echo "ma name is: ". $name;

 		echo"<br /><br /><br />************************************ <br />\n\n\n";
		 echo "__DIR__ :    \n\t".__DIR__."<br /> \n\n\n";
		 echo "getcwd() :  \n\t   ".getcwd()."<br />\n\n\n";
		 echo "php self :   \n\t   $nbsp".$_SERVER['PHP_SELF']."<br />\n\n\n";
		 echo"************************************ <br /><br /><br /><br />\n\n\n";


		// public function makefolder(){
		// 		$name = $_POST['folderName']; //$_POST['currentPath']."/".
		// 		if (isset($_POST['currentPath'])) {
		// 			if (isset($_POST['folderName'])) {
		// 				$oldumask = umask(0);
		// 				mkdir($name, 0777);
		// 				umask($oldumask);
		// 				copy($_SERVER['DOCUMENT_ROOT']."/canonical/index.php", $name."/index.php");
		// 				if ($this->lvl == 4) {
		// 					copy($_SERVER["DOCUMENT_ROOT"]."/canonical/agile_carousel_data.php", $name."/agile_carousel_data.php");
		// 				}
		// 			}
		// 		}
		// }
 ?>