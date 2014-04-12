<html>
<head>
  <title>Результат загрузки файла</title>
</head>
<body>
// <?php
// session_save_path("/tmp");





// $allowedExts = array("jpg", "jpeg", "gif", "png","jp2"); 
// $extension = strtolower(end(explode(".", $_FILES["filename"]["name"]))); 
// if ((($_FILES["filename"]["type"] == "image/gif") 
//     || ($_FILES["filename"]["type"] == "image/jpeg") 
//     || ($_FILES["filename"]["type"] == "image/jp2") 
//     || ($_FILES["filename"]["type"] == "image/png") 
//     || ($_FILES["filename"]["type"] == "image/pjpeg")) 
//     && ($_FILES["filename"]["size"] < 1024*2*1024) 
//     && in_array($extension, $allowedExts)) 
// { 
//     if ($_FILES["filename"]["error"] > 0) 
//     { 
//         echo "Return Code: " . $_FILES["filename"]["error"] . "<br>"; 
//     } 
//     else 
//     { 
//            echo "Upload: " . $_FILES["filename"]["name"] . "<br>"; 
//            echo "Type: " . $_FILES["filename"]["type"] . "<br>"; 
//            echo "Size: " . ($_FILES["filename"]["size"] / 1024) . " kB<br>"; 
//            echo "Temp file: " . $_FILES["filename"]["tmp_name"] . "<br>"; 

//            if (file_exists("upload/" . $_FILES["filename"]["name"])) { 
//                echo $_FILES["filename"]["name"] . " already exists. "; 
//            } 
//            else { 
//                move_uploaded_file($_FILES["filename"]["tmp_name"], "upload/" . $_FILES["filename"]["name"]); 
//                echo "Stored in: " . "upload/" . $_FILES["filename"]["name"]; 
//            } 
//     } 
// } 
// else 
// { 
//     echo "Invalid file<br />"; 
// } 

//  if($_FILES["filename"]["size"] > 1024*3*1024)
//  {
//    echo ("Размер файла превышает три мегабайта");
//    exit;
//  }
//  // Проверяем загружен ли файл
//  if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
//  {
//    // Если файл загружен успешно, перемещаем его
//    // из временной директории в конечную
//    move_uploaded_file($_FILES["filename"]["tmp_name"], "/testPhotoVault/".$_FILES["filename"]["name"]);
//  } else {
//     echo("Ошибка загрузки файла");
//  }
?>
</body>
</html>