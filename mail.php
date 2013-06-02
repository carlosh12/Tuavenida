<?php
require_once("class.phpmailer.php");
$mail             = new PHPMailer(); // defaults to using php "mail()"
$mail->SetFrom('alfonso.bolao@gmail.com', 'First Last');
$address = "alfonsobolao@hotmail.com";
$mail->AddAddress($address, "John Doe");
$mail->Subject    = "PHPMailer Test Subject via mail(), basic";
$body  = "Hola <strong>amigo</strong><br>";
$body .= "probando <i>PHPMailer<i>.<br><br>";
$body .= "<font color='red'>Saludos</font>";
$mail->Body = $body;
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; 
$mail->MsgHTML($body);
if(!$mail->Send()) {
  echo "Error" . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>

