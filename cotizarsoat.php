<?php
require_once('calendar/classes/tc_calendar.php');

include("includes/init-inc.php");
// A partir de aquí ponemos el código de 
// la página en lenguaje HTML
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

        <title>Soat en linea Tuavenida.com</title>

        <script type="text/javascript" src="js/jquery-1.6.min.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/shadowbox.js"></script>
        <script type="text/javascript" src="js/jquery.jCombo.js"></script>
        <script type="text/javascript" src="calendar/calendar.js"></script>

        <script type="text/javascript">
            function applyFormatCurrency(sender) {

                $(sender).formatCurrency({
                    region: 'pt-BR'
                    , roundToDecimalPlace: -1
                });
            
            }
        </script> 

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
                $('#form').submit(function() {
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

        <!--Ajax carga combos-->
        <script type="text/javascript">
            $(function() {
                $("#list1").jCombo("soat/getClases.php");
                $("#list2").jCombo("soat/getSubtipo.php?id=", { 
                    parent: "#list1"
                });
                $("#list3").jCombo("soat/getEdad.php?id=", { 
                    parent: "#list2"
                },"?clase=",{
                    parent:"#list1"
                });
            });
        </script>
        <!--Ajax carga combos-->

        <!--Validar formularios-->
        <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
        <?php echo '<script src="js/languages/jquery.validationEngine-' . $idiomaActual . '.js" type="text/javascript"></script> '; ?>
        <script src="js/jquery.validationEngine.js" type="text/javascript"></script>

        <script type="text/javascript">	
            $(document).ready(function() {
                $("#form").validationEngine()
                //$("#form").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) })
            });
                
		
        </script>	 	

        <!--Validar formularios-->

        <script type="text/javascript">var _siteRoot='index.html',_root='index.html';</script>

        <link rel="stylesheet" href="css/main.css" type="text/css" />
        <link rel="stylesheet" href="css/menu.css" type="text/css" />
        <link rel="stylesheet" href="css/slider.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/shadowbox.css" type="text/css" />
        <link rel="stylesheet" href="calendar/calendar.css" type="text/css" />
        <link rel="Shortcut Icon" href="images/favicon.ico" type="image/x-icon" />

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
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td colspan="3" align="left"><img src="images/progess/paso2.png" alt=""/></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>  
                        </tr>
                        <tr>
                            <td colspan="3"><h1> <?php echo read("productos", "id", $idprod, "producto") ?> </h1></td>
                        </tr>
                        <tr>
                            <td colspan="3"><h2><?php echo read("productos", "id", $idprod, "descripcion2") ?></h2></td>
                        </tr>
                        <tr>
                            <td colspan="3"><img src="images/separador_contenido.png" alt=""/></td>
                        </tr>
                    </table>

                </div>

                <div id="contenido">

                    <form name="form" id="form" method="post" action="calcularsoat.php?idioma=<?php echo $idiomaActual ?>&idprod=<?php echo $idprod ?>" >
                        <fieldset>
                            <legend>Cotizar su SOAT en linea</legend>
                            <label for="clase">Clase de vehículo</label>
                            <select name="list1" id="list1" class="validate[required]"></select> 
                            <label for="subtipo">Subtipo</label>
                            <select name="list2" id="list2" class="validate[required]"></select>
                            <label for="edad">Edad</label>
                            <select name="list3" id="list3" class="validate[required]"></select>

                            <br/>
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="btn_vermas" width='90'><input type="submit" value="<?php echo $txt_cotizar_boton_calcular ?> " class="text_button"></input></td>
                                    <td valign="middle"><input type="image" src="images/btn_quote.png" onclick="$(this).closest('form').submit()"></input></td> 
                                </tr>
                            </table>
                        </fieldset>
                    </form>

                </div>
                <div id="contenido_right">
                    <div class="contenido_right_img">
                        <img src="images/productos/car_insurance_b.png" alt=""/>
                    </div>

                    <div id="resultado"></div>

                </div>

            </div> <!--termina main-->

            <!-- seccion inc footer -->
            <?php include("includes/footer-inc.php"); ?>
            <!-- termina inc footer -->

        </div> <!--termina contenedor-->
        <!-- Validar numeros -->
        <script type="text/javascript">
            function validarn(e) { // 1
                tecla = (document.all) ? e.keyCode : e.which; // 2
                if (tecla==8) return true; // 3
                patron = /\d/; // 4
                te = String.fromCharCode(tecla); // 5
                return patron.test(te); // 6
            } 
        </script>
        <!-- Validar campos -->

    </body>
</html>