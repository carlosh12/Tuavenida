<?php

include ("cnx.php");
session_start();

if (isset($_POST['funcion'])) {

	if ($_POST['funcion'] == 'productosxid')
		productosxid($_POST['id']);
	if ($_POST['funcion'] == 'leerusuario')
		leerusuario($_POST['id']);
}

//Limpiar parametros POST y GET
function limpiarCadena($valor) {
	$valor = str_ireplace("SELECT", "", $valor);
	$valor = str_ireplace("COPY", "", $valor);
	$valor = str_ireplace("DELETE", "", $valor);
	$valor = str_ireplace("DROP", "", $valor);
	$valor = str_ireplace("DUMP", "", $valor);
	$valor = str_ireplace(" OR ", "", $valor);
	$valor = str_ireplace("%", "", $valor);
	$valor = str_ireplace("LIKE", "", $valor);
	$valor = str_ireplace("--", "", $valor);
	$valor = str_ireplace("^", "", $valor);
	$valor = str_ireplace("[", "", $valor);
	$valor = str_ireplace("]", "", $valor);
	$valor = str_ireplace("\\", "", $valor);
	$valor = str_ireplace("!", "", $valor);
	$valor = str_ireplace("¡", "", $valor);
	$valor = str_ireplace("?", "", $valor);
	$valor = str_ireplace("=", "", $valor);
	$valor = str_ireplace("&", "", $valor);
	return $valor;
}

//diferencia de fechas
function daysDifference($endDate=0, $beginDate=0) {
	$date_parts1 = explode("-", $beginDate);
	$date_parts2 = explode("-", $endDate);
	$start_date = gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
	$end_date = gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
	return $end_date - $start_date;
}

//calcular edad
function CalculaEdad($fecha) {
	list($Y, $m, $d) = explode("-", $fecha);
	return (date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y);
}

//cargar productos x pais
function cargar_combo($tabla, $value, $var1) {
	$sql = "select * from " . $tabla . " where pais_id in (select id from paises where cod_pais = '" . $var1 . "')";
	$res = mysql_query($sql) or die(mysql_error());
	echo "<select name='$tabla' class='botones'>";
	while ($fila = mysql_fetch_assoc($res)) {
		echo "<option value='$fila[$value]'> $fila[$value] </option>";
	}
	echo "</select>";
}

function cargaritems($dev_reference) {
	$sql = "select max(id) as prod from dev_products_items where id_dev_products = $dev_reference";
	$res = mysql_query($sql) or die(mysql_error());

	while ($fila = mysql_fetch_assoc($res)) {
		return $fila['prod'];
	}
}

function cargar_menu($tabla, $value) {
	$sql = "select * from " . $tabla . " where pais_id in (select id from paises where cod_pais = '" . $value . "')";
	$res = mysql_query($sql) or die(mysql_error());

	while ($fila = mysql_fetch_assoc($res)) {
		echo "<li><a href='producto.php?idioma=$value&idprod=$fila[id]'>";
		echo strtoupper("$fila[producto]</a></li>");
	}
}

function cargar_productos($tabla, $value, $var1, $var2) {
	$sql = "select * from " . $tabla . " where pais_id in (select id from paises where cod_pais = '" . $var1 . "')";
	$res = mysql_query($sql) or die(mysql_error());

	while ($fila = mysql_fetch_assoc($res)) {

		if ($fila['id'] == 5 or $fila['id'] == 6) {
			echo "<a href='segurosdeviaje.php?idioma=$var1&idprod=" . $fila['id'] . "'>";
			echo strtoupper("$fila[$value]</a>");
			echo "<br/><br/>";
		} else {
			echo "<a href='producto.php?idioma=$var1&idprod=" . $fila['id'] . "'>";
			echo strtoupper("$fila[$value]</a>");
			echo "<br/><br/>";
		}
	}
}

function cargarprodseg() {
	$sql = "select id_tipo, tipo_descrip from SEG_Tipo_disp";
	$res = mysql_query($sql) or die(mysql_error());

	while ($fila = mysql_fetch_assoc($res)) {
		echo "<option value='" . $fila['id_tipo'] . "'> " . htmlentities($fila['tipo_descrip']) . "</option>";
	}
}

