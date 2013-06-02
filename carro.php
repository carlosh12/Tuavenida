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

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />

        <title>Tuavenida.com</title>

        <link rel="Shortcut Icon" href="images/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="css/main.css" type="text/css" />
        <link rel="stylesheet" href="css/menu.css" type="text/css" />
        <link rel="stylesheet" href="css/slider.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/shadowbox.css" type="text/css" /> 

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/shadowbox.js"></script>

    </head>
    <body>

        <div id="contenedor">

            <!-- seccion inc header -->
            <?php include("includes/header-inc.php"); ?>
            <!-- termina inc header -->

            <div id="main">
                <div id="contenido_left">
                    <br/>
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
                    /* MOSTRAR Carro */
                    /* echo "<pre>";
                      print_r($_SESSION);
                      echo "</pre>";

                      echo "CANTIDAD: " .	$_SESSION['carro'][$id] . "<br>";
                      echo "ID      : " . $id . "<br>";
                     */

                    if (isset($_SESSION['carro'])) {
                        echo "<table cellspacing=5 cellpadding=3 width='100%'>";
                        $totalcoste = 0;
                        //Inicializamos el contador de productos seleccionados.
                        $xTotal = 0;

                        echo "<tr>";
                        echo "<td>" . htmlentities($txt_carritoprod) . "</td>";
                        echo "<td align='center'>Prazo</td>";
                        //echo "<td align='center'>Edit</td>";
                        echo "<td align='center'></td>";
                        echo "<td align='center'>Remover</td>";
                        echo "<td colspan=2 align=right>" . htmlentities($txt_carritotot) . "</td>";
                        echo "</tr>";
                        echo "<tr><td colspan=6><hr></td></tr>";

                        foreach ($_SESSION['carro'] as $pos => $prod) {

                            $xTotal++;

                            $resultado = mysql_query("SELECT SEG_Planes.id_plan, concat(productos.producto, ' - ' , SEG_Tipo_disp.tipo_descrip) as texto, SEG_Planes.prima
                                from SEG_Planes join SEG_Tipo_disp on SEG_Planes.id_tipo = SEG_Tipo_disp.id_tipo
                                join productos on SEG_Tipo_disp.id_prod = productos.id 
                                where SEG_Planes.id_plan = $prod[id_plan]");

                            $mifila = mysql_fetch_array($resultado);
                            $producto = 
                            //acortamos el nombre del producto a 40 caracteres
                            $producto = htmlentities(substr($mifila['texto'], 0, 40));
                            $precio = $mifila['prima'];
                            $_SESSION['carro'][$pos]['precio'] = $precio;

                            //Coste por art?culo seg?n la cantidad elegida
                            $coste = $_SESSION['carro'][$pos]['prima'];

                            //Coste total del carro
                            $totalcoste = $totalcoste + $coste;
                            //Contador del total de productos a?adidos al carro

                            echo "<tr>";
                            echo "<td align='left'> $producto <br/>(" . $_SESSION['carro'][$pos]['name'] . ")</td>";

                            echo "<td align='center'> 12 meses";
//                            echo "<form id=form" . $pos . " name=form" . $pos . " method=post>";
//                            $array = array(
//                                '1' => '1 mes',
//                                '3' => '3 meses',
//                                '6' => '6 meses',
//                                '12' => '12 meses');
//                            echo createRadio('combo', $array, '12', $pos, $precio);
//                            echo "</form>
                            echo "</td>";

                            echo "<td align='center'>";
                            //echo "<a href='editar.php?pos=$pos'><img src='images/carro/edit.png' alt='Editar' title='Editar'/></a></td>";
                            echo "<td align='center'>";
                            
                            ?>
                            
                            <form method="post" action="ajax/a_cart.php?idioma=<?php echo $idiomaActual ?>&idprod=<?php echo $_SESSION["carro"][$pos]["id"] ?>&action=removeProd&pos=<?php echo $pos ?>" id="form">
                            <input type="image" src="images/carro/eliminar.png" alt="Reducir cantidad" onclick="$(this).closest('form').submit()" title='Eliminar'></input></td>
                            </form>
                            
                            <?php
                            echo "<td align='right'> = </td>";

                            //echo "<td align='right' style='margin-left:10px'>" . $txt_moneda . number_format($coste, 2);
                            echo "<td align='right' style='margin-left:10px'><div id='plazo" . $pos . "'> " . $txt_moneda . number_format($coste, 0, '', '.') . "</div></td>";
                            echo "</tr>";
                        }
                        echo "<tr><td colspan='6'><hr></td></tr>";
                        echo "<tr>";
                        echo "<td align='right' colspan='5'><b><br>$txt_carritotot = </b></td>";
                        //echo "<td align='right'><b><br>" . $txt_moneda . number_format($totalcoste, 2) . " </b></td>";
                        echo "<td align='right'><b><br><div id='plazototal'>" . $txt_moneda . number_format($totalcoste, 0, '', '.') . " </div></b></td>";

                        echo "</tr>";
                        //BOTON COMPRAR
                        echo "<tr>";
                        echo "<td colspan='6'>";

                        //INSERTAR DEV_PROD

                        echo '<FORM ACTION = "insert_devproducts.php" METHOD = "POST">';
                        echo "<input type='image' img src='images/logo_balance.jpg' align='right'>";
						echo '<tr>';
						echo "<td colspan='6' align='right'>";
						echo '<table cellpadding="0" Cellspacing="0">';
                      	echo '<tr>';
                        echo '<td class="btn_vermas" width="120">Pagamento</td>';
                        echo  '<td valign="middle" width="27"><input type="image" src="images/Pay.png"</input></td> ';
                        echo '</tr>';
                    	echo 	'</table>';
						echo '</td>';
						echo '</tr>';
						
						
                        echo '</FORM>';

                        echo "</table>";
                    } else
                        echo $txt_carritovacio . "<br></br>";

                    //Campos que nos serviran para informar la cesta de lo que llevamos comprados y que se mostrar? en 
                    //la p?gina PRODUCTOS.


                    if ($xTotal == 0) {
                        echo $txt_carritovacio . "<br></br>";
                        echo '<SCRIPT LANGUAGE="javascript">';
                        echo 'location.href = "index.php"';
                        echo '</SCRIPT>';
                    }
                    ?>
                    <table cellpadding="0" Cellspacing="0">
                        <tr>
                        	<td class="btn_vermas" width='120'><a href="index.php"><?php echo 'Comprar mais' ?> </a></td>
                            <td valign="middle" width='27'><input type="image" src="images/comprarmas.png" onclick="history.go(-1)"></input></td> 
                        </tr>
                    </table>
                </div> <!--termina contenido-->
                
                <div id="resultado"></div>

            </div> <!--termina main-->


            <!-- seccion inc footer -->
            <?php include("includes/footer-inc.php"); ?>
            <!-- termina inc footer -->

        </div> <!--termina contenedor-->

        <!--scripts-->


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
            }-->
        
        <!-- Ajax envio submit-->
        <script type="text/javascript">
            $(document).ready(function() {
                $().ajaxStart(function() {
                    $('#loading').show();
                    $('#resultado').hide();
                }).ajaxStop(function() {
                    $('#loading').hide();
                    $('#resultado').fadeIn('slow');
                });
                $('#form, #fat, #fo3').submit(function() {
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function(data) {
                            $('#resultado').html(data);
                        }
                    })
        
                    return false;
                }); 
            })  
        </script>
        <!--Ajax envio submit-->

    </body>
</html>