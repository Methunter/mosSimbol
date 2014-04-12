
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="/js/script.js" type="text/javascript" charset="utf-8" ></script>

<?php
require  ('class.menu.php');
	$menu = new Menu;
	$menu->nest();
	$foo = $menu->currentPath;
	$bar = $menu->level;
	echo $menu->level.";\n".$bar;
	echo "<script language='javascript'>\nvar currentPath = '$foo'; currentLvl = '$bar';\n</script>\n";





/*===========================
                admin case:
===========================*/



if (isset($_SESSION["admin"])) {    
                echo "<script language=''javascript''>

                      $('docunent').ready(function(){ 
                                 $('.catlist a').css({'color':'#3a51a5'});  
                                 $('.catlist h2').append(\"<div class='folderDelete'></div>\")
                              
                                       
                      });
                        </script>" ;//   $('.catlist a : after').css({'content':'none' });
        
}
?>
<script src="/js/script.js"                 type="text/javascript"></script>

<form accept-charset="utf-8" method="post">
	<label for="folderName">Создать </label><br />
	<input type="text" id="folderName" placeholder="Введите имя папки"><br />
	
	<input type="submit" value="Создать" id="actionCreate"><br />
</form>

<?php
	 $d = dir(".");
	 	while (false !== ($entry = $d->read())){
	 		if(is_dir($entry)
	 		&& $entry!=="." 
	 		&& $entry!==".."){
	 			echo "<a href=".rawurlencode($entry).">$entry</a><br />";
	 		}
		}
?>