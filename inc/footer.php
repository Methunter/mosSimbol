</div>
<footer>
	<p>© 2013 ООО «Моссимвол» </p>
	<p>
		<a href="map:">127218, Москва, Чермянский проезд, д.5 стр. 26 </a>
	</p>	
</footer>


<!-- Подключаемые библиотеки -->


<!-- мои скрипты -->
<script type="text/javascript">
		var del = '<div class=\"folderDelete\"></div>';
		$('.folderDelete').css({ 'position' : 'absolute !important','top' : '0px !important','z-index':'100000000'});
		jQuery(document).ready(function($) {
			console.log($(".thumb").find('img').attr('src'));
			$('.thumb').append(del);
			$("content_button_inner").append(del);
		});
	
</script>
</body>
</html>
