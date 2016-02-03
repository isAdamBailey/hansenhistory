<?php 
	function email() {
	//this is all the php for the contact form
		global $errName, $errEmail, $errMessage, $errHuman, $result;
		
		if (isset($_POST["submit"])) {
			$name = strip_tags($_POST['name']);
			$email = strip_tags($_POST['email']);
			$message = strip_tags($_POST['message']);
			$human = intval($_POST['human']);
			$from = 'contact@ajamesb.com'; 
			$to = 'hansennfr@gmail.com'; // Enter email address to send emails TO here 
			//$to = 'adambailey.dumb@gmail.com'; // Enter email address to send emails TO here 
			$subject = 'Message from Hansen Ranch Contact Form'; //What goes in the subject line of your email here		
			
			$body = "<html><body>";
			$body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
			$body .= "<tr><td><strong>From:</strong> </td><td>$name</td></tr>";
			$body .= "<tr><td><strong>E-Mail:</strong> </td><td>$email</td></tr>";
			$body .= "<tr><td><strong>Message:</strong> </td><td>$message</td></tr>";
			$body .= "</table></html></body>";

			$hdrs = "MIME-Version: 1.0" . "\r\n";
			$hdrs .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$hdrs .= "From: " . $from . "\r\n";


			// Check if name has been entered
			if (!$_POST['name']) {
				$errName = 'Please enter your name';
			}
			
			// Check if email has been entered and is valid
			if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$errEmail = 'Please enter a valid email address';
			}
			
			//Check if message has been entered
			if (!$_POST['message']) {
				$errMessage = 'Please enter your message';
			}
			//Check if simple anti-bot test is correct
			if ($human !== 5) {
				$errHuman = 'Your anti-spam is incorrect';
			}

	// If there are no errors, send the email
	if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
		if (mail ($to, $subject, $body, $hdrs)) {
			$result='<div class="alert alert-success">Thank You! We will be in touch.</div>';
		} else {
			$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again.</div>';
		}
	} else {
		$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again.</div>';
	}

	}

}
?>