function cargar_slice($tabla, $value, $var1, $var2) {
	$sql = "select * from " . $tabla . " where id_pais in (select id from paises where cod_pais = '" . $var1 . "')";
	$res = mysql_query($sql) or die(mysql_error());

	$i = 1;

	while ($fila = mysql_fetch_assoc($res)) {
		$test = "<a href='producto.php?idioma=$var1&idprod=$fila[id_prod]'><img id='slide-img-$i' src='$fila[$value]' class='slide' alt='' /></a>";
		echo $test;
		$i += 1;
	}
}

function cargar_parametrosslice($tabla, $var1) {
	$sql = "select * from " . $tabla . " where id_pais in (select id from paises where cod_pais = '" . $var1 . "')";

	$resEmp = mysql_query($sql) or die(mysql_error());
	$totEmp = mysql_num_rows($resEmp);

	echo "<script type='text/javascript'>";
	echo "if(!window.slider) var slider={};";
	echo "slider.data=[";

	for ($i = 1; $i <= $totEmp; $i++) {
		if ($i > 1) {
			echo ",";
		}
		echo "{'id':'slide-img-$i','client':'test','desc':'test'}";
	}

	echo "];</script>";
}

function cargar_main($tabla, $var1, $var2) {
	$sql = "select * from " . $tabla . " where pais_id in (select id from paises where cod_pais = '" . $var1 . "')";
	$res = mysql_query($sql) or die(mysql_error());

	while ($fila = mysql_fetch_assoc($res)) {
		echo "<div class='side-a'>";
		echo "<table width='100' border='0' cellspacing='0' cellpadding='0'>";
		echo "<tr class='title_productsection'>";
		echo "<td>" . $fila['producto'] . "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><img src='images/separador_body_home_top.png' alt='' width='298' height='2' /></td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td><table width='100%' border='0' cellspacing='0' cellpadding='0'>";
		echo "<tr class='content_productsection'>";
		echo "<td><img src='$fila[imagen]' width='86' height='90' alt='' /></td>";
		echo "<td valign='top'>";
		echo htmlentities($fila['descripcion2']);
		echo "</td>";
		echo "</tr>";
		echo "</table></td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td align='right'><table width='134' border='0' cellspacing='0' cellpadding='0'>";
		echo "<tr>";
		echo "<td class='btn_vermas'>";
		if ($fila['id'] == 5 or $fila['id'] == 6) {
			echo "<a href='segurosdeviaje.php?idioma=$var1&idprod=$fila[id]'>$var2</a>";
			echo "</td>";
			echo "<td align='left'><a href='segurosdeviaje.php?idioma=$var1&idprod=$fila[id]'><img src='images/btn_vermas_2.png' alt=''/></a></td>";
		} else {
			echo "<a href='producto.php?idioma=$var1&idprod=$fila[id]'>$var2</a>";
			echo "</td>";
			echo "<td align='left'><a href='producto.php?idioma=$var1&idprod=$fila[id]'><img src='images/btn_vermas_2.png' alt=''/></a></td>";
		}
		echo "</tr>";
		echo "</table></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><img src='images/separador_body_home_bottom.png' alt='' width='303' height='4' /></td>";
		echo "</tr>";

		echo "</table>";
		echo "</div>";
	}
}

function readreturn($tabla, $condicion, $var1, $var2) {
	$sql = "select * from " . $tabla . " where " . $condicion . "  = '" . $var1 . "'";
	$res = mysql_query($sql) or die(mysql_error());

	while ($fila = mysql_fetch_assoc($res)) {
		return $fila[$var2];
	}
}

function read($tabla, $condicion, $var1, $var2) {
	$sql = "select * from " . $tabla . " where " . $condicion . "  = '" . $var1 . "'";
	$res = mysql_query($sql) or die(mysql_error());

	while ($fila = mysql_fetch_assoc($res)) {
		echo htmlentities($fila[$var2]);
	}
}

function readitem($tabla, $condicion, $var1, $var2) {
	$sql = "select * from " . $tabla . " where " . $condicion . "  = (select id_prod from SEG_Tipo_disp where SEG_Tipo_disp.id_tipo = (select id_tipo from SEG_Planes where id_plan = '" . $var1 . "'))";
	$res = mysql_query($sql) or die(mysql_error());

	while ($fila = mysql_fetch_assoc($res)) {
		echo htmlentities($fila[$var2]);
	}
}

function readtexto($tabla, $condicion, $var1, $var2) {
	$sql = "select * from " . $tabla . " where " . $condicion . "  = '" . $var1 . "'";
	$res = mysql_query($sql) or die(mysql_error());

	while ($fila = mysql_fetch_assoc($res)) {
		echo nl2br(htmlentities($fila[$var2]));
	}
}

