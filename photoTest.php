<?php
	session_save_path("/tmp");
	session_start();
?>
<html>
<head>
  <title>Загрузка файлов на сервер</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" href="/stylesheets/style.css">
</head>
<body>
      <h2><p><b> Форма для загрузки файлов </b></p></h2>

      <?php

      	require 'inc/class.admin.php';
      	$admBiz->photoForm();
      	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	echo "<pre>";
      	echo serialize($_SERVER);
      	echo "</pre>\n\n sessDat:\t$session_date";	
	if (isset($_FILES["filename"])) {
		$admBiz->photoAdd();
		unset($_FILES['filename']["name"]);
		unset($_FILES['filename']["type"]);
		unset($_FILES['filename']["tmp_name"]);
		unset($_FILES['filename']["error"]);
		unset($_FILES['filename']["size"]);

	}
      ?>
<!--       <form action="upload.php" method="post" enctype="multipart/form-data">
      <input type="file" name="filename" value="Сюда Ваши фотки"><br> 
      <input type="submit" value="Загрузить"><br>
      </form> -->
</body>
</html>
<?php
//session_save_path("/tmp");
//
//
//
//
//
//$allowedExts = array("jpg", "jpeg", "gif", "png","jp2"); 
//$extension = strtolower(end(explode(".", $_FILES["filename"]["name"]))); 
//if ((($_FILES["filename"]["type"] == "image/gif") 
//    || ($_FILES["filename"]["type"] == "image/jpeg") 
//    || ($_FILES["filename"]["type"] == "image/jp2") 
//    || ($_FILES["filename"]["type"] == "image/png") 
//    || ($_FILES["filename"]["type"] == "image/pjpeg")) 
//    && ($_FILES["filename"]["size"] < 1024*2*1024) 
//    && in_array($extension, $allowedExts)) 
//{ 
//    if ($_FILES["filename"]["error"] > 0) 
//    { 
//        echo "Return Code: " . $_FILES["filename"]["error"] . "<br>"; 
//    } 
//    else 
//    { 
//           echo "Upload: " . $_FILES["filename"]["name"] . "<br>"; 
//           echo "Type: " . $_FILES["filename"]["type"] . "<br>"; 
//           echo "Size: " . ($_FILES["filename"]["size"] / 1024) . " kB<br>"; 
//           echo "Temp file: " . $_FILES["filename"]["tmp_name"] . "<br>"; 
//
//           if (file_exists("upload/" . $_FILES["filename"]["name"])) { 
//               echo $_FILES["filename"]["name"] . " already exists. "; 
//           } 
//           else { 
//               move_uploaded_file($_FILES["filename"]["tmp_name"], "upload/" . $_FILES["filename"]["name"]); 
//               echo "Stored in: " . "upload/" . $_FILES["filename"]["name"]; 
//           } 
//    } 
//} 
//else 
//{ 
//  echo "Invalid file<br />"; 
//} 

?>