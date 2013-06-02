<?php
echo  'testing web service upgrade' . date(DATE_RFC822);

$email = 'carlosh_12@yahoo.com';
$password = 'carlosh12';
$upgtype = '2';

$WebService="http://test-tuavenida.sparebackup.com/register.asmx?wsdl";
//parametros de la llamada
$parametros = array(); 
$parametros['email'] = $email; 
$parametros['password'] = $password;
$parametros['upgtype'] = $upgtype; 

//Invocacion al web service
$WS = new SoapClient($WebService, $parametros);
//recibimos la respuesta dentro de un objeto

if ($WS->upgrade ($parametros))
    echo "yes";
    else
        echo "fail";
//Mostramos el resultado de la consulta
//echo $result;
?>