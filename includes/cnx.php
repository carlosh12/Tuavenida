<?php
if($link=mysql_connect("dbtuav.db.8727031.hostedresource.com","dbtuav","Tu@venidA000")){
  mysql_select_db("dbtuav");
}else{
  echo 'Error : Conexion no Establecida'; 
}

?>
