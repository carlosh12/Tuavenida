<?php

include("includes/init-inc.php");

$posi = $_POST['posicion'];
$_SESSION['carro'][$posi]['plazo'] = $_POST['plazo'];
$_SESSION['carro'][$posi]['precio'] = $_POST['variable'];

$total = 0;
foreach ($_SESSION['carro'] as $pos => $prod) {
    
    if ($pos==$posi)
    $total = $total + $_POST['variable'];    
        else
    $total = $total + $_SESSION['carro'][$pos]['precio'];
}
echo  $txt_moneda . number_format($total, 2);
?>
