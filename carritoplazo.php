<?php
    include("includes/init-inc.php");
    
    $posi = $_POST['posicion'];
    $_SESSION['carro'][$posi]['plazo'] = $_POST['plazo'];
    $_SESSION['carro'][$posi]['precio'] =  $_POST['variable'];
      
    echo  $txt_moneda . number_format($_SESSION['carro'][$posi]['precio'], 2);
   
?>
