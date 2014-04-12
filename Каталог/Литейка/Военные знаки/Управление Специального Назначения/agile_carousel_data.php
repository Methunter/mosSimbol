<?php
function getExtension1($filename) {
    return end(explode(".", $filename));
  }
function getFilename($filename){
	return  current(explode(".", $filename));
}
	$d=dir(".");
	echo "[";
while (false !== ($entry = $d->read())){
	if(getExtension1($entry)==="png"||getExtension1($entry)==="jpg"){
		$image=getFilename($entry);

		echo $prevPicItem;
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
echo $prevPicItem."]";
?>