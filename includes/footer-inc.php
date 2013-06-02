<?php



?>

<div class="footer_barra"></div>

<div id="footer">

    <div id="paragraphs">
        <div class="paragraph">
            <span><a href="#"><?php echo $txt_nuestrosproductos ?></a></span>
            <img src="images/separador_tit_bottom.png" alt="" style="width:90%" height="2" alt="" />
            <p><?php cargar_productos("productos", "producto", $idiomaActual, "id"); ?></p>
        </div>
        <div class="paragraph">
        <span><a href="#"><?php echo $txt_nuestraempresa ?></a></span>
            <img src="images/separador_tit_bottom.png" alt="" style="width:90%" height="2" alt="" />
            <p><?php echo $txt_nuestraempresa_texto ?></p>
        </div>

        <div class="paragraph">
            <span><a href="#"><?php echo $txt_servicioalcliente ?></a></span>
            <img src="images/separador_tit_bottom.png" alt="" style="width:90%"  height="2" alt="" />
            <p><?php echo $txt_servicioalcliente_texto ?></p>
        </div>

        <div class="paragraph">
            <span><a href="contacto.php?idioma=<?php echo $idiomaActual ?>"><?php echo $txt_sabermas ?></a></span>
            <img src="images/separador_tit_bottom_2.png" alt="" style="width:90%" height="2" />
             <p><?php echo $txt_sabermas_texto ?></p>
        </div>

    </div> <!--termina paragraphs-->

</div> <!--termina footer-->

<div class="footer_designby"></div>