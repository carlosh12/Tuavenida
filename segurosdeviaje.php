<?php
include("includes/init-inc.php");
// A partir de aquí ponemos el código de 
// la página en lenguaje HTML
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

        <title>Seguros de Viaje Tuavenida</title>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/shadowbox.js"></script>

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

            <div id="main">
                <div id="contenido_left">
                    <br></br>
                    <p><?php cargar_productos("productos", "producto", $idiomaActual, "id"); ?></p>
                </div>
                <div id="separador">
                </div>

                <div id="contenido_top">

                    <h1> <?php echo read("productos", "id", $idprod, "producto") ?> </h1>
                    <h2><?php echo read("productos", "id", $idprod, "descripcion2") ?></h2>
                    <img src="images/separador_contenido.png" alt=""/>                   
                </div>

                <div id="contenido">

                    <p>Descripcion larga</p>

                </div>

                <div id="contenido_right">
                    <div class="contenido_right_img"></div>
                    <img src="images/viajes/travel_b.png" alt="seguros de viaje"/>                    
                </div>



                <div id="cuadricula">

                    <div class="side-b">
                        <label><a href="cotizarviaje.php?prod=AtlasTravel">Atlas Travel</a></label>
                        <img src="images/viajes/travel_family_s.png" alt="Atlas travel" ></img>
                        <p>Short-term health insurance for individuals traveling outside their home country</p> 
                        
                        <div class="side-c">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class='btn_vermas' width='90'><a href='cotizarviaje.php?prod=AtlasTravel'><?php echo $txt_cotizar_boton_calcular ?></a></td>
                                <td width='44'><a href='cotizarviaje.php?prod=AtlasTravel'><img src='images/btn_vermas_2.png' width='44' height='27'/></a></td>
                            </tr>
                        </table>
                        </div>
                        
                    </div>
                    
                    <div class="side-b">
                        <label><a href="cotizarviaje.php?prod=StudentSecureSM">Student Secure SM</a></label>
                        <img src="images/viajes/travel_student_s.png" alt="StudentSecureSM"></img>
                        <p>Worldwide health coverage for students pursuing their education abroad</p>
                        
                        <div class="side-c">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class='btn_vermas' width='90'><a href='cotizarviaje.php?prod=StudentSecureSM'><?php echo $txt_cotizar_boton_calcular ?></a></td>
                                <td width='44'><a href='cotizarviaje.php?prod=StudentSecureSM'><img src='images/btn_vermas_2.png' width='44' height='27'/></a></td>
                            </tr>
                        </table>
                        </div>
                        
                    </div>

                    <div class="side-b">
                        <label><a href="cotizarviaje.php?prod=AtlasProfessional">Atlas Professional</a></label>
                        <img src="images/viajes/travel_business_s.png" alt="Atlas Professional"></img>
                        <p>International health coverage for executives taking multiple trips throughout the year</p>
                        
                        <div class="side-c">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class='btn_vermas' width='90'><a href='cotizarviaje.php?prod=AtlasProfessional'><?php echo $txt_cotizar_boton_calcular ?></a></td>
                                <td width='44'><a href='cotizarviaje.php?prod=AtlasProfessional'><img src='images/btn_vermas_2.png' width='44' height='27'/></a></td>
                            </tr>
                        </table>
                        </div>
                        
                    </div>
                    
                    <div class="side-b">
                        <label><a href="cotizarviaje.php?prod=AtlasGroup">Atlas Group</a></label>
                        <img src="images/viajes/travel_s.png" alt="Atlas Group"></img>
                        <p>Short-term international health insurance for 5 or more traveling abroad</p>
                        
                        <div class="side-c">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class='btn_vermas' width='90'><a href='cotizarviaje.php?prod=AtlasGroup'><?php echo $txt_cotizar_boton_calcular ?></a></td>
                                <td width='44'><a href='cotizarviaje.php?prod=AtlasGroup'><img src='images/btn_vermas_2.png' width='44' height='27'/></a></td>
                            </tr>
                        </table>
                        </div>
                        
                    </div>
                    
                    

                </div>

            </div> <!--termina main-->


            <!-- seccion inc footer -->
            <?php include("includes/footer-inc.php"); ?>
            <!-- termina inc footer -->

        </div> <!--termina contenedor-->

    </body>
</html>