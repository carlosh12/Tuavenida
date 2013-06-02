<?php

include("includes/cnx.php");
session_start();

$nombres = $_POST["name"];
$apellidos = $_POST["apellido"];
$cedula = $_POST["cedula"];
$telefono = $_POST["telefono"];
$email = $_POST["email"];

if(trim($_POST["name"]) != "" && trim($_POST["apellido"]) != ""  && trim($_POST["telefono"]) != "" && trim($_POST["email"]) != "")
{

$sql = "update usuarios set nombres = '{$nombres}', apellidos = '{$apellidos}', telefono = '{$telefono}', email = '{$email}'  
        where id = '{$_SESSION["user"]["id"]}'";

mysql_query($sql);

}
                   if(isset($_SESSION['url'])) 
                       $url = $_SESSION['url']; // holds url for last page visited.
                   else 
                       $url = "index.php"; // default page for 
                   
                   echo '<SCRIPT LANGUAGE="javascript">';
                   echo 'location.href = "' . $url . '"';
                   echo "</SCRIPT>";

?>
