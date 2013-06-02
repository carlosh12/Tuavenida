<?php

include("includes/init-inc.php");

    if (isset($_GET['idioma']))
    $idiomaActual = $_GET['idioma'];
    
    if (isset($_POST['valor']))
        $valor = $_POST['valor'];
    else
        $valor = 0;
    
    if (isset($_POST['tipo']))
        $tipo = $_POST['tipo'];
    else
        $tipo = '1';
    
    if (isset($_POST['date1'])){
        $date1 = $_POST['date1'];
	}
    
    if (floor(daysDifference(date("Y-m-d"),$date1)/366) == 0)
            $edad = 0;
    else
            $edad = 1;  
    
    $sig[]='R'; 
    $sig[]='$'; 
    $sig[]=' ';
    $sig[]='.'; 
    $valor =  str_replace($sig,'',$valor);

    $valor=str_replace(",",".",$valor);
   
    if (strtotime($date1) >= strtotime('-2 years', time())){
        
    if (is_numeric ($valor)){
        
        //$sql = "select prima,id_plan from SEG_Planes where min < ". $valor ." and max >= ". $valor ." and id_tipo = (select id_tipo from SEG_Tipo_disp where id_tipo = '". $tipo ."')";
        
        $sql = "select prima,id_plan from SEG_Planes where min < ". $valor ." and max >= ". $valor ." and id_tipo = 
                (select id_tipo from SEG_Tipo_disp where id_tipo = '". $tipo ."')
                and edad = $edad";
                
        $res = mysql_query($sql) or die (mysql_error());
        
        $num_total_registros = mysql_num_rows($res);
	if($num_total_registros>0){
        
            while($fila = mysql_fetch_assoc($res)){               
                $_SESSION["cotizar"]['valor'] = $valor;
                $_SESSION["cotizar"]['tipo'] = htmlentities(readreturn('SEG_Tipo_disp','id_tipo',$tipo,'tipo_descrip'));
                $_SESSION["cotizar"]['datecompra'] = $date1;
                $_SESSION["cotizar"]['prima'] = $fila['prima']*$valor;
                $_SESSION["cotizar"]['id_plan'] = $fila['id_plan'];
                
                echo "Proteja seu equipamento á partir de R$(". round($fila['prima']/12*$valor,2) . ") por mês";
                
                //echo "      <a href='detalle.php?idioma=" . $idiomaActual . "&idprod=". $_SESSION['cotizar']['id_plan'] ."'><img src='images/checkout.png' alt='' /></a>";
                
                echo "<table border=0 cellpadding=0 cellspacing=0>";
                echo "<tr>";
                echo "<td class='btn_vermas' width='90'><a href='detalle.php?idioma=$idiomaActual&idprod=".$_SESSION["cotizar"]["id_plan"]."'>$txt_cotizar_envio_boton_continuar</a></td>";
                echo "<td width='44'><a href='detalle.php?idioma=$idiomaActual&idprod=".$_SESSION["cotizar"]["id_plan"]."'><img src='images/btn_vermas_2.png' width='44' height='27'/></a></td>";
                
//                echo "<button type='submit' style='border: 0; background: transparent' onClick='location.href=index.html'>";                             
//                echo "<a class='btn_vermas2' href='detalle.php?idioma=" . $idiomaActual . "&idprod=". $_SESSION['cotizar']['id_plan'] ."'><span> $txt_cotizar_envio_boton_continuar </span></a>  ";          
//                echo'</button>';
                echo "</tr>";
                echo "</table>";
            }	
            }else{
            $sql = "select max(max) as maxi from SEG_Planes where id_tipo = (select id_tipo from SEG_Tipo_disp where id_tipo = '". $tipo ."')";
            $res = mysql_query($sql) or die (mysql_error());
            while($fila = mysql_fetch_assoc($res)){               
                echo "O valor máximo: R$ " . $fila['maxi'];;
            }
            
            }
    }else{
        echo "Deve digitar um valor na factura correto";}
    }else
    {
        echo "Seleccione una data de compra correcta";
    }
    
?>