<?php
while (false !== ($entry = $d->read())) {
   if( is_dir($entry)  && $entry!=="." 
   && $entry!==".."){

	   echo "<h2><a href='$entry'>".$entry."</a></h2><br />";
   }
   /*
		поставить переход по ссылкам после каждого $entry.   
   */
}
/*
	
	реально ссылки:
	
*/
while (false !== ($entry = $d->read())) {

	echo "<h1>".$entry."</h1>";
	}

$d->close();

?>