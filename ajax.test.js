/*
(function(){
$('#loading').hide();
	$(document).bind("ajaxSend", function(){
   $("#loading").show();
 }).bind("ajaxComplete", function(){
   $("#loading").hide();
 });
*/
 //
 // GO!
 
 
 var name=$('#name');
 var namalert=$('#nameAlerter');
 namalert.click(function(){
	alert($('#surname').val());
 });


var i=0;
 
name.keyup(function() {

$('#debug').text(name.val());
});






$('#button').click(function(){
i++;
	$.ajax({
		url:"ajax.test.logic.php",
		data: {
        	name:$('#name').val(),
        	quantity:$('#surname').val()
		},
		type: "POST",
		success: function( data ) {},
		
		
		
		
		
		
		
	})
});

 
 
 
 
 
 
 
 
 
 
 
 
 
})();
