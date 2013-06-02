<?php
include("includes/init-inc.php");
// A partir de aquí ponemos el código de 
// la página en lenguaje HTML

switch ($_GET['prod']) {

    case "AtlasTravel":{
        $url = 'https://www.hccmis.com/atlastravel/?referid=25141&language=es-MX';
        break;
    }
    case "AtlasGroup":{
        $url = 'https://www.hccmis.com/atlasgroup/?referid=25141&language=es-MX';
        break;
    }
    case "AtlasProfessional":{
        $url = 'https://www.hccmis.com/atlaspro/?referid=25141&language=es-MX';
        break;
    }
    case "CitizenSecureSM":{
        $url = 'https://www.worldtrips.com/quotes/ic/?language=spanish&referid=25141 CitizenSecureSM Economy https://www.worldtrips.com/quotes/ice/?language=spanish&referid=25141';
        break;
    }
    case "CitizenSecureSMEconomy":{
        $url = 'https://www.worldtrips.com/quotes/stm/secure/Step1a.aspx?AgentId=25141';
        break;
    }
    case "StudentSecureSM":{
        $url = 'https://www.hccmis.com/studentsecure/?referid=25141&language=es-MX';
        break;
    }
}

//$_SESSION['url'] = $_SERVER['REQUEST_URI'];
//
//if (!isset($_SESSION["user"]["id"])) {
//    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/Tuavenida/login.php?idioma=" . $idiomaActual);
//}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

        <title>Cotizar viajes</title>

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
            <?php include("includes/header-inc.php"); ?>
            <!-- termina inc header -->

            <div id="main">
                <div id="contenido_left">
                    <br></br>
                    <p><?php cargar_productos("productos", "producto", $idiomaActual, "id"); ?></p>
                </div>
               

                <div id="contenido_top">

                    <table width="100%" border="0" cellpadding="0" cellspacing="0">

                        <tr>
                            <td><h1>Seguro de Viaje</h1></td>
                        </tr>
                        <tr>
                            <td><h2>Cotiza aqui tu seguro de viaje</h2></td>
                        </tr>
                        <tr>
                            <td><img src="images/separador_contenido.png" alt=""/></td>
                        </tr>
                    </table>

                </div>

                <div id="contenido_iframe">
                    <iframe src="<?php echo $url ?>" width="800" height="650"> </iframe>
                </div>

                <!-- seccion inc footer -->
                <?php include("includes/footer-inc.php"); ?>
                <!-- termina inc footer -->

            </div> <!--termina contenedor-->
        </div>
    </body>
</html>