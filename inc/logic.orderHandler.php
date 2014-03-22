<?
	require_once($_SERVER['DOCUMENT_ROOT'].'/inc/class.database.php');
	date_default_timezone_set('Europe/Moscow');
	$posession = array();
	if(isset($_POST['isUpd'])){
		$isUpd = $_POST['isUpd'];
		$_POST['isUpd'] = 0;
		
	}else{
		$isUpd = null;
	}
	for($i=0;$i!==count($_POST['name']);$i++){
		$posession[$i] = "'".$_POST['name'][$i]."'";

	}
	for($i=0;$i!==count($_POST["quantity"]);$i++){
		$quantity[$i] = "'".$_POST["quantity"][$i]."'";

	}
	//$quantity = $_POST["quantity"];
	$db = new Database('orderTest');
	
	$fields=	[		"item"		,	"quanr"		,		"PHPSID"			,						"preview"							];
	$data =		[ $posession 		,	$quantity	, "'".$db->phpsessid."'"	,	"'i add it late, when i\'ll make corresponding table'"	];

	$sameItems=$db->fieldTest($posession);
	if(isset($isUpd)){//fieldUpdate($posession, $quantity)
		for($i=0;$i!==count($posession);$i++){
			$db->fieldUpdate($posession[$i],$quantity[$i]);
		}
	}else{
		if($sameItems==0){
			$db->insInTbl($fields, $data);
	
		}else{
			for($i=0; $i!== count($posession);$i++){
				echo "test" . $posession[$i];
				$res = $db->fieldUpdate($posession[$i], $quantity[$i]);
				
			}
		}
		echo gettype($res);
	}
	echo "count posession: ".count($posession)."\nposession: ";
	print_r($posession);
	echo "quantity: ";
	print_r($quantity);
	echo "\n\n\n post: ";
	print_r($_POST);
	echo "\n\n";
	echo "just in case: ".$sameItems."\n";
	echo $res=$db->getRawCount()."\n";
	echo "\n table: ".$db->tableName."\nitem=".$posession[0]." AND PHPSID=`".$db->phpsessid."";
	print_r($data);
	echo "<br />".$time;

	

?>