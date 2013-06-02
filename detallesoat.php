<?php
ob_start();
require_once('calendar/classes/tc_calendar.php');
include("includes/init-inc.php");
// A partir de aquí ponemos el código de 
// la página en lenguaje HTML
//$_SESSION['url'] = $_SERVER['REQUEST_URI'];
//if (!isset($_SESSION["user"]["id"])) {
//    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/Tuavenida/login.php?idioma=" . $idiomaActual);
//}
ob_flush();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

        <title><?php echo $txt_detalle_titulo_web ?></title>

        <script type="text/javascript" src="js/jquery-1.6.min.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/shadowbox.js"></script>

        <script type="text/javascript" src="calendar/calendar.js"></script>         

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
        <link href="calendar/calendar.css" rel="stylesheet" type="text/css" />

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
                            <td colspan="3" align="left"><img src="images/progess/paso2.png" alt=""/></td>
                        </tr>

                        <tr>
                            <td colspan="3">&nbsp;</td>  
                        </tr>
                        <tr>
                            <td height="31" colspan="3"><h1>COTIZAR SOAT EN LINEA</h1></td>
                        </tr>
                        <tr>
                            <td height="31" colspan="3"><h2>Por favor ingrese los datos del vehiculo a asegurar</h2></td>
                        </tr>
                        <tr>
                            <td height="31" colspan="3"><img src="images/separador_contenido.png" alt=""/></td>
                        </tr>
                    </table>

                </div>

                <div id="contenido">

                    <form id="form" method="post" action="resumensoat.php?idprod=<?php echo $idprod ?>" name="form">
                        <br/>

                        <fieldset id="x1">
                            <legend><?php echo $txt_detalle_informacion_personal ?></legend>
                            <table  width ="100%" border="0" cellpadding="0" cellspacing="0" >
                                <tr>
                                    <td width="40%"><p><?php echo $txt_nombre ?></p></td>
                                    <td><input id="Name" type="text" name="name"  maxlength="50" class="validate[required,custom[onlyLetterSp]]" value="<?php echo $_SESSION["user"]["nombre"] ?>" /></td>
                                </tr>
                                <tr>
                                    <td><p><?php echo $txt_apellido ?></p></td>
                                    <td><input id="Apellido" type="text" name="apellido"  maxlength="50" class="validate[required,custom[onlyLetterSp]]" value="<?php echo $_SESSION["user"]["apellido"] ?>" /></td>
                                </tr>
                                <tr>
                                    <td><p><?php echo $txt_telefono ?></p></td>
                                    <td><input id="telefono" type="text" name="telefono" maxlength="14" value="<?php echo $_SESSION["user"]["telefono"] ?>"/></td>
                                </tr>
                                <tr>
                                    <td><p><?php echo $txt_email ?></p></td>
                                    <td><input id="email" type="text" name="email" value="<?php echo $_SESSION["user"]["email"] ?>"/></td>
                                </tr>   
                                <tr>
                                    <td><p><?php echo $txt_direccion_completa ?></p></td>
                                    <td><input id="direccion" type="text" name="direccion" maxlength="50" onkeypress=" return aceptatodo(event)" class="validate[required,maxSize[50]]" value="<?php echo $_SESSION["user"]["direccion"] ?>"/></td>
                                </tr>
                                <tr>
                                    <td><p><?php echo $txt_detalle_cpf ?></p></td>
                                    <td><input id="cedula" type="text" name="cedula" maxlength="14" value="<?php echo $_SESSION["user"]["cedula"] ?>"/></td>
                                </tr>                                                                                                    
                            </table>

                        </fieldset>

                        <fieldset id="x2">
                            <legend><?php echo $txt_detalle_informacion_vehiculo ?></legend>

                            <table  width ="100%" border="0" cellpadding="0" cellspacing="0" >
                                <tr>
                                    <td width="40%"><p>Clase</p></td>
                                    <td><input id="clase" type="text" name="clase"  maxlength="50" value="<?php echo $_SESSION["cotizar"]['clase'] ?>" readonly /></td>
                                    <tr>
                                        <td width="40%"><p>Subclase</p></td>
                                        <td><input id="subclase" type="text" name="subclase"  maxlength="50" value="<?php echo $_SESSION["cotizar"]['subtipo'] ?>" readonly /></td>
                                    </tr>  
                                    <tr>
                                        <td width="40%"><p>Edad</p></td>
                                        <td><input id="edad" type="text" name="edad"  maxlength="50" value="<?php echo $_SESSION["cotizar"]['edad'] ?>" readonly /></td>
                                    </tr> 
                                    <tr>
                                        <td width="40%"><p>Modelo</p></td>
                                        <td><input id="modelo" type="text" name="modelo"  maxlength="50" class="validate[required]" value=""/></td>
                                    </tr> 
                                    <tr>
                                        <td width="40%"><p>Linea</p></td>
                                        <td><input id="linea" type="text" name="linea"  maxlength="50" class="validate[required]" value=""/></td>
                                    </tr> 
                                    <tr>
                                        <td width="40%"><p>Placa</p></td>
                                        <td><input id="placa" type="text" name="placa"  maxlength="8" class="validate[required]" value=""/></td>
                                    </tr> 
                                    <tr>
                                        <td width="40%"><p>Motor</p></td>
                                        <td><input id="motor" type="text" name="motor"  maxlength="50" class="validate[required]" value=""/></td>
                                    </tr> 
                                    <tr>
                                        <td width="40%"><p>Chasis</p></td>
                                        <td><input id="chasis" type="text" name="chasis"  maxlength="50" class="validate[required]" value=""/></td>
                                    </tr> 
                            </table>


                        </fieldset>

                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="btn_vermas" width='90'><input type="submit" value="<?php echo $txt_detalle_boton_contratar ?> " class="text_button"></input></td>
                                <td valign="middle"><input type="image" src="images/btn_vermas_2.png" onclick="$(this).closest('form').submit()"></input></td> 
                            </tr>
                        </table>
                    </form>
                </div>
                <div id="contenido_right">
                    <div class="contenido_right_img"></div>
                    <img src="images/productos/car_insurance_b.png" align="center" alt=""/>                    
                </div>



            </div> <!--termina main-->

            <!-- seccion inc footer -->
            <?php include("includes/footer-inc.php"); ?>
            <!-- termina inc footer -->

        </div> <!--termina contenedor-->


    </body>
</html>