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
        $srtIdTipoTransmisionVehiculo = $_GET["idtipotransmicionvehiculo"];
        $strIdTipoVehiculo = $_GET["idtipovehiculo"];
        $strIdMarcaVehiculo = $_GET["idmarcavehiculo"];
        $strIdEstadoVehiculo = $_GET["idestadovehiculo"];
        $strImagen = $_GET["imagen"];
        $isUpdate = $_GET["update"];
        $newStrImagen = "vehiculos/".substr($strImagen,12);

        if($isUpdate === "N"){
            $objInsertVehiculo = oci_parse($db_connection, "INSERT INTO CONCESIONARIA.VEHICULO (IDVEHICULOS, DESCRIPCION, PRECIO, IMAGEN, IDTIPOTRANSMICIONVEHICULO, IDTIPOVEHICULO, IDMARCAVEHICULO, IDESTADOVEHICULO) VALUES ('".$strId."','".$strDescription."', '".$strPrecio."', '".$newStrImagen."', '".$srtIdTipoTransmisionVehiculo."', '".$strIdTipoVehiculo."', '".$strIdMarcaVehiculo."', '".$strIdEstadoVehiculo."')");
        }
        elseif($isUpdate === "Y"){
            if(!empty($strImagen)){
                //Primero se borra la imagen antigua
                $pathImage = $_GET["pathImage"];
                if(unlink($pathImage)){
                    echo $pathImage . ": Imagen eliminada correctamente del directorio";
                }
                else{
                    echo "Error al eliminar la imagen del directorio o el archivo no se encuentra";
                }
                $objInsertVehiculo = oci_parse($db_connection, "UPDATE VEHICULO SET descripcion = '".$strDescription."', precio = '".$strPrecio."', imagen = '".$newStrImagen."', idtipotransmicionvehiculo = '".$srtIdTipoTransmisionVehiculo."', idtipovehiculo = '".$strIdTipoVehiculo."', idmarcavehiculo = '".$strIdMarcaVehiculo."', idestadovehiculo = '".$strIdEstadoVehiculo."' WHERE idvehiculos = '".$strId."'");
            }
            else{
                $objInsertVehiculo = oci_parse($db_connection, "UPDATE VEHICULO SET descripcion = '".$strDescription."', precio = '".$strPrecio."', idtipotransmicionvehiculo = '".$srtIdTipoTransmisionVehiculo."', idtipovehiculo = '".$strIdTipoVehiculo."', idmarcavehiculo = '".$strIdMarcaVehiculo."', idestadovehiculo = '".$strIdEstadoVehiculo."' WHERE idvehiculos = '".$strId."'");
            }
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