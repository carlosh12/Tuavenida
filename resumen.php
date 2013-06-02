<?php

include("includes/init-inc.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

        <title><?php echo $txt_resumen_titulo_web ?></title>

        <link rel="stylesheet" href="css/main.css" type="text/css" />
        <link rel="stylesheet" href="css/menu.css" type="text/css" />
        <link rel="stylesheet" href="css/slider.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/shadowbox.css" type="text/css" />
        <link href="calendar/calendar.css" rel="stylesheet" type="text/css" />

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/shadowbox.js"></script>

        <script type="text/javascript" src="calendar/calendar.js"></script>

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

                    <table width="100%" border="0" height="80%"  cellpadding="0" cellspacing="0">

                        <tr>
                            <td><h1><?php echo $txt_resumen_resumen_pedido ?></h1></td>
                        </tr>
                        <tr>
                            <td ><h2><?php echo $txt_resumen_verificar_datos ?></h2></td>
                        </tr>
                        <tr>
                            <td ><img src="images/separador_contenido.png" alt=""/></td>
                        </tr>
                    </table>

                </div>

                <div id="contenido_carro">

                    <?php
                    if ((isset($_GET['action'])) && (isset($_GET['pos']))) {
                        $pos = $_GET['pos'];
                        echo "<form method='post' action='ajax/a_cart.php?idioma=$idiomaActual&action=edit&pos=$pos' id='form'>";
                    }else
                        echo "<form method='post' action='ajax/a_cart.php?idioma=$idiomaActual&idprod=$idprod&action=add' id='form'>";
                    ?>

                    <table width="80%" border="0" cellpadding="0" cellspacing="0" align="center">
                        <tr>
                            <!--<td width='60'><a href="javascript:window.print();"><?php echo $txt_resumen_boton_imprimir ?> </a></td>-->
                            <td colspan="6" valign="middle" align="left"><input type="image" src="images/printer.png" alt="<?php echo $txt_resumen_boton_imprimir ?>" onclick="window.print()"></input></td> 
                        </tr>
                        <tr>
                            <td colspan="3" width="231" align="right" ><?php echo $txt_resumen_datos_compra ?></td>
                            <td colspan="3" align="left"><?php echo $_SESSION['cotizar']['datecompra'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><?php echo $txt_resumen_fecha_factura ?>: </td>
                            <td colspan="3" align="left"><?php echo $_SESSION['cotizar']['datefactura'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><?php echo $txt_descripcion ?>: </td>
                            <td colspan="3" align="left"><?php echo $_SESSION['cotizar']['descrip'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><?php echo $txt_detalle_notafiscal ?>: </td>
                            <td colspan="3" align="left"><?php echo $_SESSION['cotizar']['notafiscal'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><?php echo $txt_resumen_tipo_dispositivo ?></td>
                            <td colspan="3" align="left"><?php echo $_SESSION['cotizar']['tipo'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><?php echo $txt_resumen_valor_factura ?></td>
                            <td colspan="3" align="left"><?php echo $txt_moneda . $_SESSION['cotizar']['valor'] ?></td>
                        </tr>
<!--                        <tr>
                            <td  align="right">Quantia a ser paga </td>
                            <td  align="left"><?php echo "desde solo " . $txt_moneda . number_format($_SESSION['cotizar']['prima'] / 13, 3) ?></td>
                        </tr>-->
                        <tr>
                            <td colspan="3" align="right"><?php echo $txt_nombre_completo ?>: </td>
                            <td colspan="3" align="left" ><?php echo $_SESSION['cotizar']['name'] . ' ' . $_SESSION['cotizar']['apellido'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><?php echo $txt_direccion_completa ?>: </td>
                            <td colspan="3" align="left"><?php echo $_SESSION['cotizar']['direccion'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><?php echo $txt_barrio ?>: </td>
                            <td colspan="3" align="left"><?php echo $_SESSION['cotizar']['barrio']  ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><?php echo $txt_ciudad ?>: </td>
                            <td colspan="3" align="left"><?php echo $_SESSION['cotizar']['ciudad'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><?php echo $txt_estado ?>: </td>
                            <td colspan="3" align="left"><?php echo $_SESSION['cotizar']['estado'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><?php echo $txt_resumen_cep ?>: </td>
                            <td colspan="3" align="left"><?php echo $_SESSION['cotizar']['cep'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><?php echo $txt_resumen_id ?>: </td>
                            <td colspan="3" align="left"><?php echo $_SESSION['cotizar']['cpf'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><?php echo $txt_telefono ?>: </td>
                            <td colspan="3" align="left"><?php echo $_SESSION['cotizar']['telefono'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><?php echo $txt_email ?>: </td>
                            <td colspan="3" align="left"><?php echo $_SESSION['cotizar']['email'] ?></td>
                        </tr>

                        <tr>
                            <td colspan="6" align="center"><img src="images/separador_body_home_top.png" alt="" width="298" height="2" readonly="true" /></td>
                        </tr>
                        <tr>
                            <td valign="middle" width='27'><input type="image" src="images/btn_previous.png" onclick="history.go(-1)"></input></td> 
                            <td class="btn_vermas" width='90'><a href="javascript:history.go(-1)"><?php echo $txt_resumen_boton_volver ?> </a></td>
                            <td width='110'>&nbsp;</td>
                            <td>&nbsp;</td>


                            <td class="btn_vermas" width='90'><input type="submit" value="<?php echo $txt_resumen_boton_contratar ?> " class="text_button"></input></td>
                            <td valign="middle" width='27'><input type="image" src="images/btn_quote.png" onclick="$(this).closest('form').submit()"></input></td> 

                        </tr>

                    </table>
                    </form>
                </div>

                <div id="resultado"></div>

            </div> <!--termina main-->

            <!-- seccion inc footer -->
<?php include("includes/footer-inc.php"); ?>
            <!-- termina inc footer -->

        </div> <!--termina contenedor-->

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