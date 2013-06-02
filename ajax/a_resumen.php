<?php

session_start();

include("../includes/cnx.php");
include("../includes/funciones.php");

if (isset($_POST["date1"]))
    $date1 = $_POST["date1"];
else
    $date1 = $_SESSION['cotizar']['datefactura'];

if (isset($_POST["name"]))
    $name = $_POST["name"];
else
    $name = $_SESSION['cotizar']['name'];

if (isset($_POST["apellido"]))
    $apellido = $_POST["apellido"];
else
    $apellido = $_SESSION['cotizar']['apellido'];

if (isset($_POST["direccion"]))
    $direccion = $_POST["direccion"];
else
    $direccion = $_SESSION['cotizar']['direccion'];

if (isset($_POST["direccionnum"]))
    $direccionnum = $_POST["direccionnum"];
else
    $direccionnum = '';

if (isset($_POST["barrio"]))
    $barrio = $_POST["barrio"];
else
    $barrio = $_SESSION['cotizar']['barrio'];

if (isset($_POST["ciudad"])) {
    if (is_numeric($_POST["ciudad"])) {
        $ciudad = htmlentities(readreturn("PAIS_Cities", "CityId", $_POST["ciudad"], "City"));
        $estado = htmlentities(readreturn("PAIS_Regions", "RegionId", $_POST["estado"], "Code"));
    } else {
        $ciudad = $_POST["ciudad"];
        $estado = $_POST["estado"];
    }
} else {
    $ciudad = $_SESSION['cotizar']['ciudad'];
    $estado = $_SESSION['cotizar']['estado'];
}

if (isset($_POST["cep"]))
    $cep = $_POST["cep"];
else
    $cep = $_SESSION['cotizar']['cep'];

if (isset($_POST["cpf"]) or isset($_POST["cnpj"])) {
    if (isset($_POST["cpf"]))
        $documentoid = $_POST["cpf"];
    else
        $documentoid = $_POST["cnpj"];
}
else
    $documentoid = $_SESSION['cotizar']['cpf'];

if (isset($_POST["telefono"]))
    $telefono = $_POST["telefono"];
else
    $telefono = $_SESSION['cotizar']['telefono'];

if (isset($_POST["email"]))
    $email = $_POST["email"];
else
    $email = $_SESSION['cotizar']['email'];

if (isset($_POST["descripcion"]))
    $descripcion = $_POST["descripcion"];
else
    $descripcion = $_SESSION['cotizar']['descrip'];

if (isset($_POST["notafiscal"]))
    $notafiscal = $_POST["notafiscal"];
else
    $notafiscal = $_SESSION['cotizar']['notafiscal'];

if (isset($_POST["sexo"]))
    $sexo = $_POST["sexo"];
else
    $sexo = $_SESSION['cotizar']['sexo'];

$_SESSION['cotizar']['datefactura'] = $date1;
$_SESSION['cotizar']['name'] = $name;
$_SESSION['cotizar']['apellido'] = $apellido;
$_SESSION['cotizar']['direccion'] = $direccion . ' ' . $direccionnum;
$_SESSION['cotizar']['barrio'] = $barrio;
$_SESSION['cotizar']['ciudad'] = $ciudad;
$_SESSION['cotizar']['estado'] = $estado;
$_SESSION['cotizar']['cep'] = $cep;
$_SESSION['cotizar']['cpf'] = $documentoid;
$_SESSION['cotizar']['telefono'] = $telefono;
$_SESSION['cotizar']['email'] = $email;
$_SESSION['cotizar']['descrip'] = $descripcion;
$_SESSION['cotizar']['sexo'] = $sexo;
$_SESSION['cotizar']['notafiscal'] = $notafiscal;

echo '<SCRIPT LANGUAGE="javascript">';
if ((isset($_GET['action'])) && (isset($_GET['pos'])))
    echo 'location.href = "../resumen.php?action=edit&pos=' . $_GET['pos'] . '"';
else
    echo 'location.href = "../resumen.php"';
echo '</SCRIPT>';

?>
