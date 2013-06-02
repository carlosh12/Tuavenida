<?php
    include("includes/cnx.php");
    include("includes/funciones.php");
    require_once ("includes/PHPMailer_5.2.1/class.phpmailer.php");
    
    include("includes/init-inc.php");
    
    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */
    $usuario = $_POST["mail"];
    $sql = "select password from usuarios where email = '".$usuario."'";
    $res = mysql_query($sql) or die(mysql_error());

    while ($fila = mysql_fetch_assoc($res)) 
    {
        $clave = $fila["password"];
    }
    if (mysql_affected_rows()>0)
    {
        $mail = new PHPMailer();
        $mail->SetFrom("info@tuavenida.com");
        //$mail->AddAttachment("images/logo_.png","logo_.png");
        $mail->AddAddress($_POST["mail"]);
        $mail->Subject = $txt_recuperar_mail_asunto;
        $body ="<html><head><meta http-equiv='content-type' content='text/html;charset=UTF-8' /></head>";
        $body .= "<body style='background-color:#F3F3F3;color: #ACACAC;'><h1>Su clave es".$txt_recuperar_mail_su_clave_es.":</h1>\n ";
        $body .=$clave ;
        $body .="\n <p style='color:blue'>Gracias por usar nuestros servicios.".$txt_recuperar_mail_gracias."</p>\n";
        $body .="<a style='font-size:18px' href='http://tuavenida.com'>tuavenida</a></body></html>";
        $mail->Body = $body;
        $mail->IsHTML(TRUE);
        if(!$mail->Send()) 
        {
           $datos["exito"] = 0; //error
           echo json_encode($datos); // $mail->ErrorInfo;
        } 
        else 
        {
            $datos["exito"] = 1; //mail enviado
            echo json_encode($datos);
        }
   
   
    }
    else
    {
      $datos["exito"] = 0;//correo no existe
      echo json_encode($datos);

    }
   
?>
