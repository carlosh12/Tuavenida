<?php
?>

<!-- Inicio Scripts varios -->
<script type="text/javascript" src="js/misc.js"></script>
<!-- Fin Scripts varios -->

<div id="cabezera">

<!-- logo -->
<table width="100%" height="100%" border="0" cellspacing=0 cellspading=0>
    <tr>
        <td width="65%" rowspan="6" align="left"> <a href="index.php?idioma=<?php echo $idiomaActual ?>">
                <img src="images/logo.png" alt="logo"/></a>
        </td>
    </tr>
</table>


<!-- Termina logo -->

</div><!--termina cabezera-->
<div id="mimenulogin">

<?php

if(isset($_GET['status']))
	unset($_SESSION['carro']);


if (isset($_SESSION['k_username'])) {
    echo '<table width="100%" border="0" cellspacing="0" cellpadding="0" >';
    echo '<tr>';
    echo '<td width="39" align="center" class="fondologin"><a href="index.php?idioma=' . $idiomaActual . '"><img src="images/login/menu_icon_home.png" alt="" width="21" height="35" /></a></td>';
    echo '<td width="63" class="fondologinname"><a href="index.php?idioma=' . $idiomaActual . '">' . $txt_menu_home . '</a></td>';
    echo '<td width="25" class="fondologin"><a href="myproducts.php?idioma=' . $idiomaActual . '"><img src="images/login/menu_icon_user.png" alt="" width="19" height="35" /></a></td>';
    echo '<td width="406" class="fondologinname"><a href="myproducts.php?idioma=' . $idiomaActual . '"> ' . $txt_saludo . ', ' . $_SESSION['k_username'] . '</a></td>';
    echo '<td width="21" class="fondologin"><a href=javascript:abrirshadow()><img src="images/login/menu_icon_world.png" alt="" width="21" height="35" /></a></td>';
    echo '<td width="120" class="fondologin"><a href=javascript:abrirshadow()>' . $txt_idiomas . '</a></td>';
    echo '<td width="21"> <img src="images/login/menu_diag.png" alt="" width="21" height="35" /></td>';
    echo '<td width="21" class="fondoderecha"><a href="logout.php"><img src="images/login/menu_icon_logout.png" alt="" width="21" height="35" /></a></td>';
    echo '<td width="67" class="fondoderecha"><a class="menu" href="logout.php">Sair</a></td>';
    echo '<td width="21" class="fondoderecha"><a href="myproducts.php?idioma=' . $idiomaActual . '"><img src="images/login/menu_icon_products.png" alt="" width="21" height="35" /></td>';
    echo '<td width="114" class="fondoderecha"><a class="menu" href="myproducts.php?idioma=' . $idiomaActual . '">Meus Produtos</a></td>';
    echo '<td width="41" class="fondoderecha"><a href="' . $txt_carrito . '.php?idioma=' . $idiomaActual . '&action=mostrar"><img src="images/login/menu_icon_cart.png" alt="" width="21" height="34" /></a></td>';
    echo '<td width="30" class="fondoderecha" ><a class="menu" href="' . $txt_carrito . '.php?idioma=' . $idiomaActual . '&action=view"> ' . count($_SESSION['carro']) . '</a></td>';
    echo '</tr>';
    echo '</table>';
} else {
    echo '<table width="100%" border="0" cellspacing="0" cellpadding="0" >';
    echo '<tr>';
    echo '<td width="39" align="center" class="fondologin"><a href="index.php?idioma=' . $idiomaActual . '"><img src="images/login/menu_icon_home.png" alt="" width="21" height="35" /></a></td>';
    echo '<td width="63" class="fondologinname"><a href="index.php?idioma=' . $idiomaActual . '">' . $txt_menu_home . '</a></td>';
    echo '<td width="441" class="fondologin">&nbsp;</td>';
    echo '<td width="21" class="fondologin"><a href=javascript:abrirshadow()><img src="images/login/menu_icon_world.png" alt="" width="21" height="35" /></a></td>';
    echo '<td width="120" class="fondologin" align="center"><a href=javascript:abrirshadow()>' . $txt_idiomas . '</a></td>';
    echo '<td width="21"> <img src="images/login/menu_diag.png" alt="" width="21" height="35" /></td>';
    echo '<td width="21" class="fondoderecha"><a href="login.php?idioma=' . $idiomaActual . '"><img src="images/login/menu_icon_login.png" alt="" width="21" height="35" /></a></td>';
    echo '<td width="67" class="fondoderecha"><a class="menu" href="login.php?idioma=' . $idiomaActual . '">' . $txt_menu_login . '</a></td>';
    echo '<td width="21" class="fondoderecha"><a href="registro.php"><img src="images/login/menu_icon_register.png" alt="" width="21" height="35" /></a></td>';
    echo '<td width="104" class="fondoderecha"><a class="menu" href="registro.php">' . $txt_menu_registrar . '</a></td>';
    echo '<td width="51" class="fondoderecha"><a href="' . $txt_carrito . '.php?idioma=' . $idiomaActual . '&action=mostrar"><img src="images/login/menu_icon_cart.png" alt="" width="21" height="34" /></a></td>';
    echo '<td width="30" class="fondoderecha" ><a class="menu" href="' . $txt_carrito . '.php?idioma=' . $idiomaActual . '&action=view"> ' . count($_SESSION['carro']) . '</a></td>';
    echo '</tr>';
    echo '</table>';
}
?>   

<!--  <div id="menux"> 
      <ul class="menu"> 

          <li><a href="#"><?php echo $txt_menuProduct ?></a>
              <ul class="submenu">
<?php cargar_productos("productos", "producto", $idiomaActual, "id"); ?>
              </ul>
          </li>

          <li><a href="https://secure.paymentez.com/" target='_blank'>PAYMENTEZ</a></li> 
          <li><a href="#"><?php echo $txt_quienessomos ?></a></li> 
          <li><a href="#">FAQ </a></li> 
          <li><a href="#"><?php echo $txt_contactenos ?></a></li> 

      </ul> 
  </div> -->

</div><!--termina mimenu-->