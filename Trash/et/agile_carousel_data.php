<?php
function getExtension1($filename) {
	return strtolower(end(explode(".", $filename)));
  }
function getFilename($filename){
	return  current(explode(".", $filename));
}
	$d=dir(".");
	$itemsCounter = 0;
	echo "[";
while (false !== ($entry = $d->read())){
	if(getExtension1($entry)==="png"||getExtension1($entry)==="jpg"){
		if (getExtension1($entry)) =="jpg" {
			$itemsCounter++;
			$GLOBALS['photosOnFinalPage'] = $itemsCounter;
		}
		$image=getFilename($entry);

		//echo $prevPicItem;
		if($prevPicItem){
			echo ",";
		}

	$curPicItem="{
      \"content\": \"<div class='slide_inner'><a class='photo_link' href='#'><img class='photo' src='{$image}.jpg' alt='$image'></a><a class='caption' href='#'>Sample Carousel Pic Goes Here And The Best Part is that...</a></div>\",
      \"content_button\": \"<div class='thumb'><img src='$image.png' alt='bike is nice'></div><p>$image</p>\"
}";

		
	$prevPicItem=$curPicItem;

	}
}
$photosOnFinalPage = 0;
while ( $photosOnFinalPage<= $itemsCounter) {
	# code...
	echo $prevPicItem."]";
	$photosOnFinalPage++
}
?>