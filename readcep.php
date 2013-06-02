<?php

include("includes/init-inc.php");

function objectsIntoArray($arrObjData, $arrSkipIndices = array()) {
    $arrData = array();

    // if input is object, convert into array
    if (is_object($arrObjData)) {
        $arrObjData = get_object_vars($arrObjData);
    }

    if (is_array($arrObjData)) {
        foreach ($arrObjData as $index => $value) {
            if (is_object($value) || is_array($value)) {
                $value = objectsIntoArray($value, $arrSkipIndices); // recursive call
            }
            if (in_array($index, $arrSkipIndices)) {
                continue;
            }
            $arrData[$index] = $value;
        }
    }
    return $arrData;
}

if (isset($_POST["cep"])) {
    
    $cep = preg_replace("/[^0-9]/", "", $_POST["cep"]);

    $xmlUrl = "http://cep.republicavirtual.com.br/web_cep.php?cep=" . $cep . "&formato=xml"; // XML feed file/URL
    $xmlStr = file_get_contents($xmlUrl);
    $xmlObj = simplexml_load_string($xmlStr);
    $arrXml = objectsIntoArray($xmlObj);
//print_r($arrXml);

    if ($arrXml[resultado] == 1) {
        echo "<tr>";
        echo "<td><p>$txt_detalle_estado</p></td>";
        echo "<td><input id='estado' type='text' name='estado' maxlength='2' class='validate[required,maxSize[2]]' value='" . $arrXml[uf] . "' readonly/></td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><p> $txt_ciudad </p></td>";
        echo "<td><input id='ciudad' type='text' name='ciudad' maxlength='20' class='validate[required,maxSize[20]]' value='" . $arrXml[cidade] . "' readonly/></td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><p>$txt_barrio</p></td>";
        echo "<td><input id='barrio' type='text' name='barrio' maxlength='20' class='validate[required,maxSize[20]]' value='" . $arrXml[bairro] . "' readonly/></td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><p> $txt_direccion_completa </p></td>";
        echo "<td><input id='direccion' type='text' name='direccion' maxlength='50' class='validate[required,maxSize[50]]' value='" . $arrXml[tipo_logradouro] . " - " . $arrXml[logradouro] . "' readonly/></td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><p> $txt_direccion_numero </p></td>";
        echo "<td><input id='direccionnum' type='text' name='direccionnum' maxlength='50' class='validate[required,maxSize[50]]'/></td>";
        echo "</tr>";
    } else {
       echo '<table border=1>';
	   echo '        <tr>';
	   echo '             <td><p>' . $txt_detalle_estado . '</p></td>';
	   echo "             <td>". cargarestados($idiomaActual) ."</td>";
	   echo '         </tr>';
	   echo '         <tr>';
	   echo '             <td><p>'. $txt_ciudad .'</p></td>';
	   echo '             <td><select id="ciudad" name="ciudad" class="element select large validate[required]" value="'. $_SESSION["user"]["ciudad"] .'">';
	   echo '                 </select></td>';
	   echo '         </tr>';
	   echo '         <tr>';
	   echo '             <td><p>' . $txt_barrio .'</p></td>';
	   echo '             <td><input id="barrio" type="text" name="barrio" maxlength="20" class="validate[required,maxSize[20]]" value="'.$_SESSION["user"]["barrio"].'"/></td>';
	   echo '         </tr>';
	   echo '         <tr>';
	   echo '             <td><p>'.$txt_direccion_completa .'</p></td>';
	   echo '             <td><input id="direccion" type="text" name="direccion" maxlength="50" class="validate[required,maxSize[50]]" value="'.$_SESSION["user"]["direccion"].'"/></td>';
	   echo '         </tr>';
	   echo '     </table>';
    }
}
else
    echo "error leyendo CEP";
?>
