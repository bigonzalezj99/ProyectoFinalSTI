<?php
    require_once '../conexion.php';
    $db_connection = oci_connect($db_esquema, $db_password, $db_instance);
    
    if(!$db_connection){
        echo "Conexion sin exito a ORACOL...";
        $m = oci_error();
        echo $m['message'], "n";
        exit;
    }
    else{
        $strId = $_GET["id"];
        $strDescription = $_GET["descripcion"];
        $strPrecio = $_GET["precio"];
        $strImagen = $_GET["imagen"];
        $srtIdTipoTransmisionVehiculo = $_GET["idtipotransmicionvehiculo"];
        $strIdTipoVehiculo = $_GET["idtipovehiculo"];
        $strIdMarcaVehiculo = $_GET["idmarcavehiculo"];
        $strIdEstadoVehiculo = $_GET["idestadovehiculo"];
        $isUpdate = $_GET["update"];

        if($isUpdate === "N"){
            $objInsertVehiculo = oci_parse($db_connection, "INSERT INTO CONCESIONARIA.VEHICULO (IDVEHICULOS, DESCRIPCION, PRECIO, IMAGEN, IDTIPOTRANSMICIONVEHICULO, IDTIPOVEHICULO, IDMARCAVEHICULO, IDESTADOVEHICULO) VALUES ('".$strId."','".$strDescription."', '".$strPrecio."', '".$strImagen."', '".$srtIdTipoTransmisionVehiculo."', '".$strIdTipoVehiculo."', '".$strIdMarcaVehiculo."', '".$strIdEstadoVehiculo."')");
        }
        elseif($isUpdate === "Y"){
            $objInsertVehiculo = oci_parse($db_connection, "UPDATE VEHICULO SET descripcion = '".$strDescription."', precio = '".$strPrecio."', imagen = '".$strImagen."', idtipotransmicionvehiculo = '".$srtIdTipoTransmisionVehiculo."', idtipovehiculo = '".$strIdTipoVehiculo."', idmarcavehiculo = '".$strIdMarcaVehiculo."', idestadovehiculo = '".$strIdEstadoVehiculo."' WHERE idvehiculos = '".$strId."'");
        }
        $boolInsert = oci_execute($objInsertVehiculo);
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
                        window.location.href="../../views/vehiculos/vehiculos.php";
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
                        window.location.href="../../views/vehiculos/vehiculos.php";
                    });
                }, 1000);
            </script>
            <?php
        }
    }
?>