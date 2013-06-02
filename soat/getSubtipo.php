<?php
include("../includes/cnx.php");
include("../includes/funciones.php");
// Tomamos los parametros de Array
$clase = $_GET['id'];
$query = "select id, subclase from SOAT_SUBCLASES where id_clases = $clase";
//  Obtenemos los resultados
$result = mysql_query($query);
$items = array();
if ($result && mysql_num_rows($result) > 0) {
    while ($row = mysql_fetch_array($result)) {
        $items[] = array($row[0], htmlentities($row[1]));
    }
}
echo json_encode($items);
?>

