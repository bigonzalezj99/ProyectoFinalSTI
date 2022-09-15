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
        $objDeleteUsuario = oci_parse($db_connection, "DELETE FROM USUARIO WHERE IDUSUARIO = '".$strId."'");
        $boolDelete = oci_execute($objDeleteUsuario);
        ?>
        <link rel="stylesheet" href="../../tienda/css/sweetalert2.min.css" />
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../../tienda/js/jquery-3.4.1.min.js"></script>
        <script src="../../tienda/js/bootstrap.min.js"></script>
        <script src="../../tienda/js/sweetalert2.min.js"></script>

        <?php
        if ($boolDelete) {
        ?>
            <script>
                setTimeout(() => {
                    Swal.fire({
                        type: 'success',
                        title: 'Dato Eliminado',
                        text: 'El registro de ha eliminado correctamente.',
                        button: "Regresar"
                    })
                    .then((value) => {
                        window.location.href="../../views/usuarios/usuarios.php";
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
                        text: 'Hubo un problema al eliminar el registro.',
                        button: "Regresar"
                    })
                    .then((value) => {
                        window.location.href="../../views/usuarios/usuarios.php";
                    });
                }, 1000);
            </script>
            <?php
        }
    }
?>