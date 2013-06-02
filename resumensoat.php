<?php
require_once('calendar/classes/tc_calendar.php');

include("includes/init-inc.php");

// A partir de aquí ponemos el código de 
// la página en lenguaje HTML
//RECIBO POR POST

if (isset($_POST["name"]))
    $name = $_POST["name"];

if (isset($_POST["apellido"]))
    $apellido = $_POST["apellido"];

if (isset($_POST["telefono"]))
    $telefono = $_POST["telefono"];

if (isset($_POST["email"]))
    $email = $_POST["email"];

if (isset($_POST["direccion"]))
    $direccion = $_POST["direccion"];

if (isset($_POST["cedula"]))
    $cpf = $_POST["cedula"];

if (isset($_POST["clase"]))
    $clase = $_POST["clase"];

if (isset($_POST["subclase"]))
    $subclase = $_POST["subclase"];

if (isset($_POST["edad"]))
    $edad = $_POST["edad"];

if (isset($_POST["modelo"]))
    $modelo = $_POST["modelo"];

if (isset($_POST["linea"]))
    $linea = $_POST["linea"];

if (isset($_POST["placa"]))
    $placa = $_POST["placa"];

if (isset($_POST["motor"]))
    $motor = $_POST["motor"];

if (isset($_POST["chasis"]))
    $chasis = $_POST["chasis"];

$_SESSION['cotizar']['name'] = $name;
$_SESSION['cotizar']['apellido'] = $apellido;
$_SESSION['cotizar']['telefono'] = $telefono;
$_SESSION['cotizar']['email'] = $email;
$_SESSION['cotizar']['direccion'] = $direccion;
$_SESSION['cotizar']['cpf'] = $cpf;

$_SESSION['cotizar']['clase'] = $clase;
$_SESSION['cotizar']['subclase'] = $subclase;
$_SESSION['cotizar']['edad'] = $edad;
$_SESSION['cotizar']['modelo'] = $modelo;
$_SESSION['cotizar']['linea'] = $linea;
$_SESSION['cotizar']['placa'] = $placa;
$_SESSION['cotizar']['motor'] = $motor;
$_SESSION['cotizar']['chasis'] = $chasis;

$idprod = $_GET['idprod'];


//$sql = "update usuarios set nombres = '{$name}', apellidos = '{$apellido}', cedula = '{$cpf}', telefono = '{$telefono}', 
//ciudad = '{$ciudad}', zipcode = '{$cep}', estado= '{$estado}', sexo = '{$sexo}', barrio = '{$barrio}', direccion = '{$direccion}' 
//where id = " . $_SESSION["user"]["id"];
//mysql_query($sql)
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

        <title><?php echo $txt_resumen_titulo_web ?></title>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/shadowbox.js"></script>

        <script type="text/javascript" src="calendar/calendar.js"></script>

        <script type="text/javascript" src="js/formToWizard.js"></script>
