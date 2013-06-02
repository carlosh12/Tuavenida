<?php

include("includes/init-inc.php");

if (isset($_POST['date1']))
    $edad = $_POST['date1'];

    $anos = CalculaEdad($edad);

    $sql = "select amparo,precio from VIDA_GRAL where edad = '$anos'";


$res = mysql_query($sql) or die(mysql_error());

$num_total_registros = mysql_num_rows($res);
if ($num_total_registros == 1) {

    while ($fila = mysql_fetch_assoc($res)) {

        echo "Valor de la poliza<br/>COP$ " . number_format($fila['precio'], 0, '', '.') . " mes<br/>";
        echo "Amparo<br/>COP$ " . number_format($fila['amparo'], 0, '', '.');
        echo "<table border=0 cellpadding=0 cellspacing=0>";
        echo "<tr>";
        echo "<td class='btn_vermas' width='90'><a href='#'>$txt_cotizar_envio_boton_continuar</a></td>";
        echo "<td width='44'><a href='#'><img src='images/btn_vermas_2.png' width='44' height='27'/></a></td>";

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