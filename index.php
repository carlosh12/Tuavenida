<?php
//include("includes/Mobile_Detect.php");
//$detect = new Mobile_Detect();
//if ($detect->isMobile()) {
//    header ("Location: http://m.tuavenida.com");
//}


include("includes/init-inc.php");

// A partir de aquí ponemos el código de 
// la página en lenguaje HTML
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta name="keywords" content="seguros en linea, soat, spare backup, insurance online"/>
        <meta name="description" content="Venta de seguros en linea"/>

        <title>Seguros en linea Tuavenida.com</title>


        <link rel="Shortcut Icon" href="images/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="css/main.css" type="text/css" />
        <link rel="stylesheet" href="css/menu.css" type="text/css" />
        <link rel="stylesheet" href="css/slider.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/shadowbox.css" type="text/css" />

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/shadowbox.js"></script>   

    </head>
    <body onload="checkCookie()">

        <div id="contenedor">

            <!-- seccion inc header -->
            <?php include("includes/header-inc.php"); ?>
            <!-- termina inc header -->

            <div id="slices">            

                <div id="header"><div class="wrap">
                        <div id="slide-holder">
                            <div id="slide-runner">
                                <?php cargar_slice("img_slice", "ruta", $idiomaActual, "id"); ?>
                                <div id="slide-controls">
                                    <!--<p id="slide-client" class="text"><strong>post: </strong><span></span></p>
                                    <p id="slide-desc" class="text"></p>-->
                                    <p id="slide-nav"></p>
                                </div>  
                            </div>

                            <!--content featured gallery here -->
                        </div>
                        <?php cargar_parametrosslice("img_slice", $idiomaActual); ?>


<!--                       <script type="text/javascript">
                            if(!window.slider) var slider={};slider.data=[{"id":"slide-img-1","client":"nature beauty","desc":"nature beauty photography"},{"id":"slide-img-2","client":"nature beauty","desc":"add your description here"},{"id":"slide-img-3","client":"nature beauty","desc":"add your description here"}];
                        </script>-->

                    </div>
                </div><!--/header-->     

            </div><!--termina slices-->

            <div id="main">
                <?php cargar_main("productos", $idiomaActual, $txt_vermas); ?>    
            </div> <!--termina main-->


            <!-- seccion inc footer -->
            <?php include("includes/footer-inc.php"); ?>
            <!-- termina inc footer -->


        </div> <!--termina contenedor-->       


    </body>
</html>