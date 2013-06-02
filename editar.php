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

if(isset($_GET['pos']))
    $pos = $_GET['pos'];

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

        <!-- script select anidado de estados -->
        <script type="text/javascript">
            $(document).ready(function(){
                $("#estado").change(function(){
                    $.ajax({
                        url:"procesa_estado.php",
                        type: "POST",
                        data:"idestado="+$("#estado").val(),
                        success: function(opciones){
                            $("#ciudad").html(opciones);
                        }
                    });
                    
                });
                                
            });
        </script>
        <!-- script select anidado de estados -->

        <!-- script select sexo info adicional -->
        <script type="text/javascript">
            $(document).ready(function(){
                $("#sexo").change(function(){                   
                    if($('#sexo').val() == "Legal")
                    {                                              
                        //$("#iddocumento").html('<td><p><?php echo $txt_detalle_cnpj ?></p></td><td><input id="cnpj" type="text" name="cnpj" maxlength="18" class="validate[required,ajax[ajaxUserCallCnpj]] text-input" value="<?php echo $_SESSION["user"]["cedula"] ?>"/></td>');
                        $("#iddocumento").html('<td><p><?php echo $txt_detalle_cnpj ?></p></td><td><input id="cnpj" type="text" name="cnpj" maxlength="18" value="<?php echo $_SESSION["user"]["cedula"] ?>"/></td>');
                    }                                      
                    else
                    {
                        //$("#iddocumento").html('<td><p><?php echo $txt_detalle_cpf ?></p></td><td><input id="cpf" type="text" name="cpf" maxlength="14" class="validate[required,ajax[ajaxUserCallCpf]] text-input" value="<?php echo $_SESSION["user"]["cedula"] ?>"/></td>');
                        $("#iddocumento").html('<td><p><?php echo $txt_detalle_cpf ?></p></td><td><input id="cpf" type="text" name="cpf" maxlength="14" value="<?php echo $_SESSION["user"]["cedula"] ?>"/></td>');
                    }
                });
            });
        </script>
        <!-- script select sexo info adicional -->

        <!-- script CEP -->
        <script type="text/javascript">
            function buscar_cep () {
                $.ajax({
                    url:"readcep.php",
                    type: "POST",
                    data:"cep="+$("#cep").val(),
                    success: function(data) {
                        $('#completar').html(data);
                    }
                });                                   
            };
        </script>
        <!-- script CEP -->

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

        <!--Mascara cpf-->
        <script type="text/javascript">
            function FormataCpf(campo, teclapres)
            {
                var tecla = teclapres.keyCode;
                var vr = new String(campo.value);
                vr = vr.replace(".", "");
                vr = vr.replace("/", "");
                vr = vr.replace("-", "");
                tam = vr.length + 1;
                if (tecla != 14)
                {
                    if (tam == 4)
                        campo.value = vr.substr(0, 3) + '.';
                    if (tam == 7)
                        campo.value = vr.substr(0, 3) + '.' + vr.substr(3, 6) + '.';
                    if (tam == 11)
                        campo.value = vr.substr(0, 3) + '.' + vr.substr(3, 3) + '.' + vr.substr(7, 3) + '-' + vr.substr(11, 2);
                }
            }           
            
        </script>
        <!--Mascara cpf -->

        <!--Mascara cep -->
        <script type="text/javascript">
            function mascaraCEP(campocep)
            {
                var cep = campocep.value;
                if (cep.length == 5)
                {

                    cep = cep + '-';
                    document.form.cep.value = cep;
                    return true;
                   
                }
            }
        </script>
        <!--Mascara cep -->

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
                            <td colspan="3" align="left"><h1>Editar</h1></td>
                        </tr>

                        <tr>
                            <td colspan="3">&nbsp;</td>  
                        </tr>
                        <tr>
                            <td height="31" colspan="3"><h1> <?php echo readitem("productos", "id", $_SESSION['carro'][$pos]['id'], "producto") ?> </h1></td>
                        </tr>
                        <tr>
                            <td height="31" colspan="3"><h2><?php echo readitem("productos", "id", $_SESSION['carro'][$pos]['id'], "descripcion2") ?></h2></td>
                        </tr>
                        <tr>
                            <td height="31" colspan="3"><img src="images/separador_contenido.png" alt=""/></td>
                        </tr>
                    </table>

                </div>

                <div id="contenido">

                    <form id="form" method="post" action="ajax/a_resumen.php?action=edit&pos=<?php echo $pos?>" name="form">
                        <br/>

                        <fieldset id="x1">
                            <legend><?php echo $txt_detalle_informacion_personal ?></legend>
                            <table  width ="100%" border="0" cellpadding="0" cellspacing="0" >
                                <tr>
                                    <td width="40%"><p><?php echo $txt_nombre ?></p></td>
                                    <td><input id="Name" type="text" name="name"  maxlength="50" class="validate[required,custom[onlyLetterSp]]" value="<?php echo $_SESSION['carro'][$pos]['name'] ?>"/></td>
                                </tr>
                                <tr>
                                    <td><p><?php echo $txt_apellido ?></p></td>
                                    <td><input id="Apellido" type="text" name="apellido"  maxlength="50" class="validate[required,custom[onlyLetterSp]]" value="<?php echo $_SESSION['carro'][$pos]['apellido'] ?>"/></td>
                                </tr>                                                                                                    
                                <tr>
                                    <td><p><?php echo $txt_telefono ?></p></td>
                                    <td><input id="telefono" type="text" name="telefono" class="validate[required,custom[phone]]" value="<?php echo $_SESSION['carro'][$pos]['telefono'] ?>"/></td>
                                </tr>
                                <tr>
                                    <td><p><?php echo $txt_email ?></p></td>
                                    <td><input id="e-mail" type="text" name="email"  class="validate[required,custom[email]]" value="<?php echo $_SESSION['carro'][$pos]['email'] ?>"/></td>
                                </tr>
                                <tr>

                                    <td><p><?php echo $txt_detalle_tipo_id ?></p></td>
                                    <td><select id="sexo" name="sexo" >                                
                                            <option value="Male"><?php echo $txt_detalle_tipo_id_hombre ?></option>
                                            <option value="Female"><?php echo $txt_detalle_tipo_id_mujer ?></option>
                                            <option value="Legal"><?php echo $txt_detalle_tipo_id_legal ?></option>
                                        </select></td>                                     

                                </tr>
                                <tr id="iddocumento">
                                    <td><p><?php echo $txt_detalle_cpf ?></p></td>
                                    <td><input id="cpf" onkeyup="FormataCpf(this,event)" type="text" name="cpf" maxlength="14" value="<?php echo $_SESSION['carro'][$pos]['cpf'] ?>"/></td>
                                    <div id="validadorcpf"></div>
                                </tr>                                                                                                    
                            </table>

                        </fieldset>

                        <fieldset id="x3">
                            <legend><?php echo $txt_detalle_informacion_producto ?></legend>
                            <p><?php echo $txt_detalle_detalle_factura ?></p>
                            <?php
                            //$myCalendar = new tc_calendar("date5", true, false);
                            $myCalendar = new tc_calendar("date1", true, false);
                            $myCalendar->setIcon("calendar/images/iconCalendar.gif");
                            //$myCalendar->setDate(date('d'), date('m'), date('Y'));
                            $myCalendar->setPath("calendar/");
                            $myCalendar->setYearInterval(2011, 2013);
                            $fecha = date('Y-m-d');
                            $years = 2;
                            $myCalendar->dateAllow(date("Y-m-d", strtotime("$fecha-$years years")), date('Y-m-d'));
                            $myCalendar->setDate(date("d",strtotime($_SESSION['carro'][$pos]['datefactura'])), date("m",strtotime($_SESSION['carro'][$pos]['datefactura'])), date("Y",strtotime($_SESSION['carro'][$pos]['datefactura'])));
                            
                            $myCalendar->setAlignment('left', 'bottom');
                            $myCalendar->writeScript();
                            ?>                                                 
                            <br/>
                            <p><?php echo $txt_detalle_descripcion_producto ?></p>
                            <input type="text" id="descripcion" name="descripcion" class="validate[required] text-input" value="<?php echo $_SESSION['carro'][$pos]['descrip'] ?>"/>
                            <p><?php echo $txt_detalle_notafiscal ?></p>
                            <input type="text" id="notafiscal" name="notafiscal" class="validate[required] text-input" value="<?php echo $_SESSION['carro'][$pos]['notafiscal'] ?>"/>
                        </fieldset>

                        <fieldset id="x2">
                            <legend><?php echo $txt_detalle_informacion_direccion ?></legend>
                            <table border="0" width ="100%" cellpadding="0" cellspacing="0" >

                                <tr>
                                    <td><p><?php echo $txt_detalle_cep ?></p></td>
                                    <td align="center" ><input id="cep" type="text" name="cep" maxlength="9" class="validate[required]" value="<?php echo $_SESSION['carro'][$pos]['cep'] ?>" onkeyup="mascaraCEP(this)"/></td>
                                    <td ><input type="image" src="images/btn_quote.png" onclick="buscar_cep()"/></td>
                                </tr>

                            </table>


                            <div id="completar">
                                <table>
                                    <tr>
                                        <td><p><?php echo $txt_detalle_estado ?></p></td>
                                        <td><?php cargarestados($idiomaActual) ?></td>
                                    </tr>
                                    <tr>
                                        <td><p><?php echo $txt_ciudad ?></p></td>
                                        <td><select id="ciudad" name="ciudad" class="element select large validate[required]" value="<?php echo $_SESSION["user"]["ciudad"] ?>">
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><p><?php echo $txt_barrio ?></p></td>
                                        <td><input id="barrio" type="text" name="barrio" maxlength="20" class="validate[required,maxSize[20]]" value="<?php echo $_SESSION['carro'][$pos]['barrio'] ?>"/></td>
                                    </tr>
                                    <tr>
                                        <td><p><?php echo $txt_direccion_completa ?></p></td>
                                        <td><input id="direccion" type="text" name="direccion" maxlength="50" class="validate[required,maxSize[50]]" value="<?php echo $_SESSION['carro'][$pos]['direccion'] ?>"/></td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>

                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="btn_vermas" width='90'><input type="submit" value="<?php echo $txt_editar_boton_actualizar ?> " class="text_button"></input></td>
                                <td valign="middle"><input type="image" src="images/btn_vermas_2.png" onclick="$(this).closest('form').submit()"></input></td> 
                            </tr>
                        </table>
                    </form>
                </div>

            </div> <!--termina main-->

            <!-- seccion inc footer -->
            <?php include("includes/footer-inc.php"); ?>
            <!-- termina inc footer -->

        </div> <!--termina contenedor-->


    </body>
</html>