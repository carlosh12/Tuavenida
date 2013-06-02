<?php

session_start();

include("../includes/cnx.php");

if (isset($_GET['idprod']))
    $id = $_GET['idprod'];

if (isset($_GET['pos']))
    $pos = $_GET['pos'];

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
else
    $action = "empty";

switch ($action) {

    case "add": {
            $_SESSION['carro'][]['id'] = $id;

            foreach ($_SESSION['carro'] as $ultimo => $temp) {
                
            }
            $_SESSION['carro'][$ultimo]['valor'] = $_SESSION['cotizar']['valor'];
            $_SESSION['carro'][$ultimo]['tipo'] = $_SESSION['cotizar']['tipo'];
            $_SESSION['carro'][$ultimo]['datecompra'] = $_SESSION['cotizar']['datecompra'];
            $_SESSION['carro'][$ultimo]['prima'] = $_SESSION['cotizar']['prima'];
            $_SESSION['carro'][$ultimo]['id_plan'] = $_SESSION['cotizar']['id_plan'];
            $_SESSION['carro'][$ultimo]['datefactura'] = $_SESSION['cotizar']['datefactura'];
            $_SESSION['carro'][$ultimo]['name'] = $_SESSION['cotizar']['name'];
            $_SESSION['carro'][$ultimo]['apellido'] = $_SESSION['cotizar']['apellido'];
            $_SESSION['carro'][$ultimo]['direccion'] = $_SESSION['cotizar']['direccion'];
            $_SESSION['carro'][$ultimo]['barrio'] = $_SESSION['cotizar']['barrio'];
            $_SESSION['carro'][$ultimo]['ciudad'] = $_SESSION['cotizar']['ciudad'];
            $_SESSION['carro'][$ultimo]['estado'] = $_SESSION['cotizar']['estado'];
            $_SESSION['carro'][$ultimo]['cep'] = $_SESSION['cotizar']['cep'];
            $_SESSION['carro'][$ultimo]['cpf'] = $_SESSION['cotizar']['cpf'];
            $_SESSION['carro'][$ultimo]['telefono'] = $_SESSION['cotizar']['telefono'];
            $_SESSION['carro'][$ultimo]['email'] = $_SESSION['cotizar']['email'];
            $_SESSION['carro'][$ultimo]['descrip'] = $_SESSION['cotizar']['descrip'];
            $_SESSION['carro'][$ultimo]['sexo'] = $_SESSION['cotizar']['sexo'];
            $_SESSION['carro'][$ultimo]['notafiscal'] = $_SESSION['cotizar']['notafiscal'];


            //unset($_SESSION['cotizar']);
        }
        break;

    case "edit": {
            $_SESSION['carro'][$pos]['valor'] = $_SESSION['cotizar']['valor'];
            $_SESSION['carro'][$pos]['tipo'] = $_SESSION['cotizar']['tipo'];
            $_SESSION['carro'][$pos]['datecompra'] = $_SESSION['cotizar']['datecompra'];
            $_SESSION['carro'][$pos]['prima'] = $_SESSION['cotizar']['prima'];
            $_SESSION['carro'][$pos]['id_plan'] = $_SESSION['cotizar']['id_plan'];
            $_SESSION['carro'][$pos]['datefactura'] = $_SESSION['cotizar']['datefactura'];
            $_SESSION['carro'][$pos]['name'] = $_SESSION['cotizar']['name'];
            $_SESSION['carro'][$pos]['apellido'] = $_SESSION['cotizar']['apellido'];
            $_SESSION['carro'][$pos]['direccion'] = $_SESSION['cotizar']['direccion'];
            $_SESSION['carro'][$pos]['barrio'] = $_SESSION['cotizar']['barrio'];
            $_SESSION['carro'][$pos]['ciudad'] = $_SESSION['cotizar']['ciudad'];
            $_SESSION['carro'][$pos]['estado'] = $_SESSION['cotizar']['estado'];
            $_SESSION['carro'][$pos]['cep'] = $_SESSION['cotizar']['cep'];
            $_SESSION['carro'][$pos]['cpf'] = $_SESSION['cotizar']['cpf'];
            $_SESSION['carro'][$pos]['telefono'] = $_SESSION['cotizar']['telefono'];
            $_SESSION['carro'][$pos]['email'] = $_SESSION['cotizar']['email'];
            $_SESSION['carro'][$pos]['descrip'] = $_SESSION['cotizar']['descrip'];
            $_SESSION['carro'][$pos]['sexo'] = $_SESSION['cotizar']['sexo'];
            $_SESSION['carro'][$pos]['notafiscal'] = $_SESSION['cotizar']['notafiscal'];
        }
        break;

    case "removeProd":

//                            foreach ($_SESSION['carro'] as $pos => $prod){
//                                if ($_SESSION['carro'][$pos]['id']==$id)
//                                    unset($_SESSION['carro'][$pos]);
//                            }

        unset($_SESSION['carro'][$_GET['pos']]);
        $_SESSION['carro'] = array_values($_SESSION['carro']);

        break;

    case "view":
        if (isset($_SESSION['carro'])) {
            continue;
        }
        break;

    case "empty":
        unset($_SESSION['carro']);
        break;
}

echo '<SCRIPT LANGUAGE="javascript">';
echo 'location.href = "carro.php?action=view"';
echo "</SCRIPT>";
?>
