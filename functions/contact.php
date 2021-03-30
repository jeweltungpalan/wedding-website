<?php
	//variables
	$from=$_POST["name"];
	$email=$_POST["email"];
	$message=htmlentities($_POST["message"]);
	$redirect=$_POST["page"];
	
	$success_page="http://" . $_SERVER['HTTP_HOST'] . $redirect . "?status=success#contact";
	$error_page="http://" . $_SERVER['HTTP_HOST'] . $redirect . "?status=error#contact";
	
	if(isset($from) && isset($email) && isset($message)){
		$to="jurisjeweltungpalan@gmail.com";
		$subject_to_me="New Message";
		$subject_confirmation="Thank You for Contacting Us";
		
		$headers="From: " . $to . "\r\n";
		$headers.="Reply-To: ". $email . "\r\n";
		$headers.="MIME-Version: 1.0\r\n";
		$headers.="Content-Type: text/html; charset=ISO-8859-1";
		
		$body="<html><body>";
		$body.="<h1>" . $subject_to_me . "</h1>";
		$body.="<p>" . "Name: " . $from . "<br/>";
		$body.="Email: " . $email . "<br/>";
		$body.="Message:" . $message . "</p>";
		$body.="</body></html>";
		
		//mail to my email
		$sent=mail($to, $subject_to_me, $body, $headers);
			
		if($sent){
			header("Location: " . $success_page);
		}
		else{
			header("Location: " . $error_page);
		}
	}
	else{
		header("Location: " . $error_page);
	}
?>