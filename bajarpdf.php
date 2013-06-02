<?php
include("includes/cnx.php");

                    $sql = "select pdf from sec_poliza where id = " . $_GET['idpoliza'];
                    $result = mysql_query($sql);
                    $rs = mysql_fetch_assoc($result);
                    $content = $rs['pdf'];
                    header('Content-Type: application/pdf');
                    header("Content-Length: ".strlen($content));
                    header('Content-Disposition: attachment; filename=poliza_tuavenida.pdf');
                    echo $content;
                    
?>

