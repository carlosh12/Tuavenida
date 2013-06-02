<?php
require_once("includes/PHPMailer_5.2.1/class.phpmailer.php");

$mail = new PHPMailer();
$mail->SetFrom("info@tuavenida.com");
$mail->Subject = "tuavenida";

$mail->AddAddress("carlosh12@gmail.com");
$mail->Subject = "Test 1";
$mail->Body = "Test 1 of PHPMailer.";
$mail->AddAttachment("..//polizas//00000079.pdf");

if(!$mail->Send())
{
   echo "Error sending: " . $mail->ErrorInfo;;
}
else
{
   echo "Letter sent";
}
?>
