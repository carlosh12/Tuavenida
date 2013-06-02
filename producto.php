<?php
include("includes/init-inc.php");
// A partir de aquí ponemos el código de 
// la página en lenguaje HTML
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
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
        <link rel="Shortcut Icon" href="images/favicon.ico" type="image/x-icon" />

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
                
                <div id="contenido_top">
                    
                   <table width="100%" border="0" height="100%"  cellpadding="0" cellspacing="0">
                        <tr>
                            <td colspan="3" align="left"><img src="images/progess/paso1.png" alt=""/></td>
                        </tr>
                       
                       <tr>
                           <td colspan="3">&nbsp;</td>  
                       </tr>
                        <tr>
                            <td height="31" colspan="3"><h1> <?php echo  read("productos", "id", $idprod, "producto")?> </h1></td>
                        </tr>
                        <tr>
                            <td height="31" colspan="3"><h2><?php echo read("productos", "id", $idprod, "descripcion2") ?></h2></td>
                        </tr>
                        <tr>
                            <td height="31" colspan="3"><img src="images/separador_contenido.png" alt=""/></td>
                        </tr>
                    </table>
                   
                </div>

                <div id="contenido">
                    <p> <?php readtexto("productos", "id", $idprod, "descripcion"); ?> </p>
                </div>
                <div id="contenido_right">
                    <div class="contenido_right_img"></div>
                    <img src="<?php read("productos", "id", $idprod, "img_descrip"); ?>" align="center" alt=""/>        
                    
                    <table border="0" cellspacing="0" cellpadding="0" align="right" >
                        <tr >
                            
                              <?php
                                if  ($idprod == 1){
                                 echo '<td class="btn_vermas" width="90"><a href="cotizar.php?idioma=' .$idiomaActual. '&idprod=' .$idprod .'">' .$txt_detalle. '</a></td>';
                                 echo '<td width="44"><a href="cotizar.php?idioma=' .$idiomaActual. '&idprod=' .$idprod.'"><img src="images/btn_vermas_2.png" width="44" height="27"/></a></td>' ;
                                } 
                                else if ($idprod==4){
                                 echo '<td class="btn_vermas" width="90"><a href="cotizarsoat.php?idioma=' .$idiomaActual. '&idprod=' .$idprod .'">' .$txt_detalle. '</a></td>';
                                 echo '<td width="44"><a href="cotizarsoat.php?idioma=' .$idiomaActual. '&idprod=' .$idprod.'"><img src="images/btn_vermas_2.png" width="44" height="27"/></a></td>' ;
                                }
                                else if ($idprod==6){
                                 echo '<td class="btn_vermas" width="90"><a href="cotizarviaje.php?idioma=' .$idiomaActual. '&idprod=' .$idprod .'">' .$txt_detalle. '</a></td>';
                                 echo '<td width="44"><a href="cotizarviaje.php?idioma=' .$idiomaActual. '&idprod=' .$idprod.'"><img src="images/btn_vermas_2.png" width="44" height="27"/></a></td>' ;
                                }
                                else if ($idprod==7){
                                 echo '<td class="btn_vermas" width="90"><a href="cotizarvida.php?idioma=' .$idiomaActual. '&idprod=' .$idprod .'">' .$txt_detalle. '</a></td>';
                                 echo '<td width="44"><a href="cotizarvida.php?idioma=' .$idiomaActual. '&idprod=' .$idprod.'"><img src="images/btn_vermas_2.png" width="44" height="27"/></a></td>' ;
                                }
                                else{
                                 echo '<td class="btn_vermas" width="90"><a href="#">' .$txt_detalle. '</a></td>';
                                 echo '<td width="44"><a href="#"><img src="images/btn_vermas_2.png" width="44" height="27"/></a></td>' ; 
                              } ?>
                                    
                        </tr>
                    </table>
                    
                </div>
                
                

            </div> <!--termina main-->


            <!-- seccion inc footer -->
               <?php  include("includes/footer-inc.php"); ?>
            <!-- termina inc footer -->
            
        </div> <!--termina contenedor-->
       
    </body>
</html>