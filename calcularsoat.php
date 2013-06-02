<?php

include("includes/init-inc.php");

$_SESSION["cotizar"]['prod'] = $_GET['idprod'];

if (isset($_POST['list1']))
    $clase = readreturn('SOAT_CLASES', 'id', $_POST['list1'], 'clase');
else
    $clase = 0;

if (isset($_POST['list2']))
    $subtipo = readreturn('SOAT_SUBCLASES', 'id', $_POST['list2'], 'subclase');
else
    $subtipo = 0;

if (isset($_POST['list3']))
    $edad = readreturn('SOAT_EDADES', 'id', $_POST['list3'], 'edad');
else
    $edad = 0;

if ($subtipo == '0')
    $sql = "select id,total from soat where clase = '$clase'";
else {

    if ($edad == '0')
    {
        $sql = "select id,total from soat where clase = '$clase' and subtipo = '$subtipo'";
        $edad = "No Aplica";
    }    else
        $sql = "select id,total from soat where clase = '$clase' and subtipo = '$subtipo' and edad = '$edad'";
}

$res = mysql_query($sql) or die(mysql_error());

$num_total_registros = mysql_num_rows($res);
if ($num_total_registros == 1) {

    while ($fila = mysql_fetch_assoc($res)) {
        $_SESSION["cotizar"]['clase'] = htmlentities($clase);
        $_SESSION["cotizar"]['subtipo'] = htmlentities($subtipo);
        $_SESSION["cotizar"]['edad'] = htmlentities($edad);
        $_SESSION["cotizar"]['prima'] = $fila['total'];
        $_SESSION["cotizar"]['id_prod'] = $fila['id'];

        echo "Valor de la poliza<br>COP$ " . number_format($fila['total'], 0, '', '.');
        echo "</fieldset>";
        echo "    </form>";
        echo "<table border=0 cellpadding=0 cellspacing=0>";
        echo "<tr>";
        echo "<td class='btn_vermas' width='90'><a href='detallesoat.php?idioma=$idiomaActual&idprod=" . $fila['id'] . "'>$txt_cotizar_envio_boton_continuar</a></td>";
        echo "<td width='44'><a href='detallesoat.php?idioma=$idiomaActual&idprod=" . $fila['id'] . "'><img src='images/btn_vermas_2.png' width='44' height='27'/></a></td>";

//                echo "<button type='submit' style='border: 0; background: transparent' onClick='location.href=index.html'>";                             
//                echo "<a class='btn_vermas2' href='detalle.php?idioma=" . $idiomaActual . "&idprod=". $_SESSION['cotizar']['id_plan'] ."'><span> $txt_cotizar_envio_boton_continuar </span></a>  ";          
//                echo'</button>';
        echo "</tr>";
        echo "</table>";
    }
} else {

    echo "Error calculando poliza";
}
?>