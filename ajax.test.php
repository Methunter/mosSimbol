<script type="text/javascript" src="jquery-1.11.0.min.js"></script>
<form action="ajax.test.php" method="post" accept-charset="utf-8">
	<label for="name">Имя</label><input id="name" type="text" name="name"  placeholder="Введите Ваше имя"><br />
	<label for="surname">Фамилия</label><input id="surname" type="text" name="surname" placeholder="Введите Вашу Фамилию"><br />
</form>


<button id="button" style="width:50px;height:30px;" >Кнопка</button>
<button id="nameAlerter" style="width:50px;height:30px;" >nameAlerter</button>

<div style="background:url('ajax-loader.gif'); width:220px;height:19px;" id="loading"></div>

<script type="text/javascript" src="ajax.test.js"></script>

<?php
echo "<pre>";
	rawurlencode( print_r($_SESSION));
echo "</pre>";


foreach($_COOKIE as $key =>$item){
	echo "Вы выбрали: $item вот таких: $key <br />";
}
?>
<div id="debug"></div>