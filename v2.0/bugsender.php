<?php
$pageTitle = "Repporter un bug";
	include('bandeau.php');
?>
		<div id="corps">
<?php
	
	$name = $_POST['Name'];
	$severity = $_POST['Severity'];
	$frequency = $_POST['Frequency'];
	$nav = $_POST['Nav'];
	$url = $_POST['Url'];
	$description = $_POST['Description'];
	$steps = $_POST['Steps'];
	$info = $_POST['Info'];
	
	$email_message = "<u>Detail du rapport d'erreur ci-dessous:</u><br><br>";
	
	$email_message .= "<b>Nom : </b><i>".$name."</i><br>";
	$email_message .= "<b>Importance : </b><i>".$severity."</i><br>";
	$email_message .= "<b>Frequence : </b><i>".$frequency."</i><br>";
	$email_message .= "<b>Navigateur : </b><i>".$nav."</i><br>";
	$email_message .= "<b>URL : </b><i>".$url."</i><br>";
	$email_message .= "<b>Description : </b><i>".$description."</i><br>";
	$email_message .= "<b>Etapes : </b><i>".$steps."</i><br>";
	$email_message .= "<b>Autre info : </b><i>".$info."</i><br>";
	/*
	// create email headers
	 
	$headers = 'X-Mailer: PHP/' . phpversion();
	 
	//mail($email_to, $email_subject, $email_message, $headers);
	
	// OTHER
	
	require '/media/fd0b1/alx22/stuff/PHPMailer-master/PHPMailerAutoload.php';
	 
	$mail = new PHPMailer;
	 
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'revivre.iut@gmail.com';                   // SMTP username
	$mail->Password = 'projetIUT2015';               // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
	$mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
	$mail->setFrom('revivre.iut@gmail.com', 'Projet Revivre');     //Set who the message is to be sent from
	$mail->addAddress('revivre.debugger@gmx.com');  // Add a recipient
	$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
	$mail->isHTML(true);                                  // Set email format to HTML
	 
	$mail->Subject = 'New Bug Report';
	$mail->Body    = $email_message;
	$mail->AltBody = $email_message;
	 
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
	 
	if(!$mail->send()) {
	   echo 'Message could not be sent.';
	   echo 'Mailer Error: ' . $mail->ErrorInfo;
	   exit;
	}*/
	require '/media/fd0b1/alx22/stuff/PHPMailer-master/PHPMailerAutoload.php';
	 
	$mail = new PHPMailer;
	 
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'mail.gmx.com';                       // Specify main and backup server
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'revivre.debugger@gmx.com';                   // SMTP username
	$mail->Password = 'projetIUT2014';               // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
	$mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
	$mail->setFrom('revivre.debugger@gmx.com', 'Projet Revivre');     //Set who the message is to be sent from
	$mail->addAddress('revivre.iut@gmail.com');  // Add a recipient
	$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
	$mail->isHTML(true);                                  // Set email format to HTML
	 
	$mail->Subject = 'New Bug Report';
	$mail->Body    = $email_message;
	$mail->AltBody = $email_message;
	 
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
	 
	if(!$mail->send()) {
	   echo 'Message could not be sent.';
	   echo 'Mailer Error: ' . $mail->ErrorInfo;
	   exit;
	}    
?>
			<div id="good">     
			    <label>Rapport de bug envoyé avec succés.</label>
		    </div>
		</div>
<?php  
	include('footer.php');
?>