function insert_devprod() {
	$total = 0;

	$sql = "INSERT INTO dev_products (descrip,fecha,precio,moneda, usr_id)
                            VALUES ('Compra en Tuavenida',now(),0,'BRL', '{$_SESSION["user"]["id"]}')";
	mysql_query($sql);

	$resultado = mysql_query("select max(id) as maxi from dev_products");
	$mifila = mysql_fetch_array($resultado);
	$maxid = $mifila['maxi'];

	foreach ($_SESSION['carro'] as $pos => $prod) {

		$plazo = 12;

		$total = $total + $_SESSION['carro'][$pos]['prima'];

		$sql = "insert into dev_products_items
        (id_dev_products, id_item, descrip, precio, cantidad, plazo, datecompra, datefactura, name, apellido, direccion, barrio, 
        ciudad, estado, cep, cpf, telefono, email, referencia, sexo, precioprod, notafiscal) 
        VALUES ('{$maxid}','{$_SESSION['carro'][$pos]['id_plan']}','{$_SESSION['carro'][$pos]['tipo']}','{$_SESSION['carro'][$pos]['prima']}','1','{$plazo}','{$_SESSION['carro'][$pos]['datecompra']}','{$_SESSION['carro'][$pos]['datefactura']}',
        '{$_SESSION['carro'][$pos]['name']}','{$_SESSION['carro'][$pos]['apellido']}','{$_SESSION['carro'][$pos]['direccion']}',
        '". $_SESSION['carro'][$pos]['barrio']."','" . html_entity_decode($_SESSION['carro'][$pos]['ciudad']) . "','" . html_entity_decode($_SESSION['carro'][$pos]['estado']) . "',
        '{$_SESSION['carro'][$pos]['cep']}','{$_SESSION['carro'][$pos]['cpf']}','{$_SESSION['carro'][$pos]['telefono']}',
        '{$_SESSION['carro'][$pos]['email']}','{$_SESSION['carro'][$pos]['descrip']}','{$_SESSION['carro'][$pos]['sexo']}','{$_SESSION['carro'][$pos]['valor']}','{$_SESSION['carro'][$pos]['notafiscal']}')";
		mysql_query($sql);
	}

	$sql = "update dev_products set precio = '" . $total / 10 . "' where id = " . $maxid;
	mysql_query($sql);

	header("Location: http://checkout.paymentez.com/methods?mode=developer_products&application_code=TUAV-test&dev_reference=" . $maxid . "&uid=" . $_SESSION["user"]["id"]);
}

function readcategory($id_plan)
{

	 $sql = "select producto from productos where id = (
			 select id_prod from SEG_Tipo_disp where id_tipo = (
			 select id_tipo from SEG_Planes where id_plan = '" . $id_plan . "'))";
 			
	 $result = mysql_query($sql) or die(mysql_error());
 	
	 return mysql_result($result,0);
}

// muestra los productos de un usuario
function productosxusuario($usuario,$country) {

	echo '<ul class="accordion"> ';
		
	foreach (productsCountry($country) as $key => $value) {
		echo "<li><a href='#'>$value</a></li>";
			echo "<ul class='sub-menu'>";
   		
			$sql = "select dev_products_items.id, dev_products_items.descrip, dev_products_items.id_item from dev_products_items
				join transacciones on transacciones.dev_reference = dev_products_items.id_dev_products
				where transacciones.user_id =" . $usuario;	
					
			$result = mysql_query($sql) or die(mysql_error());
		
			$total_items = 0;
			while ($fila = mysql_fetch_array($result)) {
				$total_items += 1;
				
				if (readcategory($fila['id_item']) == $value) 
			        echo "<li><a href='#' class='detalle' data='" . $fila["id"] . "'><em>$total_items</em>" . $fila['descrip'] . "</a></li>";
			        
				}
			echo "</ul>";		 
	}
			
 	echo '</ul>';
    	
}

function productsCountry($country='')
{
	$sql = "select producto from productos where pais_id = (select id from paises where cod_pais = '" . $country . "')";	
			
	$result = mysql_query($sql) or die(mysql_error());
	
	$arrayprod = array();

	while ($fila = mysql_fetch_array($result)) {
			$arrayprod[] = $fila['producto'];
		}
	
	return $arrayprod;
}

