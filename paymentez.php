<?php
include("includes/init-inc.php");
// A partir de aquí ponemos el código de 
// la página en lenguaje HTML
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

        <title>Tuavenida.com</title>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/shadowbox.js"></script>    

        <script type="text/javascript">var _siteRoot='index.html',_root='index.html';</script>

        <link rel="stylesheet" href="css/main.css" type="text/css" />
        <link rel="stylesheet" href="css/menu.css" type="text/css" />
        <link rel="stylesheet" href="css/slider.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/shadowbox.css" type="text/css" />

    </head>
    <body>

        <div id="contenedor">
            
            <!-- seccion inc header -->
                    <?php  include("includes/header-inc.php"); ?>
            <!-- termina inc header -->

            <div id="main">
                <div id="contenido_left">
                    <br></br>
                    <p><?php cargar_productos("productos", "producto", $idiomaActual, "id"); ?></p>
                </div>
                <div id="separador">
                </div>
                <div id="contenido_pago">
                        <iframe src="http://checkout.paymentez.com/methods?mode=developer_products&application_code=TUAV-test&dev_reference=12345&uid=<?php echo $_SESSION["username_id"] ?>" width="100%" height="100%" align="center">

                        Texto alternativo para los usuarios que no ven iFrames. Por lo general se recomienda poner un enlace a la pagina contenida dentro del iFrame. Noticias iFrame.

                        </iframe>
                    
                </div>
                

            </div> <!--termina main-->


            <!-- seccion inc footer -->
               <?php  include("includes/footer-inc.php"); ?>
            <!-- termina inc footer -->
            
        </div> <!--termina contenedor-->
      
    </body>
</html>