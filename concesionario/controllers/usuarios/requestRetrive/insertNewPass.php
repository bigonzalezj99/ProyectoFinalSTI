<?php
    require_once '../../conexion.php';
    $db_connection = oci_connect($db_esquema, $db_password, $db_instance);
    
    if(!$db_connection){
        echo "Conexion sin exito a Oracle...";
        $m = oci_error();
        echo $m['message'], "n";
        exit;
    }
    else{
        $strNewPass = $_GET["newPass"];
        $strEmail = $_GET["email"];
        echo "Email: ".$strEmail."\n";
        echo "New password: ".$strNewPass;
        $objUpdatePass = oci_parse($db_connection, "UPDATE USUARIO SET PASSWORD = '".$strNewPass."' WHERE email LIKE '%".$strEmail."%'");        
        oci_execute($objUpdatePass);
        header("Location: ../../../index.php");
    }
?>