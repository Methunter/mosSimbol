<?php
	require_once(getcwd().'/inc/header.php');
	require_once(getcwd().'/inc/navigation.php');
?>				  
<script>
	
</script>
<div id="content">
	<div id="slides">
		<div>
			<img src="images/slide-1.jpg" width="570" height="270" alt="Slide 1">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
		<div>
			<img src="images/slide-2.jpg" width="570" height="270" alt="Slide 2"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
		<div>
			<img src="images/slide-3.jpg" width="570" height="270" alt="Slide 3">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		</div>
		<div>
			<img src="images/slide-4.jpg" width="570" height="270" alt="Slide 4">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		</div>
	</div>
	<div id="rest">
		<h1>Вы хотели слайдер? Нате!</h1>
		<p>
			С остальной страницей чё делать?
		</p>
	</div>
</div>
</div>	
	<pre><script>
	 $(function(){
	  $("#slides").slides({
	    width: 900,
	    height: 300
	  });
	 });
	</script></pre>
<?php
	require_once(getcwd()."/inc/footer.php");
?> 