<?php
session_start();

if (!isset($_SESSION['administrador'])) {
    header("location: ../inicio.php");
}

ob_start();
require_once '../../controllers/conexion.php';
$db_connection = oci_connect($db_esquema, $db_password, $db_instance);

if (!$db_connection) {
	echo "Conexion sin exito a Oracle...";
	$m = oci_error();
	echo $m['message'], "n";
	exit;
} else {
    //$selectBranchOffice = oci_parse($db_connection, "SELECT usuario.idusuario, usuario.email, usuario.password, rol.rol FROM usuario INNER JOIN rol ON usuario.idrol = rol.idrol WHERE rol.idrol = 3");
    $selectBranchOffice = oci_parse($db_connection,"SELECT usuario.idusuario, usuario.email, usuario.password, rol.rol FROM usuario INNER JOIN rol ON usuario.idrol = rol.idrol WHERE rol.idrol = 1 ORDER BY idusuario");
    $executeBranchOffice = oci_execute($selectBranchOffice);
    ?>
    <head>
        <title>Empleados</title>
        <link rel="icon" type="image/png" href="../../imgs/empleadosIcon.png" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" type="text/css" href="../styles/style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <link rel="stylesheet" href="../../icons/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css" />
    </head>
    <body class="bodyInicio">
        <?php include('../cabecera.php'); ?>
        <div class="contPage">
        <div class="titlePage">
            Administración de empleados
        </div>
        <br><br>
        <div class="text-justify marginBottom">
            <div class="row" style="align-items: center;">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="text-align: right;">
                    <button id="btnAddNew" class="btn btn-primary">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Nuevo
                    </button>
                </div>
            </div>
            <br>
            <div class="tableInfo">
                <table id="tableUsuarios" class="tableUsuarios">
                    <thead>
                        <tr>
                            <th>Correo electrónico</th>
                            <th>Contraseña</th>
                            <th>Rol</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($fila = oci_fetch_array($selectBranchOffice, OCI_ASSOC + OCI_RETURN_NULLS)) {
                                print "<tr id='idTr_".$fila["IDUSUARIO"]."' class='idTrClass'>\n";
                                $boolPrint = false;

                                foreach ($fila AS $key => $elemento) {
                                    if($boolPrint === false){
                                        $boolPrint = true;
                                    } else {
                                        print "<td id='".$key."_".$fila["IDUSUARIO"]."'>". ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") ."</td>\n";   
                                    }
                                }
                                print "<td>
                                        <button id='btnEdit_".$fila["IDUSUARIO"]."' class='btn btn-primary btnEdit'>
                                            <i class='fa fa-pencil-square-o' aria-hidden='true'></i>
                                        </button>
                                        <button id='btnDelete_".$fila["IDUSUARIO"]."' class='btn btn-danger btnDelete'>
                                            <i class='fa fa-trash' aria-hidden='true'></i>
                                        </button>
                                    </td>";
                                print "</tr>\n";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="modalForm" class="modalForm">
            <div class="modal-content">
                <span id="close" class="closeModal">&times;</span>
                <div id="modalBody" class="modalBody"></div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            setTimeout(() => {
                let tableUsuarios = $('#tableUsuarios');
                tableUsuarios.DataTable({
                    responsive: true,
                    "language": {
                        "lengthMenu": "Mostrando _MENU_ registros por página",
                        "zeroRecords": "No hay registros",
                        "info": "Mostrando página _PAGE_ de _PAGES_",
                        "infoEmpty": "No hay registros disponibles",
                        "infoFiltered": "(Filtrado de _MAX_ registros)",
                        "search": " ",
                        "searchPlaceholder": "Buscar",
                        "paginate": {
                            "first": "Primero",
                            "last": "Último",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    }
                });
            }, 10);
        });
    </script>    
    <script type="text/javascript" charset="utf8" src="js/modal.js"></script>
    </body>
    <?php
    oci_free_statement($selectBranchOffice);
    oci_close($db_connection);
}

?>