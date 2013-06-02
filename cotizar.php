<?php
require_once('calendar/classes/tc_calendar.php');

include("includes/init-inc.php");
// A partir de aquí ponemos el código de 
// la página en lenguaje HTML
$_SESSION["cotizar"]['prod'] = $_GET['idprod'];
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

        <title>Tuavenida.com</title>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="css/main.css" type="text/css" />
        <link rel="stylesheet" href="css/menu.css" type="text/css" />
        <link rel="stylesheet" href="css/slider.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/shadowbox.css" type="text/css" />
        <link rel="Shortcut Icon" href="images/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
        
        <script type="text/javascript" src="js/jquery-1.6.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/shadowbox.js"></script>
        <script type="text/javascript" src="js/jquery.validationEngine.js" charset="utf-8"></script>   
        <script src="http://globalmoneyinput.googlecode.com/svn/trunk/lib/glob/jquery.glob.js" type="text/javascript"></script> 
        <script src="http://globalmoneyinput.googlecode.com/svn/trunk/lib/glob/globinfo/jQuery.glob.pt-BR.js" type="text/javascript"></script> 
        <script src="http://globalmoneyinput.googlecode.com/svn/trunk/jquery.GlobalMoneyInput.js" type="text/javascript"></script> 
        
         <!--Validar formularios-->
       <?php echo '<script src="js/languages/jquery.validationEngine-' . $idiomaActual . '.js" type="text/javascript"></script> '; ?>

        <script>
		jQuery(document).ready(function(){
			jQuery("#formID").validationEngine();
			//$("#formID").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) })
		});
	</script>
        
        <!--Validar formularios-->

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
                    <table width="100%" border="0" cellpadding="0"  cellspacing="0">
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

                    <form method="post" action="envio.php?idioma=<?php echo $idiomaActual ?>" id="formID">

                        <fieldset>
                            <legend><?php echo $txt_cotizar_titulo ?></legend>
                            <label for="Fecha"><?php echo $txt_cotizar_fecha ?></label>
                            
                            <input type="text" id="datepicker" name="date1" value="<?php echo date("Y/m/d");  ?>" class="validate[required,custom[date]] text-input"/>
                            
                            <br/>
                            <label for="Tipo"><?php echo $txt_cotizar_tipo ?></label>

                            <select id="tipo" name="tipo">
                                <?php cargarprodseg() ?>
                            </select>
                            
                            <label for="valorx"><?php echo $txt_cotizar_valor_factura ?></label>
                            <input type="text" name="valor" id="valor" class="validate[required] text-input"/>

                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="btn_vermas" width='90'><input type="submit" value="<?php echo $txt_cotizar_boton_calcular ?> " class="text_button"></input></td>
                                    <td valign="middle"><input type="image" src="images/btn_quote.png" onclick="$(this).closest('form').submit()"></input></td> 
                                </tr>
                            </table>

                        </fieldset>
                    </form>      

                    <div class="terminos" ><?php echo $txt_cotizar_terminos ?></div>


                </div>
                <div id="contenido_right">
                    <div class="contenido_right_img">
                        <img src="<?php read("productos", "id", $idprod, "img_descrip"); ?>" width="200px" heigth="207px" alt=""/>
                    </div>

                    <div id="resultado"></div>

                </div>

            </div> <!--termina main-->

            <!-- seccion inc footer -->
            <?php include("includes/footer-inc.php"); ?>
            <!-- termina inc footer -->

        </div> <!--termina contenedor-->    
               
         <script>
		$(function() {
			 $.datepicker.regional['pt-BR'] = {
                closeText: 'Fechar',
                prevText: '&#x3c;Anterior',
                nextText: 'Pr&oacute;ximo&#x3e;',
                currentText: 'Hoje',
                monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',
                'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
                'Jul','Ago','Set','Out','Nov','Dez'],
                dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
                dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
                weekHeader: 'Sm',
                dateFormat: 'yy/mm/dd',
                firstDay: 0,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''};
        $.datepicker.setDefaults($.datepicker.regional['pt-BR']);

		$( "#datepicker" ).datepicker(
			{
			changeMonth: true,
			changeYear: true,
			minDate: "-2Y", maxDate: 0
			}			
			);

		});
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
                $('#formID, #fat, #fo3').submit(function() {
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

        <!--Currency-->
        <script type="text/javascript">
            $(function($){
                var cfgCulture = 'pt-BR';
                $.preferCulture(cfgCulture);
                $('#valor').maskMoney();
            });
        </script>

        <!--Currency-->

    </body>
</html>