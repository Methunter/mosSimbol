<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/inc/class.database.php');
	date_default_timezone_set('Europe/Moscow');
	$posession = "'".$_POST["name"]."'";
	
	$db = new Database('orderTest');
	$sameItems=$db->fieldTest($posession);

	$fields=	[		"item"		,	"quanr"		,		"PHPSID"			,						"preview"							];
	$data =		[ $posession 		,	1	, "'".$db->phpsessid."'"	,	"'i add it late, when i\'ll make corresponding table'"	];


			if($sameItems==0){
			$db->insInTbl($fields, $data);
	
		}else{
			for($i=0; $i!== count($posession);$i++){
				echo "test" . $posession[$i];
				$res = $db->fieldUpdate($posession[$i], $quantity[$i]);
				
			}
		}
?>
