
<?php
include("includes/cnx.php");

 if(isset($_POST["idestado"]))
 {
    $sql = "select CityId, City from PAIS_Cities where RegionID = " .$_POST["idestado"];
    $res = mysql_query($sql) or die(mysql_error());
    
    while ($fila = mysql_fetch_assoc($res)) {
       echo "<option value='".$fila['CityId']."'>". htmlentities($fila['City']). "</option>";
    }
 }
 
?>
