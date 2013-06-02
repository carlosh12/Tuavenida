<?php
include("includes/cnx.php");
include("includes/funciones.php");
require_once ("includes/mailer/class.phpmailer.php");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//respuesta automatica
$mail = new PHPMailer();
$mail->SetFrom("info@tuavenida.com", 'Info Tuavenida.com');
$mail->Subject = "tuavenida";
$mail->AddAddress($_POST["email"]);
$mail->AddCC("alfonsobolao@hotmail.com");
$body = "Gracias por Contactarnos Sr(a).\n";
$body .=$_POST["nombre"]."  ".$_POST["apellido"].".\n";
$body .="En http://tuavenida.com estamos para servirle\n";
$mail->IsHTML(TRUE);
$mail->Body = $body;
$mail->Send();



// mail a info@tuavenida.com
$mail = new PHPMailer();
$mail->SetFrom($_POST["email"]);
$mail->AddAddress("info@tuavenida.com");
$mail->Subject = "Mensaje de contacto";
$mail->AddCC("alfonsobolao@hotmail.com");
$body = "Enviado por:\n ";
$body .=$_POST["nombre"]."  ".$_POST["apellido"]."\n";
$body .=$_POST["mensajeContacto"];
$mail->Body = $body;
if(!$mail->Send()) {
   $datos["exito"] = 0;
    echo json_encode($datos); // $mail->ErrorInfo;
} else {
  $datos["exito"] = 1;
    echo json_encode($datos);
}


?>
