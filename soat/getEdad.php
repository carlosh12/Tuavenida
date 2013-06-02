<?php
include("../includes/cnx.php");
include("../includes/funciones.php");
$subclase = $_GET['id'];
$query = "select id, edad from SOAT_EDADES WHERE id_subclases = '$subclase'";
$result = mysql_query($query);
$items = array();
if ($result && mysql_num_rows($result) > 0) {
    while ($row = mysql_fetch_array($result)) {
        $items[] = array($row[0], htmlentities($row[1]));
    }
}
echo json_encode($items);
?>