// retorna un producto dado si id
function productosxid($id) {
	$sql = "select dev_products_items.descrip, dev_products.fecha, dev_products.moneda, usuarios.email, sec_poliza.id 
    from dev_products join dev_products_items on dev_products_items.id_dev_products = dev_products.id     
    join usuarios on usuarios.id = dev_products.usr_id 
    join sec_poliza on dev_products_items.id = sec_poliza.id_dev_products_item
    where dev_products_items.id = " . $id;

	$result = mysql_query($sql) or die(mysql_error());
	while ($fila = mysql_fetch_array($result)) {
		echo "<br/>";
		echo "Descrição:  " . $fila["descrip"] . "<br/>";
		echo "Data:   " . $fila["fecha"] . "<br/>";
		echo "Moeda:  " . $fila["moneda"] . "<br/>";
		echo "Usuário:  " . $fila["email"] . "<br/>";
		$id_poliza = $fila["id"];
		echo "<a href='bajarpdf.php?idpoliza=$id_poliza' >Fazer Download da Apólice</a>";
	}
}

function confirmacion($id) {

	$sql = "select dev_products_items.descrip,dev_products_items.datecompra,dev_products_items.plazo,dev_products_items.email,
dev_products_items.referencia, sec_poliza.npoliza  from dev_products_items 
join sec_poliza on dev_products_items.id = sec_poliza.id_dev_products_item
where dev_products_items.id =$id";

	$result = mysql_query($sql) or die(mysql_error());
	while ($fila = mysql_fetch_array($result)) {
		echo "<br/>";
		echo "Descrição:  " . $fila["descrip"] . "<br/>";
		echo "Data:   " . $fila["datecompra"] . "<br/>";
		echo "Prazo:  " . $fila["plazo"] . "<br/>";
		echo "Usuário:  " . $fila["email"] . "<br/>";
		$id_poliza = $fila["npoliza"];
		echo "<a href='bajarpdf.php?idpoliza=$id_poliza' >Fazer Download da Apólice</a>";
	}
}

function leerusuario($id) {
	$sql = "select id,nombres,apellidos,cedula,telefono,direccion,email from usuarios where id=" . $id;
	$result = mysql_query($sql) or die(mysql_error());
	$fila = mysql_fetch_array($result);
	$datos['id'] = $fila[0];
	$datos['nombre'] = $fila[1];
	$datos['apellido'] = $fila[2];
	$datos['cedula'] = $fila[3];
	$datos['telefono'] = $fila[4];
	$datos['direccion'] = $fila[5];
	$datos['email'] = $fila[6];
	echo json_encode($datos);
}

function cargarestados($pais) {
	$sql = "select RegionID, code from PAIS_Regions where CountryID = (select CountryID from PAIS_Countries where FIPS104 = '" . $pais . "') order by code asc";
	$res = mysql_query($sql) or die(mysql_error());
	echo "<select id='estado' name='estado'>";

	echo "<option disabled='disabled' value='Selecionar' selected>Selecionar</option>";
	while ($fila = mysql_fetch_assoc($res)) {
		echo "<option value=" . $fila["RegionID"] . ">" . $fila["code"] . "</option>";
	}
	echo "</select>";
}

function createRadio($name, $options, $default = '', $pos, $precio) {
	$name = htmlentities($name);
	$html = '';
	$_SESSION["plazo"] = 1;
	foreach ($options as $value => $label) {
		$value = htmlentities($value);
		$html .= '<input type="radio" ';
		if ($value == $default) {
			$html .= ' checked="checked" ';
		};
		$html .= ' name="' . $name . $pos . '" id="' . $name . $pos . '" value="' . $value . '" onclick="plazos(' . $pos . ',' . $precio . ')"; />' . $label . '<br />' . "\n";
	};
	return $html;
}

function loadinfouser($idusr) {
	$sql = "select * from usuarios where id = $idusr ";
	$result = mysql_query($sql);

	$field1 = mysql_result($result, 0, "nombres");
}

