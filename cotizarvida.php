<?php
require_once('calendar/classes/tc_calendar.php');

include("includes/init-inc.php");
// A partir de aquí ponemos el código de 
// la página en lenguaje HTML
$_SESSION["cotizar"]['prod'] = $_GET['idprod'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

        <title>Tuavenida.com</title>

        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/shadowbox.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="http://globalmoneyinput.googlecode.com/svn/trunk/lib/glob/jquery.glob.js" type="text/javascript"></script> 
        <script src="http://globalmoneyinput.googlecode.com/svn/trunk/lib/glob/globinfo/jQuery.glob.es-CO.js" type="text/javascript"></script> 
        <script src="http://globalmoneyinput.googlecode.com/svn/trunk/jquery.GlobalMoneyInput.js" type="text/javascript"></script> 

        <script type="text/javascript" src="calendar/calendar.js"></script>
        <script type="text/javascript" src="js/formToWizard.js"></script>

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

        <!--Currency-->
        <script type="text/javascript">
            $(function($){
                var cfgCulture = 'es-CO';
                $.preferCulture(cfgCulture);
                $('#valor').maskMoney();
            });
        </script>

        <!--Currency-->

        <script type="text/javascript">var _siteRoot='index.html',_root='index.html';</script>

        <link rel="stylesheet" href="css/main.css" type="text/css" />
        <link rel="stylesheet" href="css/menu.css" type="text/css" />
        <link rel="stylesheet" href="css/slider.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/shadowbox.css" type="text/css" />
        <link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
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

                    <form method="post" action="calcularvida.php?idioma=<?php echo $idiomaActual ?>" id="form">

                        <fieldset>
                            <legend><?php echo $txt_cotizar_titulo ?></legend>
                            <label for="Fecha"><?php echo $txt_cotizar_edad ?></label>
                            <?php
                            //$myCalendar = new tc_calendar("date5", true, false);
                            $myCalendar = new tc_calendar("date1", true,false);
                            $myCalendar->setIcon("calendar/images/iconCalendar.gif");
                            //$myCalendar->setDate(date('d'), date('m'), date('Y'));
                            $myCalendar->setPath("calendar/");
                            $myCalendar->setYearInterval(1942, 1998);
                            $fecha = date('Y-m-d');
                            $years = 70;
                            $myCalendar->dateAllow(date("Y-m-d", strtotime("$fecha-$years years")), date("Y-m-d", strtotime("$fecha-14 years")));
                            $myCalendar->setDate(date('d'), date('m'), date('1998'));
                            $myCalendar->setAlignment('left', 'bottom');
                            $myCalendar->writeScript();
                            ?>
                            <br/>


                            

                        </fieldset>
                        <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="btn_vermas" width='90'><input type="submit" value="<?php echo $txt_cotizar_boton_calcular ?> " class="text_button"></input></td>
                                    <td valign="middle"><input type="image" src="images/btn_quote.png" onclick="$(this).closest('form').submit()"></input></td> 
                                </tr>
                            </table>
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

    </body>
</html>