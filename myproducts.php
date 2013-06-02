<?php
include("includes/init-inc.php");
// A partir de aquí ponemos el código de 
// la página en lenguaje HTML

$_SESSION['url'] = $_SERVER['REQUEST_URI'];

if (!isset($_SESSION["user"]["id"])) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/Tuavenida/login.php?idioma=" . $idiomaActual);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

        <title><?php echo $txt_myproducts_titulo_web ?></title>

        <script type="text/javascript" src="js/jquery-1.6.min.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/shadowbox.js"></script>
        <script type="text/javascript" src="js/jquery.validationEngine.js" charset="utf-8"></script>

        <script type="text/javascript">var _siteRoot='index.html',_root='index.html';</script>

        <link rel="stylesheet" href="css/main.css" type="text/css" />
        <link rel="stylesheet" href="css/menu.css" type="text/css" />
        <link rel="stylesheet" href="css/slider.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/shadowbox.css" type="text/css" />


        <script type="text/javascript">
            $(document).ready(function(){
                
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
            
           
                $("#mostrar_perfil").click(function(){
                    mostrar_perfil();
                });
            
                $(".detalle").click(function(e){
                    e.preventDefault();
                    $.post("includes/funciones.php",{funcion:'productosxid',id:$(this).attr('data')},function(data){
                        $("#contenido_carro").html(data);
                    });
                }); 
            
            });
            function mostrar_perfil(){
                $.ajax (
                {
                    url:"mostrar_perfil.php",
                    type:"post",
                    success:function(data){
                        $("#contenido_carro").html(data);
                    }
                });
            }
        </script>

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
                    <br/>
                    <p><?php echo $txt_myproducts_perfil ?></p>
                    <?php echo "<a id='mostrar_perfil' href='#'>" . $txt_editar . "</a>" ?>
                    <img src="images/separador_contenido.png" width="200" height="5" alt=""/>

                    <p><?php echo $txt_myproducts_productos ?></p>
                    <?php productosxusuario($_SESSION["user"]["id"],$idiomaActual); ?>

                </div>
                <div id="separador">
                </div>

                <div id="contenido_top">

                    <table width="100%" border="0" cellpadding="0" cellspacing="0">

                        <tr>
                            <td><h1><?php echo $txt_myproducts_mi_cuenta ?></h1></td>
                        </tr>
                        <tr>
                            <td><h2><?php echo $txt_myproducts_manejar_cuenta ?></h2></td>
                        </tr>
                        <tr>
                            <td><img src="images/separador_contenido.png" alt=""/></td>
                        </tr>
                    </table>

                </div>

                <div id="contenido_carro">

                    <?php
                    $sql = "select * from usuarios where id = '{$_SESSION["user"]["id"]}'";
                    $res = mysql_query($sql) or die(mysql_error());

                    $num_total_registros = mysql_num_rows($res);
                    if ($num_total_registros > 0) {

                        while ($fila = mysql_fetch_assoc($res)) {
                            ?>    
                            <form id="form" name="form" method="post" action="update_profile.php?idioma=' <?php echo $idiomaActual ?>'">
                                <fieldset>
                                    <legend><?php echo $txt_editar_perfil ?></legend>
                                    <table  width ="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td><p><?php echo $txt_nombre ?></p></td>
                                            <td colspan="2"><input id="name" type="text" name="name"  maxlength="50" onkeypress=" return validart(event)" class="validate[required,custom[onlyLetter]]" value= "<?php echo $fila['nombres'] ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td><p><?php echo $txt_apellido ?></p></td>
                                            <td colspan="2"><input id="apellido" type="text" name="apellido"  maxlength="50" onkeypress=" return validart(event)" class="validate[required,custom[onlyLetter]]" value="<?php echo $fila['apellidos'] ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td><p><?php echo $txt_telefono ?></p></td>
                                            <td colspan="2"><input id="telefono" type="text" name="telefono" maxlength="11" onkeypress=" return validarn(event)" class="validate[required,custom[telephone]]" value="<?php echo $fila['telefono'] ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td><p><?php echo $txt_email ?></p></td>
                                            <td colspan="2"><input id="e-mail" type="text" name="email" onkeypress=" return aceptatodo(event)" class="validate[required,custom[email]] text-input" value="<?php echo $fila['email'] ?>"/></td>
                                        </tr>
                                        <tr>
                                        	<tr>
                                    		<td class="btn_vermas" width='90'><input type="submit" value="<?php echo $txt_editar ?> " class="text_button"></input></td>
                                    		<td valign="middle"><input type="image" src="images/btn_vermas_2.png" onclick="$(this).closest('form').submit()"></input></td> 
                                			</tr>
                                        </tr>
                                    </table>
                                </fieldset>
                            </form>
                            <?php
                        }
                    }
                    ?>

                    <div id="resultado"></div>
                </div>

                <!-- seccion inc footer -->
                <?php include("includes/footer-inc.php"); ?>
                <!-- termina inc footer -->

            </div> <!--termina contenedor-->
        </div>
    </body>
</html>