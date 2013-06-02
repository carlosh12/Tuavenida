<?php
include("../includes/cnx.php");
include("../includes/funciones.php");
    $query = "select id,clase from SOAT_CLASES";
    $result = mysql_query($query);
    $items = array();
    if($result && 
       mysql_num_rows($result)>0) {
        while($row = mysql_fetch_array($result)) {
            $items[] = array( $row[0], $row[1] );
        }        
    }
    echo json_encode($items); 
?>