function quitarAcentos($text) {
	$text = htmlentities($text, ENT_QUOTES, 'UTF-8');
	$text = strtolower($text);
	$patron = array(
	// Espacios, puntos y comas por guion
	'/[\.,]+/' => '-',
	// Vocales
	'/&agrave;/' => 'a', '/&egrave;/' => 'e', '/&igrave;/' => 'i', '/&ograve;/' => 'o', '/&ugrave;/' => 'u', '/&aacute;/' => 'a', '/&eacute;/' => 'e', '/&iacute;/' => 'i', '/&oacute;/' => 'o', '/&uacute;/' => 'u', '/&acirc;/' => 'a', '/&ecirc;/' => 'e', '/&icirc;/' => 'i', '/&ocirc;/' => 'o', '/&ucirc;/' => 'u', '/&atilde;/' => 'a', '/&etilde;/' => 'e', '/&itilde;/' => 'i', '/&otilde;/' => 'o', '/&utilde;/' => 'u', '/&auml;/' => 'a', '/&euml;/' => 'e', '/&iuml;/' => 'i', '/&ouml;/' => 'o', '/&uuml;/' => 'u', '/&auml;/' => 'a', '/&euml;/' => 'e', '/&iuml;/' => 'i', '/&ouml;/' => 'o', '/&uuml;/' => 'u',
	// Otras letras y caracteres especiales
	'/&aring;/' => 'a', '/&ntilde;/' => 'n',
	// Agregar aqui mas caracteres si es necesario
	);

	$text = preg_replace(array_keys($patron), array_values($patron), $text);
	return $text;
}

function leeridRSA($id_item) {

	$sql = "select id_RSA from SEG_Tipo_disp where id_tipo in (
select id_tipo from SEG_Planes where id_plan in ( 
select dev_products_items.id_item from dev_products_items where id = $id_item))";
	$res = mysql_query($sql) or die(mysql_error());

	while ($fila = mysql_fetch_assoc($res)) {
		return $fila['id_RSA'];
	}
}

function leercodeRSA($id_item) {

	$sql = "select code_plan from SEG_Tipo_disp where id_tipo in (
select id_tipo from SEG_Planes where id_plan in ( 
select dev_products_items.id_item from dev_products_items where id = $id_item))";
	$res = mysql_query($sql) or die(mysql_error());

	while ($fila = mysql_fetch_assoc($res)) {
		return $fila['code_plan'];
	}
}


