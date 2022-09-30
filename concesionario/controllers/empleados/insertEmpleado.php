<?php
    require_once '../conexion.php';
    $db_connection = oci_connect($db_esquema, $db_password, $db_instance);
    
    if (!$db_connection) {
        echo "Conexion sin exito a Oracle...";
        $m = oci_error();
        echo $m['message'], "n";
        exit;
    } else {
        $strId = $_GET["id"];
        $strNombres = $_GET["nombres"];
        $strApellidos = $_GET["apellidos"];
        $strDireccion = $_GET["direccion"];
        $strDpi = $_GET["dpi"];
        $strTelefono = $_GET["telefono"];
        $strIdUsuario = $_GET["idusuario"];
        $strIdCargo = $_GET["idcargo"];
        $strTotalVentas = $_GET["totalventas"];
        $isUpdate = $_GET["update"];

        if ($isUpdate === "N") {
            $objInsertEmpleado = oci_parse($db_connection, "INSERT INTO CONCESIONARIA.EMPLEADO(IDEMPLEADO, NOMBRES, APELLIDOS, DIRECCION, DPI, TELEFONO, IDUSUARIO, IDCARGO, TOTALVENTAS) VALUES('".$strId."','".$strNombres."', '".$strApellidos."', '".$strDireccion."', '".$strDpi."', '".$strTelefono."', '".$strIdUsuario."', '".$strIdCargo."', '".$strTotalVentas."')");
        }
        elseif ($isUpdate === "Y") {
            $objInsertEmpleado = oci_parse($db_connection, "UPDATE EMPLEADO SET NOMBRES = '".$strNombres."', APELLIDOS = '".$strApellidos."', DIRECCION = '".$strDireccion."', DPI = '".$strDpi."', TELEFONO = '".$strTelefono."', TOTALVENTAS = '".$strTotalVentas."' WHERE IDEMPLEADO = '".$strId."'");
        }

        $boolInsert = oci_execute($objInsertEmpleado);
        ?>
        <link rel="stylesheet" href="../../tienda/css/sweetalert2.min.css" />
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../../tienda/js/jquery-3.4.1.min.js"></script>
        <script src="../../tienda/js/bootstrap.min.js"></script>
        <script src="../../tienda/js/sweetalert2.min.js"></script>
        <?php
        if ($boolInsert) {
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
                        window.location.href="../../views/empleados/empleados.php";
                    });
                }, 1000);
            </script>
            <?php
        } else {
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
                        window.location.href="../../views/empleados/empleados.php";
                    });
                }, 1000);
            </script>
            <?php
        }
    }
?>