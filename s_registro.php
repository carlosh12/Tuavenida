<?php

include("includes/init-inc.php");

function quitar($mensaje) {
    $nopermitidos = array("'", '\\', '<', '>', "\"");
    $mensaje = str_replace($nopermitidos, "", $mensaje);
    return $mensaje;
}

if (trim($_POST["nombre"]) != "" && trim($_POST["apellido"]) != "" &&
        trim($_POST["email"]) != "" && trim($_POST["password"]) != "" &&
        trim($_POST["password2"]) != "") {
    // Puedes utilizar la funcion para eliminar algun caracter en especifico
    //$usuario = strtolower(quitar($HTTP_POST_VARS["usuario"]));
    //$password = $HTTP_POST_VARS["password"];
    // o puedes convertir los a su entidad HTML aplicable con htmlentities

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $suscrito = $_POST["suscribir"];

        $query = 'INSERT INTO usuarios (usuario, password, email, fecha, nombres, apellidos, suscrito)
                VALUES (\'' . $email . '\',\'' . $password . '\',\'' . $email . '\',\'' . date("Y-m-d") . '\',
                    \'' . $nombre . '\',\'' . $apellido . '\',\'' . $suscrito . '\')';

        if ( mysql_query($query) ){
  


            // asunto del email
            //$subject = "Contacto";
            $subject = $mail_registro_subject;

            // Cuerpo del mensaje
            $mensaje = "---------------------------------- \n";
            $mensaje.= "            " . $mail_registro_titulo . "               \n";
            $mensaje.= "---------------------------------- \n";            
            $mensaje.= strtoupper($txt_nombre).":   " . $_POST['nombre']." ".$_POST['apellido']."\n";                        
            $mensaje.= strtoupper($txt_email).":    " . $_POST['email'] . "\n";                        
            $mensaje.= strtoupper($txt_fecha).":    " . date("d/m/Y") . "\n";
            $mensaje.= strtoupper($txt_hora).":     " . date("h:i:s a") . "\n";
            $mensaje.= "IP:       " . $_SERVER['REMOTE_ADDR'] . "\n\n";
            $mensaje.= "---------------------------------- \n\n";
            $mensaje.= $_POST['mensaje'] . "\n\n";
            $mensaje.= "---------------------------------- \n";
            $mensaje.= "\n";
            $mensaje.= "http://tuavenida.com";
            $mensaje.= "\n";
            $mensaje.= $txt_registro_enviado_desde . " http://tuavenida.com \n";
            

            // headers del email
            $headers = "From: " . "info@tuavenida.com" . "\r\n";

            // Enviamos el mensaje
            if (mail($email, $subject, $mensaje, $headers)) {
                echo '<SCRIPT LANGUAGE="javascript">location.href = "login.php"</SCRIPT>';
            } else {
                echo '<SCRIPT LANGUAGE="javascript">location.href = "login.php"</SCRIPT>';
            }
            }
            else
                echo $txt_registro_error_form;
        
    
}
?>