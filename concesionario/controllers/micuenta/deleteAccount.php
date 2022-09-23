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
        $objDeleteClient = oci_parse($db_connection, "DELETE FROM CLIENTE WHERE IDUSUARIO = '".$strId."'");
        $boolDeleteClient = oci_execute($objDeleteClient);

        $objDeleteAccount = oci_parse($db_connection, "DELETE FROM USUARIO WHERE IDUSUARIO = '".$strId."'");
        $boolDeleteAccount = oci_execute($objDeleteAccount);

        ?>
        <link rel="stylesheet" href="../../tienda/css/sweetalert2.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../../tienda/js/jquery-3.4.1.min.js"></script>
        <script src="../../tienda/js/bootstrap.min.js"></script>
        <script src="../../tienda/js/sweetalert2.min.js"></script>
        <?php
        if($boolDeleteClient && $boolDeleteAccount){
            ?>
            <script>
                setTimeout(() => {
                    Swal.fire({
                        type: 'success',
                        title: 'Cuenta Eliminada',
                        text: 'Su cuenta ha sido eliminada. Lamentamos que haya abandonado el sistema.',
                        button: "Regresar"
                    })
                    .then((value) => {
                        window.location.href="../../index.php";
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
                        text: 'Hubo un problema al eliminar el registro.',
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