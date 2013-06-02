<?php
include("includes/init-inc.php");
// A partir de aquí ponemos el código de 
// la página en lenguaje HTML
//$_SESSION['url'] = $_SERVER['REQUEST_URI'];
//
//if (!isset($_SESSION["user"]["id"])) {
//    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/Tuavenida/login.php?idioma=" . $idiomaActual);
//}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />

        <title>Tuavenida.com</title>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/shadowbox.js"></script>

        <script type="text/javascript">
            function recargar(){    
                /// Aqui podemos enviarle alguna variable a nuestro script PHP
                var variable_post="Mi texto recargado";
                /// Invocamos a nuestro script PHP
                $.post("miscript.php", { variable: variable_post }, function(data){
                    /// Ponemos la respuesta de nuestro script en el DIV recargado
                    $("#recargado").html(data);
                });         
            }
        </script>

<!--        <script type="text/javascript">
            function plazos(pos,precio){    
                /// Aqui podemos enviarle alguna variable a nuestro script PHP
                
                var cmb = 'combo'+pos;
                var frm = 'form'+pos;
                
                for(i=0; i <document.getElementById(frm).elements[cmb].length; i++){
                    if(document.getElementById(frm).elements[cmb][i].checked){
                        valorSeleccionado = document.getElementById(frm).elements[cmb][i].value;
                    }
                }
                var variable_post= valorSeleccionado;
                
                variable_post = precio/12*variable_post;
                
                /// Invocamos a nuestro script PHP
                
                $.post("carritoplazo.php", { variable: variable_post, plazo: valorSeleccionado, posicion: pos}, function(data){
                    /// Ponemos la respuesta de nuestro script en el DIV recargado
                    var div = "#plazo"+pos;
                    $(div).html(data);
                }); 
                
                 /// Invocamos a nuestro script PHP
                $.post("sumarcarrito.php", { variable: variable_post, plazo: valorSeleccionado, posicion: pos}, function(data){
                    /// Ponemos la respuesta de nuestro script en el DIV recargado
                    $("#plazototal").html(data);
                }); 
            }
        </script>-->

        <script type="text/javascript">var _siteRoot='index.html',_root='index.html';</script>

        <link rel="Shortcut Icon" href="images/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="css/main.css" type="text/css" />
        <link rel="stylesheet" href="css/menu.css" type="text/css" />
        <link rel="stylesheet" href="css/slider.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/shadowbox.css" type="text/css" />

    </head>
    <body>

        <div id="contenedor">

            <!-- seccion inc header -->
            <?php include("includes/header-inc.php"); ?>
            <!-- termina inc header -->

            <div id="main">
                <div id="contenido_left">
                    <br></br>
                    <p><?php cargar_productos("productos", "producto", $idiomaActual, "id"); ?></p>
                </div>

                <div id="separador">
                </div>

                <div id="contenido_top">
                    <table width="100%" border="0" height="100%"  cellpadding="0" cellspacing="0">
                        <tr>
                            <td colspan="3" align="left"><img src="images/progess/paso3.png" alt=""/></td>
                        </tr>

                        <tr>
                            <td colspan="3">&nbsp;</td>  
                        </tr>
                        <tr>
                            <td height="31" colspan="3"><h1><?php echo htmlentities($txt_carritoh1) ?></h1></td>
                        </tr>
                        <tr>
                            <td height="31" colspan="3"><h2><?php echo $txt_carritoh2 ?></h2></td>
                        </tr>
                        <tr>
                            <td height="40" colspan="3"><img src="images/separador_contenido.png" alt=""/></td>
                        </tr>
                    </table>
                </div>

                <div id="contenido_carro">

                    <?php
                    if (isset($_GET['idprod']))
                        $id = $_GET['idprod'];
                    else
                        $id = 1;

                    if (isset($_GET['action'])) {
                        $action = $_GET['action'];
                        //echo '<script languaje="javacript"> recargar() </script>';
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


                                unset($_SESSION['cotizar']);
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

                        case "mostrar":
                            if (isset($_SESSION['carro'])) {
                                continue;
                            }
                            break;

                        case "empty":
                            unset($_SESSION['carro']);
                            break;
                    }

                    /* MOSTRAR Carro */
                    /* echo "<pre>";
                      print_r($_SESSION);
                      echo "</pre>";

                      echo "CANTIDAD: " .	$_SESSION['carro'][$id] . "<br>";
                      echo "ID      : " . $id . "<br>";
                     */

                    if (isset($_SESSION['carro'])) {
                        echo "<table border=0 cellspacing=5 cellpadding=3 width='100%'>";
                        $totalcoste = 0;
                        //Inicializamos el contador de productos seleccionados.
                        $xTotal = 0;

                        echo "<tr>";
                        echo "<td>" . htmlentities($txt_carritoprod) . "</td>";
                        echo "<td>Prazo</td>";
                        echo "<td> </td>";
                        echo "<td colspan=2 align=right>" . htmlentities($txt_carritotot) . "</td>";
                        echo "</tr>";
                        echo "<tr><td colspan=5><hr></td></tr>";

                        foreach ($_SESSION['carro'] as $pos => $prod) {

                            $xTotal++;

                            $resultado = mysql_query("SELECT id as id_plan, concat(clase, ' - ' , subtipo) as texto, total as prima
                                                        from soat where id = $prod[id]");

                            $mifila = mysql_fetch_array($resultado);
                            $id = $mifila['id_plan'];
                            $producto = $mifila['texto'];
                            //acortamos el nombre del producto a 40 caracteres
                            $producto = substr($producto, 0, 40);
                            $precio = $mifila['prima'];
                            $_SESSION['carro'][$pos]['precio'] = $precio;

                            //Coste por art?culo seg?n la cantidad elegida
                            $coste = $_SESSION['carro'][$pos]['prima'];

                            //Coste total del carro
                            $totalcoste = $totalcoste + $coste;
                            //Contador del total de productos a?adidos al carro

                            echo "<tr>";
                            echo "<td align='left'> $producto <br/>(" . $_SESSION['carro'][$pos]['name'] . ")</td>";

                            echo "<td align='left'> 12 meses";
//                            echo "<form id=form" . $pos . " name=form" . $pos . " method=post>";
//                            $array = array(
//                                '1' => '1 mes',
//                                '3' => '3 meses',
//                                '6' => '6 meses',
//                                '12' => '12 meses');
//                            echo createRadio('combo', $array, '12', $pos, $precio);
//                            echo "</form>
                            echo "</td>";


                            echo "<td align='left'>";

                            echo "<a href='carro.php?idprod=$id&action=removeProd&idioma=$idiomaActual&pos=$pos'><img src='images/carro/eliminar.png' alt='Reducir cantidad' /></a></td>";

                            echo "<td align='right'> = </td>";

                            //echo "<td align='right' style='margin-left:10px'>" . $txt_moneda . number_format($coste, 2);
                            echo "<td align='right' style='margin-left:10px'><div id='plazo" . $pos . "'> " . $txt_moneda . number_format($coste, 0, '', '.') . "</div></td>";
                            echo "</tr>";
                        }
                        echo "<tr><td colspan='5'><hr></td></tr>";
                        echo "<tr>";
                        echo "<td align='right' colspan='4'><b><br>$txt_carritotot = </b></td>";
                        //echo "<td align='right'><b><br>" . $txt_moneda . number_format($totalcoste, 2) . " </b></td>";
                        echo "<td align='right'><b><br><div id='plazototal'>" . $txt_moneda . number_format($totalcoste, 0, '', '.') . " </div></b></td>";

                        echo "</tr>";
                        //BOTON COMPRAR
                        echo "<tr>";
                        echo "<td colspan='5'>";

                        //INSERTAR DEV_PROD

                        echo '<FORM ACTION = "" METHOD = "">';
                        echo "<input type='image' img src='images/logo_pagosonline.png' align='right' disabled>";
                        echo '</FORM>';

                        echo "</table>";
                    } else
                        echo $txt_carritovacio . "<br></br>";

                    //Campos que nos serviran para informar la cesta de lo que llevamos comprados y que se mostrar? en 
                    //la p?gina PRODUCTOS.


                    if ($xTotal == 0) {
                        echo '<SCRIPT LANGUAGE="javascript">';
                        echo 'location.href = "index.php"';
                        echo '</SCRIPT>';
                    }
                    ?>
                    <table cellpadding="0" Cellspacing="0">
                        <tr>
                            <td valign="middle" width='27'><input type="image" src="images/btn_previous.png" onclick="history.go(-1)"></input></td> 
                            <td class="btn_vermas" width='90'><a href="javascript:history.go(-1)"><?php echo $txt_resumen_boton_volver ?> </a></td>
                        </tr>
                    </table>
                </div> <!--termina contenido-->

            </div> <!--termina main-->


            <!-- seccion inc footer -->
            <?php include("includes/footer-inc.php"); ?>
            <!-- termina inc footer -->

        </div> <!--termina contenedor-->

    </body>
</html>