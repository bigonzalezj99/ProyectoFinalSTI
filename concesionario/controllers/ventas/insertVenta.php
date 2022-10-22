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
        $strFecha = $_GET["fecha"];
        $strIdCliente = $_GET["idcliente"];
        $isUpdate = $_GET["update"];

        if ($isUpdate === "N") {
            $objInsertVenta = oci_parse($db_connection, "INSERT INTO CONCESIONARIA.VENTA(IDVENTA, FECHA, IDCLIENTE) VALUES('".$strId."','".$strFecha."', '".$strIdCliente."')");
        }

        $boolInsert = oci_execute($objInsertVenta);
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
                        window.location.href="../../views/ventas/ventas.php";
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
                        window.location.href="../../views/ventas/ventas.php";
                    });
                }, 1000);
            </script>
            <?php
        }
    }
?>