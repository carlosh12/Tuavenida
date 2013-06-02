<?php
include("includes/init-inc.php");
// A partir de aquí ponemos el código de 
// la página en lenguaje HTML
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

        <title><?php echo $txt_recuperar_titulo_web ?></title>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/shadowbox.js"></script>
        
         <!-- Ajax envio submit-->
        <script type="text/javascript">
            $(document).ready(function() {
           /*     $().ajaxStart(function() {
                 $('#loading').show();
                    $('#result').hide();
                }).ajaxStop(function() {
                    $('#loading').hide();
                    $('#result').fadeIn('slow');
                });*/
                $("#form").submit(function() {
                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        beforeSend:function(){
                            if($("#mail").val().indexOf('@', 0) == -1 || $("#mail").val().indexOf('.', 0) == -1) {  
                               $(".result").hide();
                               $("#mail").focus();
                               $('#mensajemail').fadeIn("slow");
                               $('#mensajemail').html("<?php echo $txt_recuperar_mail_mail_invalido?>");
                            return false;  } 
                        },
                        success: function(data) {
                             if (data.exito==1)
                                   {
                                       var html;
                                       html="<?php echo $txt_recuperar_mail_enviado_a?><br>";
                                       html+=$("#mail").val();
                                       html+="<br><a href='login.php'><?php echo $txt_login ?></a>"
                                    $('#mensajemail').fadeIn("slow");
                                    $('#mensajemail').html(html);
                                   }
                            if (data.exito==0){
                                 $("#mail").focus();
                                 $('#mensajemail').fadeIn("slow");
                                 $('#mensajemail').html("<?php echo $txt_recuperar_mail_correo_no_existe ?>");
                             }      
                        }
                    }
                )
               return false;
                }); 
            });  
        </script>
        <!--Ajax envio submit-->

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
                    <?php  include("includes/header-inc.php"); ?>
            <!-- termina inc header -->

            <div id="login">
                
                <form method="post" action="recuperar_mail.php" id="form" name="form">
                    <p>&nbsp;</p>
                    <table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td height="48" colspan="4" align="top"><h1><?php echo $txt_recuperar_recuperar_contrasena ?></h1></td>
                        </tr>

                        <tr>
                            <td width="199" align="right"> <?php echo $txt_email ?>: </td>
                            <td colspan="2" align="left"><input tabindex="1" name="mail" id="mail" type="text" onkeypress="return aceptatodo(event)" /></td>
                            <td width="157"><span id="mensajemail" class="result"></span></td>
                        </tr>
                        
                        <tr>
                            <td>&nbsp;</td>
                            <td class="btn_vermas" width="90" height="27"><?php echo $txt_recuperar ?></td>
                            <td width="194" valign="middle">
                            <input type="image" src="images/btn_vermas_2.png" onclick="$(this).closest('form').submit()"></input>
                            </td>
                            <td class="errorlogin" align="left">
                                <span id="result"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" align="center"><img src="images/separador_body_home_top.png" alt="" width="298" height="2" /></td>
                        </tr>
                        <tr>
                            <td height="38">&nbsp;</td>
                            <td colspan="2"> <?php echo $txt_recuperar_no_cuenta_aun ?> <a href="registro.php"><?php echo $txt_recuperar_registrar ?></a></td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </form>
                
               
            </div>

            <!-- seccion inc footer -->
               <?php  include("includes/footer-inc.php"); ?>
            <!-- termina inc footer -->
            
        </div> <!--termina contenedor-->

        <!-- shadowbox idioma -->
        <script type="text/javascript">
                     
          function aceptatodo(e) { // 1
                $(".result").hide();
            }         

        </script>
        <!-- shadowbox idioma -->
    </body>
</html>