<!--        <script type="text/javascript">
            $(document).ready(function(){
       
                // esta es la funcion que registra a los visitantes
                $("#registrar").click(function(){
                    $.ajax(
                    {
                        type: "POST",
                        cache:false,
                        url: "validar_registro.php",
                        data: {
                            nombre:"<?php echo $name ?>" ,
                            apellido:"<?php echo $apellido ?>",
                            username:"<?php echo $email ?>",
                            email: "<?php echo $email ?>" ,
                            password:$("#password").val(),
                            password2:$("#password2").val(),
                            telefono:"<?php echo $telefono ?>",
                            direccion:"<?php echo $direccion ?>",
                            cedula:"<?php echo $cep ?>",
                            date1:"<?php echo $date1 ?>",
                            barrio:"<?php echo $barrio ?>",
                            ciudad:"<?php echo $ciudad ?>",
                            estado:"<?php echo $estado ?>",
                            zipcode:"<?php echo $cpf ?>",
                            sexo:"<?php echo $sexo ?>",
                            suscribir:"1"
                        },
                        complete:function(){ },
                        success: function(data){
                            var idioma;
                            var idprod;
                            idioma="<?php echo $idiomaActual ?>";
                            idprod="<?php echo $idprod ?>";
                            var destino = "carro.php?idioma="+idioma+"&idprod="+idprod+"&action=add";
                            $("#divaux").slideToggle('slow')
                            $("#result").empty().append(data);
                            document.location.href=destino;
                        },
                        beforeSend: function(data)      {
                            $("#divaux").slideToggle('slow');  
                            $("#result").empty().html('Processing data...');
                            //tratamos de loguear a la persona actual
                            $.ajax({
                                dataType: "json",
                                type: "POST",
                                async:true,
                                url: "validar_usuario.php",
                                data:{
                                    ususario:"<?php echo $email ?>",
                                    password:$("#password").val()},
                                success:function(data){
                                    if(data.entrar==0)
                                    {
                                        alert(<?php echo $txt_resumen_inicio_sesion ?>);
                                        $("#result").html(<?php echo $txt_resumen_usuario_pass_no_existe ?>);
                                        return false
                                    }
                                    else{
                                        //   document.location.href="index.php";
                                    }
                                }
                            })
                        },
                        error:function(data){ alert(data);}
                    }//fin option list
                ); //fin ajax
                })
                // fin registro visitantes
                $("#form1").formToWizard({ submitButton: 'SaveAccount' });
                $("#divaux").css("display","none");
      
                $("#chkregistrar").click(function(){
                    $("#divaux").slideToggle('slow'); 
                })
                $('#password, #password2').keyup(function(){
                    validarclaves($('#password'),$('#password2'),$('#result'));
                })
            });
            function validarclaves($text1,$text2,$mensajera)
            {
                     
                var letras_mayusculas="ABCDEFGHYJKLMNÑOPQRSTUVWXYZ";
                var especiales=".!#-*?_+";
                var tieneespecial=false;
                var tienemay=false;
                var tienenumero=false;
                var mensaje="";
                var numeros="0123456789";
                var texto1=$text1.val();
                var texto2=$text2.val();
                for(i=0; i<texto1.length; i++){
                    if (numeros.indexOf(texto1.charAt(i),0)!=-1){
                        tienenumero=true;
                    }
                              
                    if (letras_mayusculas.indexOf(texto1.charAt(i),0)!=-1){
                        tienemay=true;
                    }
                    if (especiales.indexOf(texto1.charAt(i),0)!=-1){
                        tieneespecial=true;
                    }
                              
                }//fin for
                if (!tienenumero)
                    mensaje+=<?php echo $txt_resumen_validacion_numero ?>;
                              
                if(!tienemay)
                    mensaje+=<?php echo $txt_resumen_validacion_mayuscula ?>;
                if (texto1.length<8)
                    mensaje+=<?php echo $txt_resumen_validacion_longitud ?>;
                if (!tieneespecial)
                    mensaje+=<?php echo $txt_resumen_validacion_especial ?>;
                       
                if(tienemay  && tienenumero && texto1.length>8 && texto2==texto1 && tieneespecial) 
                    $("#registrar").fadeIn('slow');
                else
                    $("#registrar").css("display","none");
                $mensajera.empty().html(mensaje);
            }

        </script>-->

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

                    <table width="80%" border="0" cellpadding="0" cellspacing="0" align="center">
                        <tr>
                            <!--<td width='60'><a href="javascript:window.print();"><?php echo $txt_resumen_boton_imprimir ?> </a></td>-->
                            <td colspan="6" valign="middle" align="left"><input type="image" src="images/printerIcon.png" alt="<?php echo $txt_resumen_boton_imprimir ?>" onclick="window.print()"></input></td> 
                        </tr>

                        <tr>
                            <td colspan="3" align="right"><?php echo $txt_nombre_completo ?>: </td>
                            <td colspan="3" align="left" ><?php echo $name . ' ' . $apellido ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><?php echo $txt_direccion_completa ?>: </td>
                            <td colspan="3" align="left"><?php echo $direccion ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><?php echo $txt_telefono ?>: </td>
                            <td colspan="3" align="left"><?php echo $telefono ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><?php echo $txt_email ?>: </td>
                            <td colspan="3" align="left"><?php echo $email ?></td>
                        </tr>

                        <tr>
                            <td colspan="3" align="right">Vehiculo: </td>
                            <td colspan="3" align="left" ><?php echo $_SESSION['cotizar']['clase'] . ' - ' . $_SESSION['cotizar']['subclase'] = $subclase . ' - ' . $_SESSION['cotizar']['edad'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right">Modelo: </td>
                            <td colspan="3" align="left"><?php echo $_SESSION['cotizar']['modelo'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right">Linea: </td>
                            <td colspan="3" align="left"><?php echo $_SESSION['cotizar']['linea'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right">Placa: </td>
                            <td colspan="3" align="left"><?php echo $_SESSION['cotizar']['placa'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right">Motor: </td>
                            <td colspan="3" align="left"><?php echo $_SESSION['cotizar']['motor'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right">Chasis: </td>
                            <td colspan="3" align="left"><?php echo $_SESSION['cotizar']['chasis'] ?></td>
                        </tr>

                        <tr>
                            <td colspan="6" align="center"><img src="images/separador_body_home_top.png" alt="" width="298" height="2" readonly="true" /></td>
                        </tr>
                        <tr>
                            <td valign="middle" width='27'><input type="image" src="images/btn_previous.png" onclick="history.go(-1)"></input></td> 
                            <td class="btn_vermas" width='90'><a href="javascript:history.go(-1)"><?php echo $txt_resumen_boton_volver ?> </a></td>
                            <td width='110'>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="btn_vermas" width='90' ><a href="carrosoat.php?idioma=<?php echo $idiomaActual ?>&idprod=<?php echo $idprod ?>&action=add"><?php echo $txt_resumen_boton_contratar ?> </a></td>
                            <td valign="middle" width='27'><a href="carrosoat.php?idioma=<?php echo $idiomaActual ?>&idprod=<?php echo $idprod ?>&action=add"><img src="images/btn_vermas_2.png"/></a></td> 
                        </tr>

                    </table>

                </div>

            </div> <!--termina main-->
            <div id="result" class="result"></div>

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