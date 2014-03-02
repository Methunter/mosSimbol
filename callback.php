<?
	include("inc/header.php");
	include("/inc/navigation.php");
?>	

<?php
	//здесь очень многое нужно убрать..
?>

<div id="content">
	<div id="sector">
		<div id="pannel">
			<form action="test.php" method="post" accept-charset="utf-8">
				<label for="name">Как к Вам обращаться?</label><br />
				<input id="name" type="text" name="name" placeholder="Представьтесь, пожалуйста:"><br />
				<label for="email">Ваш e-mail</label><br />
				<input id="email" type="e-mail" name="email" placeholder="Введите, пожалуйста адрес электронной почты"><br />
				<label for="userphone">Ваш телефон</label><br />
				<input id="userphone" type="tel" pattern="2[0-9]{3}-[0-9]{3}" name="userphone"  placeholder="Номер Вашего телефона"><br /><br />
				<textarea name="positions" rows="15" cols="50" placeholder="Позиции">количество позиций</textarea><br />
				<div id="checkboxes">
					<input style="" id="humancheck" type="checkbox" >
					<label style="text-align:center !important" for="humancheck" alt="Айзик Азимов был не прав на мой счёт">Я не робот</label><br />
					<input style="" id="mailcheck" type="checkbox" >
					<label style="text-align:center !important" for="mailcheck" alt="Мне нужны комментарии по поводу проезда">Отправить мне на почту, как добраться</label><br />
					<button id="buy">Купить</button>
					<button id="reserve">Зарезервировать</button><br />
				</div>			
			</form>
			
		</div>
	</div>
	
</div>

<!-- Подключаемые библиотеки -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>

<!-- мои скрипты -->
<script type='text/javascript' src='script.js'></script>
</body>
<?php
	include("/inc/footer.php");
?>
</html>