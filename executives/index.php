<?php
	require_once(getcwd().'/inc/header.php');
	require_once(getcwd().'/inc/navigation.php');
?>
<?php
	$page=new Page;
	$page->showExecutives();
?>



<?php
	require_once(getcwd()."/inc/footer.php");
?> 