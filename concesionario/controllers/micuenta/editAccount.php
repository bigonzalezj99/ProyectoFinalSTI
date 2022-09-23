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
        $strEmail = $_GET["email"];
        $strPass = $_GET["pass"];
        $strName = $_GET["name"];
        $strSurname = $_GET["surname"];
        $strDirection = $_GET["direction"];
        $strNit = $_GET["nit"];
        $strPhone = $_GET["phone"];
        
        $objUpdateUser = oci_parse($db_connection, "UPDATE USUARIO SET EMAIL = '".$strEmail."', PASSWORD = '".$strPass."' WHERE IDUSUARIO = '".$strId."'");
        $boolUpUser = oci_execute($objUpdateUser);

        $objUpdateClient = oci_parse($db_connection, "UPDATE CLIENTE SET NOMBRES = '".$strName."', APELLIDOS = '".$strSurname."', DIRECCION = '".$strDirection."', NIT = '".$strNit."', TELEFONO = '".$strPhone."' WHERE IDUSUARIO = '".$strId."'");
        $boolUpClient = oci_execute($objUpdateClient);
        ?>
        <link rel="stylesheet" href="../../tienda/css/sweetalert2.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../../tienda/js/jquery-3.4.1.min.js"></script>
        <script src="../../tienda/js/bootstrap.min.js"></script>
        <script src="../../tienda/js/sweetalert2.min.js"></script>
        <?php
        if($boolUpUser && $boolUpClient){
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
                        window.location.href="../../views/micuenta/micuenta.php";
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
                        window.location.href="../../views/micuenta/micuenta.php";
                    });
                }, 1000);
            </script>
            <?php
        }
    }
?>