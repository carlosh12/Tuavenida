<?php
include("includes/cnx.php");
include("includes/funciones.php");


array_walk($_POST, 'limpiarCadena');
array_walk($_GET, 'limpiarCadena');

//session_start();


// Definimos el idioma por defecto, en este
// caso será es (español)
$idiomaActual = 'br';

// Si se ha seleccionado un idioma se guarda
// una cookie con el idioma
if (isset($_GET['idioma'])) {
    setcookie("idioma", $_GET['idioma'], time() + 60 * 60 * 24 * 30);
    $idiomaActual = $_GET['idioma'];
} elseif (isset($_COOKIE['idioma'])) {

// Miramos que exista el archivo del idioma
    if (file_exists("idiomas/lang-" . $_COOKIE['idioma'] . ".php")) {
        $idiomaActual = $_COOKIE['idioma'];
    }
}

// Incluimos el archivo del idioma seleccionado
// o el archivo por defecto si no se seleccionó
// idioma o si no se encuentra el archivo
include "idiomas/lang-" . $idiomaActual . ".php";

if (isset($_GET['idprod'])) {
    $idprod = $_GET['idprod'];
}

?>