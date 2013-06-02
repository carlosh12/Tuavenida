<?php

include("includes/init-inc.php");

function quitar($mensaje) {
    $nopermitidos = array("'", '\\', '<', '>', "\"");
    $mensaje = str_replace($nopermitidos, "", $mensaje);
    return $mensaje;
}

if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

    if (trim($_POST["email"]) != "" && trim($_POST["pass1"]) != "") {
        //Puedes utilizar la funcion para eliminar algun caracter en especifico
        //$usuario = strtolower(quitar($HTTP_POST_VARS["usuario"]));
        //$password = $HTTP_POST_VARS["password"];
        // o puedes convertir los a su entidad HTML aplicable con htmlentities
        $usuario = strtolower(htmlentities($_POST["email"], ENT_QUOTES));
        $password = $_POST["pass1"];
        $sql = "select * from usuarios where email ='";
        $sql.=$usuario . "' and password='" . $password . "'";
        ;
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);

        if ($row["email"] == $usuario) {

            $arreglo = explode(' ', $row['nombres']);
            $_SESSION["k_username"] = $arreglo[0];

            $_SESSION["user"]["id"] = $row["id"];
            $_SESSION["user"]["nombre"] = $row["nombres"];
            $_SESSION["user"]["apellido"] = $row["apellidos"];
            $_SESSION["user"]["cedula"] = $row["cedula"];
            $_SESSION["user"]["telefono"] = $row["telefono"];
            $_SESSION["user"]["ciudad"] = $row["ciudad"];
            $_SESSION["user"]["zipcode"] = $row["zipcode"];
            $_SESSION["user"]["estado"] = $row["estado"];
            $_SESSION["user"]["barrio"] = $row["barrio"];
            $_SESSION["user"]["direccion"] = $row["direccion"];
            $_SESSION["user"]["fecha"] = $row["fecha"];
            $_SESSION["user"]["sexo"] = $row["sexo"];
            $_SESSION["user"]["nacimiento"] = $row["nacimiento"];
            $_SESSION["user"]["estadocivil"] = $row["estadocivil"];
            $_SESSION["user"]["email"] = $row["email"];
            $_SESSION["user"]["suscrito"] = $row["suscrito"];

            if (isset($_SESSION['url']))
                $url = $_SESSION['url']; // holds url for last page visited.
            else
                $url = "index.php"; // default page for 

            echo '<SCRIPT LANGUAGE="javascript">';
            echo 'location.href = "' . $url . '"';
            echo "</SCRIPT>";
        }else
            echo $txt_login_clave_errada;
    }
}
?>