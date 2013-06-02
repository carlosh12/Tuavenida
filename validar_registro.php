<?php

include("includes/init-inc.php");

/* RECEIVE VALUE */
$validateValue=$_REQUEST['fieldValue'];
$validateId=$_REQUEST['fieldId'];

        $arrayToJs = array();
	$arrayToJs[0] = $validateId;

    $result = mysql_query('SELECT email FROM usuarios WHERE email=\'' . $validateValue . '\'');
    if (mysql_num_rows($result)>0){
        $arrayToJs[1] = false;			// RETURN TRUE
	echo json_encode($arrayToJs);			// RETURN ARRAY WITH success

    }
    else
    {
        for($x=0;$x<1000000;$x++){
		if($x == 990000){
			$arrayToJs[1] = true;
			echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR
		}
	}
    }
    
?>