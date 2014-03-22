<?php
	class Mail{
		public $to      = 	'me3sa@me.com';
		public $subject = 	'тест почты';
		public $message = 	'hello';
		public $headers = 	'From: test@beep.com' . "\r\n" .
						    'Reply-To: test@beep.com' . "\r\n" .
						    'X-Mailer: PHP/' . phpversion();
				
		function sendMail(){
			mail($to, $subject, $message, $headers);
		}
	}
?>