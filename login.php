<?php
include("includes/init-inc.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

        <title>Tuavenida.com</title>

        <script type="text/javascript" src="js/jquery-1.6.min.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/shadowbox.js"></script>
        <script type="text/javascript" src="js/jquery.validationEngine.js" charset="utf-8"></script>

        <!--Validar formularios-->
       <?php echo '<script src="js/languages/jquery.validationEngine-' . $idiomaActual . '.js" type="text/javascript"></script> '; ?>

        <script>
		jQuery(document).ready(function(){
			jQuery("#formID").validationEngine();
			//$("#formID").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) })
		});
	</script>
        
        <!--Validar formularios-->

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
        
        <script type="text/javascript">var _siteRoot='index.html',_root='index.html';</script>

        <link rel="stylesheet" href="css/main.css" type="text/css" />
        <link rel="stylesheet" href="css/menu.css" type="text/css" />
        <link rel="stylesheet" href="css/slider.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/shadowbox.css" type="text/css" />
        <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
        <link rel="Shortcut Icon" href="images/favicon.ico" type="image/x-icon" />
    </head>
    <body>
        

        <div id="contenedor">

            <!-- seccion inc header -->
            <?php include("includes/header-inc.php"); ?>
            <!-- termina inc header -->

            <div id="login">

                <form method="post" action="validar_usuario.php" id="formID">

                    <h1><?php echo $txt_login_titulo ?></h1>

                    <div>
                        <label for="email"><?php echo $txt_email ?></label>
                        <input id="email" name="email" type="text" class="validate[required,custom[email],maxSize[50]] text-input"/>
                    </div>

                    <div>
                        <label for="pass1"><?php echo $txt_password ?></label>
                        <input id="pass1" name="pass1" type="password"  class="validate[required,maxSize[20]] text-input"/>
                    </div> 

                    <div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="btn_vermas" width='90'><input type="submit" value="<?php echo $txt_login ?>" class="text_button"></input></td>
                                <td><input type="image" src="images/btn_vermas_2.png" onclick="$(this).closest('formID').submit()"></input></td>
                                <td><span id="error"></span></td>
                            </tr>
                        </table> 
                    </div>

                    <div>
                        <img src="images/separador_body_home_top.png" alt="" width="290" height="2" />
                        <p><?php echo $txt_login_nocuenta ?><a href="registro.php"><?php echo $txt_login_registro ?></a></p>
                        <p><a href="recuperar.php?idioma=<?php echo $idiomaActual ?>"><?php echo $txt_login_recuperar ?></a></p>
                    </div>

                </form>


            </div>

            <!-- seccion inc footer -->
            <?php include("includes/footer-inc.php"); ?>
            <!-- termina inc footer -->

        </div> <!--termina contenedor-->
    </body>
</html>