function notifrsa($npoliza, $idusr_long, $namelong, $addrlong, $barriolong, $ciudadlong, $estadolong, $ziplong, $telefonolong, $legallong, $cedulalong, $iditem, $referencialong, $precioprod, $preciolong, $datecompra, $datefactura, $plazolong, $notafiscallong) {

	//Header
	$contenido = "H";
	//Type
	$contenido .= date("Ymd");
	//Processing date
	$contenido .= date("Ym") . "01";
	//Period
	$contenido .= $npoliza;
	//"00000001"; //Sequential file (8)
	$descrip = "REMESSA";
	//Description
	$dif = 20 - strlen($descrip);
	$contenido .= strtoupper($descrip);
	for ($i = 1; $i <= $dif; $i++)
		$contenido .= ' ';
	$contenido .= "000000000000000000";
	//Policy RSA
	$contenido .= "                                                                                                                                                                                                                                                                                                                                                                                               ";
	//Filler
	$contenido .= "00000001";
	//Sequential
	$contenido .= "\n";

	//Detail
	$contenido .= "D";
	//Type
	$contenido .= $idusr_long;
	//Certificate (10)
	$client_name = strtoupper(quitarAcentos($namelong));
	//Client's name (50)
	$dif = 50 - strlen($client_name);
	$contenido .= strtoupper($client_name);
	for ($i = 1; $i <= $dif; $i++)
		$contenido .= ' ';
	$Address = $addrlong;
	//Address (50)
	$dif = 50 - strlen($Address);
	$contenido .= strtoupper($Address);
	for ($i = 1; $i <= $dif; $i++)
		$contenido .= ' ';
	$Neighborhood = strtoupper(htmlentities($barriolong));
	//Neighborhood size20
	$dif = 20 - strlen($Neighborhood);
	$contenido .= $Neighborhood;
	for ($i = 1; $i <= $dif; $i++)
		$contenido .= ' ';
	$City = strtoupper(quitarAcentos($ciudadlong));
	//City size20
	$dif = 20 - strlen($City);
	$contenido .= $City;
	for ($i = 1; $i <= $dif; $i++)
		$contenido .= ' ';
	$State = $estadolong;
	//State size2
	$dif = 2 - strlen($State);
	$contenido .= $State;
	for ($i = 1; $i <= $dif; $i++)
		$contenido .= ' ';
	$Zip = $ziplong;
	//Zip size8
	$dif = 8 - strlen($Zip);
	$contenido .= $Zip;
	for ($i = 1; $i <= $dif; $i++)
		$contenido .= ' ';
	$Telefono = $telefonolong;
	//Phone Number 11
	$dif = 11 - strlen($Telefono);
	$contenido .= $Telefono;
	for ($i = 1; $i <= $dif; $i++)
		$contenido .= ' ';
	$Legal = $legallong;
	//Legal entity or natural person 1
	$dif = 1 - strlen($Legal);
	$contenido .= $Legal;
	for ($i = 1; $i <= $dif; $i++)
		$contenido .= ' ';
	$Cedula = $cedulalong;
	//ID Person 14
	$dif = 14 - strlen($Cedula);
	$contenido .= $Cedula;
	for ($i = 1; $i <= $dif; $i++)
		$contenido .= ' ';
	$contenido .= leeridRSA($iditem);
	//Product code
	$Descripcion = strtoupper($referencialong);
	//Description (brand, model) size50
	$dif = 50 - strlen($Descripcion);
	$contenido .= $Descripcion;
	for ($i = 1; $i <= $dif; $i++)
		$contenido .= ' ';
	$Valor = $precioprod;
	//Product price 11
	$dif = 11 - strlen($Valor);
	$contenido .= $Valor;
	for ($i = 1; $i <= $dif; $i++)
		$contenido .= ' ';

	$Premium = $preciolong;
	////Insurance premium 11
	$dif = 11 - strlen($Premium);
	$contenido .= $Premium;
	for ($i = 1; $i <= $dif; $i++)
		$contenido .= ' ';

	$Precio = $preciolong;
	////Insurance cost 11
	$dif = 11 - strlen($Precio);
	$contenido .= $Precio;
	for ($i = 1; $i <= $dif; $i++)
		$contenido .= ' ';
	$contenido .= '             ';
	//Filler
	$contenido .= $datecompra;
	//Sales date 8
	$contenido .= $datefactura;
	//Invoice date 8
	$contenido .= '             ';
	//Filler
	$contenido .= "000000000";
	//Address 9
	$contenido .= '                    ';
	//Filler
	$contenido .= 'A';
	//Status of the certificate
	$contenido .= '        ';
	//Cancellation date
	$contenido .= '         ';
	//Filler
	$contenido .= '00000000000';
	//Value range of the equipment 11
	$contenido .= leercodeRSA($iditem);
	//Code Plan RSA 3
	$contenido .= substr(leeridRSA($iditem), -4);
	//Type of equipment 4
	$contenido .= '                                                             ';
	//Filler
	$contenido .= $plazolong;
	//Installments number

	$nfiscal = $notafiscallong;
	////Nota fiscal 30
	$dif = 30 - strlen($nfiscal);
	$contenido .= $nfiscal;
	for ($i = 1; $i <= $dif; $i++)
		$contenido .= ' ';

	$contenido .= '00000002';
	//Sequential
	$contenido .= "\n";

	//Trailer
	$contenido .= "T";
	//Type
	$contenido .= date("Ymd");
	//Date of dispatch
	$contenido .= '00000003';
	//Lines total
	$contenido .= '                                                                                                                                                                                                                                                                                                                                                                                                                                           ';
	//Filler
	$contenido .= '00000003';
	//Sequential
	$contenido .= "\n";

	$fecha = date("Ymd_His");
	$nombrefile = "..//rsa//rsa_" . $fecha . $npoliza . ".txt";

	$archivo = fopen($nombrefile, "w+");

	if (is_writable($nombrefile)) {
		fwrite($archivo, $contenido);
		fclose($archivo);
		echo "File written - " . $nombrefile;
	} else {
		echo "The file $nombrefile is not writable";
	}

	//checking connection
	//$ftp_server = "ftp.royalsun.com.br";
	//$ftp_user = "afinext";
	//$ftp_pass = "Af!12Rsa";
	//
	//// set up a connection or die
	//$conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server");
	//
	//// try to login
	//if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
	//    echo "Connected as $ftp_user@$ftp_server\n";
	//} else {
	//    echo "Couldn't connect as $ftp_user\n";
	//}
	//
	//// close the connection
	//ftp_close($conn_id);
	//Sending txt file via FTP
	//$connection = ftp_connect($ftp_server);
	//
	//$login = ftp_login($connection, $ftp_user, $ftp_pass);
	//
	//if (!$connection || !$login) { die('Connection attempt failed!'); }
	//
	//$source = "rsa_20120825_095826.txt";
	//$dest = "test.txt";
	//
	//$upload = ftp_put($connection, $dest, $source, FTP_BINARY);
	//
	//if (!$upload) { echo 'FTP upload failed!'; }
	//
	//ftp_close($connection);
}
?>