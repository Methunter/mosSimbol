<?
//	echo $_SERVER['DOCUMENT_ROOT'];
//	include($_SERVER['DOCUMENT_ROOT']."/inc/header.php");

/*
	include("/inc/navigation.php");
*/
	include_once($_SERVER['DOCUMENT_ROOT']."/inc/class.database.php");
/* 	include_once('header.php'); */
?>	



<?php
	//здесь очень многое нужно убрать..
?>
<script type="text/javascript" src="/js/script.js"></script>
<div id="content">
	<div id="sector">
		<div id="pannel">
			<div id="CBHead">
				<h3>
					Обратная связь
				</h3>
				<p>
					Заполните поля и мы вам перезвоним для уточнения деталей заказа
				</p>
				<span id="close">Закрыть</span>
			</div>
			<div  id="CBBody">
				<form action="" method="" accept-charset="utf-8">
					<div class="control-group input-append">
						<label for="name">Ваше имя *</label>
						<input id="name" type="text" name="name" placeholder="Представьтесь, пожалуйста:">
					</div>
					<div class="control-group input-append">

						<label for="email">Ваш e-mail *</label>
						<input id="email" type="tel" name="email" placeholder="Введите, пожалуйста адрес электронной почты">
					</div>
					<div class="control-group input-append">

						<label for="userphone">Ваш номер *</label>
						<input id="userphone" type="tel" pattern="/2[0-9]{3}-[0-9]{3}/" name="userphone"  placeholder="Номер Вашего телефона">
					</div>
					<div id="shopList">
						<?php
							$orderTest = new Database("orderTest");
							$orderTest->showPurchases();
						?>
					</div>
					<div id="checkboxes">
							<input style="" id="humancheck" type="checkbox" >
							<label style="text-align:center !important" for="humancheck" alt="Айзик Азимов был не прав на мой счёт">Я не робот</label><br />
							<input style="" id="mailcheck" type="checkbox" >
							<label style="text-align:center !important" for="mailcheck" alt="Мне нужны комментарии по поводу проезда">Отправить мне на почту, как добраться</label></div>
					<div class="btn-group">
							<div id="continue">
								Продолжить покупки
							</div>
							<button id="buy">Купить</button>
							<button id="reserve">Зарезервировать</button><br />
					</div>
				</form>
			</div>
			<div id="CBFooter">
				<p>
					* - поля обязательные для заполнения
				</p>
			</div>	
		</div>
	</div>
	
</div>

<!-- Подключаемые библиотеки -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<!-- 	<script src="/js/script.js" 				type="text/javascript"></script> -->


<!-- мои скрипты -->
<script type='text/javascript' src='/js/jquery-validate.js'></script>
		<script>
			$('form').validate({
				onKeyup : true,
				eachValidField : function() {

					$(this).closest('div').removeClass('error').addClass('success');
				},
				eachInvalidField : function() {

					$(this).closest('div').removeClass('success').addClass('error');
				}
			});
		</script>

<?php
//	include("/inc/footer.php");
?>
