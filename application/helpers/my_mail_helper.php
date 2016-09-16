<?php

function mymail($email, $subject = FALSE, $message = FALSE, $headers = FALSE, $from = FROM_EMAIL,$attach = FALSE,$cc =FALSE) {

    $mail = new PHPMailer();

    $mail->IsSMTP(); // we are going to use SMTP
    $mail->SMTPAuth = true; // enabled SMTP authentication
    $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
    $mail->Host = SMTP_HOST;      // setting GMail as our SMTP server
    $mail->Port = SMTP_PORT;                   // SMTP port to connect to GMail
    $mail->Username = SMTP_USERNAME;  // user email address
    $mail->Password = SMTP_PASSWORD;            // password in GMail
    if ($from != FALSE)
        $mail->SetFrom($from, FROM_EMAIL);  //Who is sending the email
        
// $mail->AddReplyTo("ign@ignisitsolutions.com","Firstname Lastname");  //email address that receives the response
  
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
