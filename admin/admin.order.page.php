<?php
	require_once("../inc/header.php");
	require_once("../inc/class.database.php");
?>
<head>
<style type="text/css" media="screen">
	#result{

	}
	.resultItem{
	}
	.resultRaw{
	padding: 0px 3px;
	border-bottom: 1px solid black;
		
	}
	.mysqlResult{
		display: inline-block;
		margin-left: 20px;
		border-left: 1px solid black;
		padding: 0px 2px;
		margin:  auto;
		text-align: justify;

	}
	.text{
		width: 300px;
		padding-left: 10px;
	}
	.number{
		width: 85px;
	}
</style>
</head>

<?php


	$orderTset=new Database('orderTest');
	$tableResults = 	$orderTset	->	selectDB("*");
//	echo "<br />";
//	echo "here it is: <pre>";
//	print_r($tableResults[0]);
//	echo "</pre>";
//	echo gettype($tableResults[0]);
//	$kolvo = $tableResults[0]+0;
//	if ($kolvo == 193){
//		echo "\tableResults = 193";
//	}
	require_once("../inc/footer.php");

?>