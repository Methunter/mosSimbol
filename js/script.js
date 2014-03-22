$(document).ready(function() {
	menuSlide();
	var focus = 0,
	blur = 0;
	$('#order').bind("click",function(){
									$( "footer" ).load( "/inc/page.callback.php" );
	});  		//клик на кнопку 	«заказать»
	$('#order').bind("click", function(){
		
		$.ajax({
			type: "POST",
			url: "/inc/logic.orderHandler.php",
			data: {
	        	name: $('#title').text(),
	        	quantity :$('#quantity').val(),
	        	isUpd: 0
			},
			success:function(){
						console.log("success!"+$('#title').text()+" "+$('#quantity').val());
					},
			dataType: "text"
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
	});		//фокус покинул 	«поле количества товара»
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
									$( "#sector" ).remove();						//закончил в этом районе. Не работает js при втором открытии
								//	$( "footer" ).css({"padding":0});				//callback'а. есть подозрение, что дело в скрипте,
								//	$( "footer" ).load( "/inc/footer.php" );		//т.к. не работает вообще ничего из js'а 								
																					// попробовать убрать эту возню с футером и загрузиться без него.
																					//сейчас не стану, потому - что я так никогда не лягу.

	                        });		  			//					«закрыть»
	$('#continue').click(function(){
										updFields();
										$( "#sector" ).remove();						

								});		  			//					«продолжить»

});// end of doc ready function
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
	}
function updFields(){
		var quantes =	Array();									  				
		var name = $("#shopList").find('.purchItem');								
		var nameArr = disp( name );													
		var kvo = $("#shopList").find('.purchQuant');								
		var kvoArr	= disp( kvo );													
		$.ajax({																	
		    url : "/inc/logic.orderHandler.php",									
		    type: "POST",
		    data : {
			    name:nameArr,
			    quantity: kvoArr,
			    isUpd: 1
		    },
			dataType : "text",
		    success: function(){
				//alert("success)")
		    },
		    error: function (){
		 		//alert("erroe")
		    }
		});
		//console.log("here-> "+items);
	}		//reusability

(function ($){
	var winSize = window.innerWidth;
	var room = $('#room');
		room.css({
				width: winSize
				});
	$(window).resize( function() {
					this.room.css({
					width: winSize
					});
	})


})

