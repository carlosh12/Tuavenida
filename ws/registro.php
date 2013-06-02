<?php
echo  'testing web service' . date(DATE_RFC822);

$firstName = 'test1';
$lastName = 'test2';
$email = 'hola3@hola3.com';
$password = '1234';
$phoneNumber = '0414352886';
$manufacture = 'HTC';
$model = 'One';
$carrier = 'Vodafone';

$WebService="http://test-tuavenida.sparebackup.com/register.asmx?wsdl";
//parametros de la llamada
$parametros = array(); 
$parametros['firstName'] = $firstName; 
$parametros['lastName'] = $lastName;
$parametros['email'] = $email; 
$parametros['password'] = $password;
$parametros['phoneNumber'] = $phoneNumber; 
$parametros['manufacture'] = $manufacture;
$parametros['model'] = $model; 
$parametros['carrier'] = $carrier;

//Invocacion al web service
$WS = new SoapClient($WebService, $parametros);
//recibimos la respuesta dentro de un objeto

$result = $WS->SiteRegister ($parametros);
//Mostramos el resultado de la consulta
//echo $result;
?>