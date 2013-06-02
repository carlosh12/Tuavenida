<?php

include("includes/init-inc.php");

$sql = "select * from usuarios where id = '{$_SESSION["user"]["id"]}'";
$res = mysql_query($sql) or die(mysql_error());

$num_total_registros = mysql_num_rows($res);
if ($num_total_registros > 0) {

    while ($fila = mysql_fetch_assoc($res)) {
        
        echo '<form id="form" method="post" action="update_profile.php?idioma=' . $idiomaActual .'">';
        echo '<fieldset>';
        echo '<legend>' . $txt_editar_perfil . '</legend>';
        echo '<table  width ="100%" cellpadding="0" cellspacing="0">';
        echo '<tr>';
        echo '<td width="40%"><p>' . $txt_nombre .'</p></td>';
        echo '<td colspan="2"><input id="name" type="text" name="name"  maxlength="50" onkeypress=" return validart(event)" class="validate[required,custom[onlyLetter]]" value="'. $fila['nombres'] . '"/></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><p>' . $txt_apellido .'</p></td>';
        echo '<td colspan="2"><input id="apellido" type="text" name="apellido"  maxlength="50" onkeypress=" return validart(event)" class="validate[required,custom[onlyLetter]]" value="' . $fila['apellidos'] . '"/></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><p>' . $txt_telefono .'</p></td>';
        echo '<td colspan="2"><input id="telefono" type="text" name="telefono" maxlength="11" onkeypress=" return validarn(event)" class="validate[required,custom[telephone]]" value="' . $fila['telefono'] . '"/></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><p>' . $txt_email .'</p></td>';
        echo '<td colspan="2"><input id="e-mail" type="text" name="email" onkeypress=" return aceptatodo(event)" class="validate[required,custom[email]]" value="' . $fila['email'] . '"/></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td></td>';
        echo '<td width="90" class="btn_vermas"><a href="#">' . $txt_editar . '</a></td>';
        echo '<td width="44"><input type="image" src="images/btn_vermas_2.png" title="' . $txt_editar . '"></input></td>' ; 
        echo '</tr>';
        echo '</table>';
        echo '</fieldset>';
        echo '</form>';
    }
}
?>
