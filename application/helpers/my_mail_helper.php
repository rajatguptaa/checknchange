<?php

function mymail($email, $subject = FALSE, $message = FALSE, $headers = FALSE, $from = FROM_EMAIL,$attach = FALSE,$cc =FALSE) {
	echo '<pre>';
	
    $mail = new PHPMailer();
//	$mail->SMTPDebug = 2; 
   $mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'deoradharmendra2016@gmail.com';                 // SMTP username
$mail->Password = 'Sonu123!@#';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
    if ($from != FALSE)
//        $mail->SetFrom($from, FROM_EMAIL);  //Who is sending the email        $mail->SetFrom($from, 'rajatgupta.gupta1@gmail.com');  //Who is sending the email
     
$mail->AddReplyTo("rajatgupta.gupta1@gmail.com","Firstname Lastname");  //email address that receives the response
  
    if ($subject != FALSE) {
         $mail->Subject = $subject;
    }
    if ($message != FALSE) {
        $mail->Body = $message;
        $mail->AltBody = $message;
    }

    if (is_array($email) && count($email) > 0) {
        for ($i = 0; $i < count($email); $i++) {
            $destino = $email[$i]; // Who is addressed the email to

            $mail->AddAddress($destino, $destino);
        }
    } else {
        $destino = $email; // Who is addressed the email to
        $mail->AddAddress($destino, $destino);
    }
    if(!empty($cc) && $cc!=FALSE){
    if (is_array($cc) && count($cc) > 0) {
        for ($i = 0; $i < count($cc); $i++) {
            $destino = $cc[$i]; // Who is addressed the email to

            $mail->AddCC($destino, $destino);
        }
    } else {
        $destino = $cc; // Who is addressed the email to
        $mail->AddCC($destino, $destino);
    }
    }

    if (!$mail->Send()) {
        return FALSE;
    } else {
        return TRUE;
    }
}
