(function ( $ ) {
	$.fn.rest = function( options ) {

		// This is the easiest way to have default options.
		var settings = $.extend({
		// These are the defaults.
			color: "#556b2f",
			backgroundColor: "red"
		}, options );

		// Greenify the collection based on the settings variable.
		return this.css({
			color: settings.color,
			backgroundColor: settings.backgroundColor
		});
	 };
}( jQuery ));
$(document).ready(function() {
	//console.log(location);
	menuSlide();
	var focus = 0,
	blur = 0;
	//$('#test').rest();
	
	$('#order').bind("click",function(){
		$( "footer" ).load( "/inc/page.callback.php" );
		});  		//клик на кнопку 	«заказать»
	$('#order').bind("click", function(){
		console.log("orderButton");
		$.ajax({
			url: '/inc/cases.php',
            		type: 'POST',
			//dataType: 'text',
			data: 	{action: 'mkDir',
				folderName: name,
            			curPath: me3.currentPath,
            			curLvl: me3.currentLvl,
            			fullCurPath:me3.fullCurrentPath
			},
		})
		}); 		//клик на кнопку 	«заказать»
	$('.lessPurch').click(function(){
		var val = $.trim($(this).parent().children('.purchQuant').html());
		
		val--;
		$(this).siblings('.purchQuant').html(val);
		});	  			//					«минус»
	$('.morePurch').click(function(){
		var val = $.trim($(this).parent().children('.purchQuant').html());
		
		val++;
		$(this).siblings('.purchQuant').html(val);
		});	  			//					«плюс»
	$('.purchQuant').focusout(function() {
		focus++;
		var kvo = ($.trim($(this).parent().children('.purchQuant').html()));
		var name = $.trim($(this).parent().children('.purchItem').html());
		$.ajax({
		    url : "/inc/logic.orderHandler.php",
		    type: "POST",
		    data : {
			    name: name,
			    quantity: kvo
			    //isUpd: 1
		    },
			dataType : "text",
		    success: function(){
				//alert("success)")
		    },
		    error: function (){
		 		alert("erroe")
		    }
		});
		});				//фокус покинул 	«поле количества товара»
	$('.cancelPurch').click(function(){
		var name = $.trim($(this).parent().children('.purchItem').html());
		console.log(name);
		$(this).parent().remove();
		$.ajax({
			url:"/inc/logic.deletePosition.php",
			type: "POST",
			data:{
				name: name	
				},
			dataType:"text",
			success:function(){

			}
		});
		});  			//					«отменить»	
	$('#buy').click(function(){

		});										  			//					«купить»
	$('#close').click(function(){
			updFields();	
			$( "#sector" ).remove();
			 });		  			//					«закрыть»
	$('#continue').click(function(){					//срабатывает при нажатии кнопки «продолжить покупки»			
		updFields();						//обновляет  таблицу (там свой клас, таблица выбирается при создании инстанса)		
		$( "#sector" ).remove();					//		updFields() в районе 192 строки)
	 });						//					«продолжить»
	$('#mkFForm').submit(function(event) {			//создаём папку..
		//mkDir();
		//event.preventDefault();
		var name = $("#folderName").val();		//метода создания папки из воздуха, как по волшебству.
		$.ajax({
			url: '/inc/cases.php',
            		type: 'POST',
			//dataType: 'text',
			data: 	{action: 'mkDir',
				folderName: name,
            			curPath: me3.currentPath,
            			curLvl: me3.currentLvl,
            			fullCurPath:me3.fullCurrentPath
			},
		})
		.done(function() {
			console.log("mkForm.\n\tRequest on server went Good. \n\n");
		})
		.fail(function() {
			console.log("mkForm.\n\tRequest on server went Bad.\n");
		})
		.always(function() {
			console.log("name: "+ name+"\ncurrent path: "+ me3.currentPath + "\ncurrent level: "+ me3.currentLvl);

			//console.log("success!"+$('#folderName').val());
		});
	 });//	The end of form.submit function
	$('#photoForm').submit(function(event) {
		//event.preventDefault();
		//метода создания папки из воздуха, как по волшебству.
		$.ajax({
			url: "/inc/cases.php",
			type: 'POST',
			//dataType: 'text',
			 data: 	{action: 'photoUpload',
				curPath: me3.currentPath,
				curLvl: me3.currentLvl,
				fullCurPath:me3.fullCurrentPath,
				from: 'js',
				test: 'i\'m from js!'
			},
		})
		.done(function(data) {
			console.log("photoUpload.\n\tGood. \n\n");
			$('this').append("<div = 'loadedPhotos'><div>");
			//location.reload();
		})
		.fail(function() {
			console.log("Bad.\n\n Check these:\n "+me3.currentPath+"/index.php");
		})
		.always(function() {
			console.log("\ncurrent path: "+ me3.currentPath + "\ncurrent level: "+ me3.currentLvl);
		});
	 });//	The end of form.submit function
	$(".folderDelete").click(function(){
		var name = $(this).siblings('a').text();
	            	console.log(name);
	            	$.ajax({
	            		url: '/inc/cases.php',
	            		type: 'POST',
	            		//dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
	            		data: {	action: 'delete',
	            			folderName: name,
	            			curPath: me3.currentPath,
	            			fullCurPath:me3.fullCurrentPath
	            			},
	            	 })
		.done(function() {
			console.log("Delete.\n\tGood. \n\n");
			location.reload()
		})
		.fail(function() {
			console.log("Bad.\n\n");
		})
	            	.always(function() {
				console.log("name: "+ name+"\ncurrent path: "+ me3.currentPath + "\ncurrent url: ");
	            	 });
	 });
	$('#itemDescriptionForm').submit(function(event) {
		event.preventDefault();
		var descriptionText = $(this).children("textarea") .val();
		console.log(descriptionText);
		$.ajax({
			url: '/inc/cases.php',
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: 	{action: 'setDesc',
				folderName: name,
				text: descriptionText,
				curLvl: me3.currentLvl,
				fullCurPath:me3.fullCurrentPath
			},
		})
		.done(function() {
			console.log("success sent setDesc");
			location.reload();
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
					
	});

});/*******************************************************|||
		end of document ready function		|
**********************************************************/ 
function menuSlide(){
	var bt = $("#bt"),
	cat = $("#cat"),
	ct = $("#ct"),
		bo = $("#bout");
		ct.hide();
		bt.hide();
		ospd = {
	duration: 100,
	queue: false,
	easing: ""
		};
		cspd = {
	duration: 300,
	queue: false,
	easing: ""
		};
		bo.mouseenter(function() {
			bt.slideDown(ospd);
		});
		bo.mouseleave(function() {
			bt.slideUp(cspd);
		});
		cat.mouseenter(function() {
			ct.slideDown(ospd);
		});
		cat.mouseleave(function() {
			ct.slideUp(cspd);
		});
 }		//спрятал, что б глаза не мазолила
function disp (divs){
		var a = [];
		for ( var i = 0; i < divs.length; i++ ) {
			a.push( $.trim(divs[ i ].innerHTML) );
		}
		return a;
	 }		//конструктор массивов 
function updFields(){
		var quantes =	Array();									
		var name = $("#shopList").find('.purchItem');					//	
		var nameArr = disp( name );							//	
		var kvo = $("#shopList").find('.purchQuant');					//	Собираем данные из форм, 
		var kvoArr	= disp( kvo );							//	пакуем в ajax запрос
		$.ajax({										//	отправляем
		    url : "/inc/logic.orderHandler.php",						//	...
		    type: "POST",								//	profit
		    data : {									//	
			    name:nameArr,							//	
			    quantity: kvoArr,							//	
			    isUpd: 1								//	
		    },										//
		// $.ajax({									
		//     url : "/inc/cases.php",							//
		//     type: "POST",								//	для реализации такого подхода нужно разобраться как это всё работает, 
		//     data : { action: 'updTableFealds'						//	и, по сути, переделать много.
		// 	    name:nameArr,							//	там, чё-то собираеся массив из входных данных, обрабатывается...
		// 	    quantity: kvoArr,							//	хочу ещё добавить возможность выбирать базу(там указана только одна, 
		// 	    isUpd: 1								//	можно засунуть выбоор в cases, из серии ajax посылает запрос, в котором указано имя 
		//     },										//	базы, а само тело функции прописать как метод и унифицировать.
			dataType : "text",							//	
		    success: function(){								//	пока ничего трогать не буду.
				//alert("success)")						//	
		    },										//	
		    error: function (){								//	
		 		//alert("erroe")							//	
		    }										//
		});										//
		//console.log("here-> "+items);						//	
	 }		//reusability								//	
function makePhotoPreview(){									//	
	alert("lol");//
	// var box = "<div id=\"box\"></div>";
	//$("#test")
	}	
(function ( $ ) {
	
	var winSize = window.innerWidth;
	var room = $('#room');
		room.css({
				width: winSize
				});
	$(window).resize( function() {
					/*this.*/room.css({
					width: winSize
					});
	})
}( jQuery ));

