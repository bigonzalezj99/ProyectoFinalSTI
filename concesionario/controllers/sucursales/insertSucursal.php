<?php
    require_once '../conexion.php';
    $db_connection = oci_connect($db_esquema, $db_password, $db_instance);
    
    if(!$db_connection){
        echo "Conexion sin exito a Oracle...";
        $m = oci_error();
        echo $m['message'], "n";
        exit;
    }
    else{
        $strId = $_GET["id"];
        $strDescription = $_GET["descripcion"];
        $strDireccion = $_GET["direccion"];
        $strMunicipio = $_GET["municipio"];
        $strDepartamento = $_GET["departamento"];
        $isUpdate = $_GET["update"];

        if($isUpdate === "N"){
            $objInsertSucursal = oci_parse($db_connection, "INSERT INTO CONCESIONARIA.SUCURSAL (IDSUCURSAL, DIRECCION, MUNICIPIO, DEPARTAMENTO, DESCRIPCION) VALUES ('".$strId."','".$strDireccion."', '".$strMunicipio."', '".$strDepartamento."', '".$strDescription."')");
        }
        elseif($isUpdate === "Y"){
            $objInsertSucursal = oci_parse($db_connection, "UPDATE SUCURSAL SET DIRECCION = '".$strDireccion."', MUNICIPIO = '".$strMunicipio."', DEPARTAMENTO = '".$strDepartamento."', DESCRIPCION = '".$strDescription."' WHERE IDSUCURSAL = '".$strId."'");
        }
        $boolInsert = oci_execute($objInsertSucursal);
        ?>
        <link rel="stylesheet" href="../../tienda/css/sweetalert2.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../../tienda/js/jquery-3.4.1.min.js"></script>
        <script src="../../tienda/js/bootstrap.min.js"></script>
        <script src="../../tienda/js/sweetalert2.min.js"></script>
        <?php
        if($boolInsert){
            ?>
            <script>
                setTimeout(() => {
                    Swal.fire({
                        type: 'success',
                        title: 'Datos ingresados',
                        text: 'Los datos han sido registrados correctamente.',
                        button: "Regresar"
                    })
                    .then((value) => {
                        window.location.href="../../views/sucursales/sucursales.php";
                    });
                }, 1000);
            </script>
            <?php
        }
        else{
            ?>
            <script>
                setTimeout(() => {
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: 'Ha ocurrido un error al ingresar los datos.',
                        button: "Regresar"
                    })
                    .then((value) => {
                        window.location.href="../../views/sucursales/sucursales.php";
                    });
                }, 1000);
            </script>
            <?php
        }
    }
?>