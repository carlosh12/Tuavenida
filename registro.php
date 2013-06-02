<?php
include("includes/init-inc.php");
// A partir de aquí ponemos el código de 
// la página en lenguaje HTML
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

        <title><?php echo $txt_registro_titulo_web ?></title>

        <script type="text/javascript" src="js/jquery-1.6.min.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/shadowbox.js"></script>
        <script type="text/javascript" src="calendar/calendar.js"></script>

        <!-- Ajax envio submit-->
        <script type="text/javascript">
            $(document).ready(function() {
                $().ajaxStart(function() {
                    $('#loading').show();
                    $('#error').hide();
                }).ajaxStop(function() {
                    $('#loading').hide();
                    $('#error').fadeIn('slow');
                });
                $('#formID').submit(function() {
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function(data) {
                            $('#error').html(data);
                        }
                    })
                    return false;
                }); 
            })  
        </script>
        
        <!--Ajax envio submit-->

        <!--Validar formularios-->
        <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
        <?php echo '<script src="js/languages/jquery.validationEngine-' . $idiomaActual . '.js" type="text/javascript"></script> '; ?>
        <script src="js/jquery.validationEngine.js" type="text/javascript"></script>

        <script type="text/javascript">	
            $(document).ready(function() {
                $("#formID").validationEngine()
                //$("#formID").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) })
            });
                
		
        </script>	

        <!--Validar formularios-->                     

        <script type="text/javascript">var _siteRoot='index.html',_root='index.html';</script>

        <link rel="stylesheet" href="css/main.css" type="text/css" />
        <link rel="stylesheet" href="css/menu.css" type="text/css" />
        <link rel="stylesheet" href="css/slider.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/shadowbox.css" type="text/css" />
        <link rel="Shortcut Icon" href="images/favicon.ico" type="image/x-icon" />

    </head>
    <body>

        <div id="contenedor">

            <!-- seccion inc header -->
            <?php include("includes/header-inc.php"); ?>
            <!-- termina inc header -->

            <div id="registro">
                <form method="post" action="s_registro.php?idioma=<?php echo $idiomaActual ?>" id="formID">

                    <h1><?php echo $txt_registro_titulo ?></h1>

                    <div>
                        <label for="nombre"><?php echo $txt_nombre ?></label>
                        <input value=""  tabindex="1" type="text" name="nombre" id="nombre" class="validate[required,custom[onlyLetterSp]]" />
                    </div>

                    <div>
                        <label for="apellido"><?php echo $txt_apellido ?></label>
                        <input value="" tabindex="2" type="text" name="apellido" id="apellido" class="validate[required,custom[onlyLetterSp]]" />
                    </div>

                    <div>
                        <label for="email"><?php echo $txt_email ?></label>
                        <input value="" type="text" tabindex="7" name="email" id="email" class="validate[required,custom[email],ajax[ajaxUserCallPhp]] text-input"/>
                    </div>

                    <div>
                        <label for="password"><?php echo $txt_password ?></label>
                        <input tabindex="10" name="password" id="password" class="validate[required] text-input" type="password" />
                    </div>

                    <div>
                        <label for="nombre"><?php echo $txt_rpassword ?></label>
                        <input tabindex="11" name="password2" id="password2" class="validate[required,equals[password]] text-input" type="password" />
                    </div>

                    <div>
                        <input name="suscribir" type="checkbox" id="suscribir" checked="checked" /><?php echo $txt_novedades ?>
                    </div>

                    <div>
                        <span class="terminos"> <?php echo $txt_terminos ?></span>
                        <img src="images/separador_body_home_top.png" alt="" width="298" height="2" />
                    </div>

                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width ="90" class="btn_vermas" ><input type="submit" value="<?php echo $txt_registro_crear ?>" class="text_button"></input></td>
                            <td><input type="image" src="images/btn_vermas_2.png" onclick="$(this).closest('formID').submit()"></input></td>
                            <td><span id="error"></span></td>
                        </tr>
                    </table>

                </form>
            </div>     

            <!-- seccion inc footer -->
            <?php include("includes/footer-inc.php"); ?>
            <!-- termina inc footer -->

        </div> <!--termina contenedor-->

    </body>
</html>


