<?php
    session_start();

    if (!isset($_SESSION['administrador'])) {
        header("location: ../inicio.php");
    }

    ob_start();
    require_once '../../controllers/conexion.php';
    $db_connection = oci_connect($db_esquema, $db_password, $db_instance);

    if (!$db_connection) {
        echo "Conexion sin exito a Oracol...";
        $m = oci_error();
        echo $m['message'], "n";
        exit;
    } else {
        // Versión larga de la consulta.
        $selectBranchOffice = oci_parse($db_connection, "SELECT empleado.idempleado, empleado.nombres, empleado.apellidos, empleado.direccion, empleado.dpi, empleado.telefono,
                                                                usuario.idusuario, usuario.email, usuario.password,
                                                                rol.idrol, rol.rol,
                                                                cargoempleado.idcargo, cargoempleado.cargo,
                                                                sueldoempleado.idsueldo, sueldoempleado.sueldofijo, sueldoempleado.comision, sueldoempleado.sueldototal,
                                                                empleado.totalventas
                                                                FROM empleado INNER JOIN usuario ON usuario.idusuario = empleado.idusuario
                                                                INNER JOIN rol ON rol.idrol = usuario.idrol
                                                                INNER JOIN cargoempleado ON cargoempleado.idcargo = empleado.idcargo
                                                                INNER JOIN sueldoempleado ON sueldoempleado.idsueldo = cargoempleado.idsueldo");
        
        // Versión corta de la consulta.
        //$selectBranchOffice = oci_parse($db_connection, "SELECT * FROM empleado NATURAL JOIN usuario NATURAL JOIN cargoempleado");
        $executeBranchOffice = oci_execute($selectBranchOffice);

        // Usuarios.
        $selectUsuarios = oci_parse($db_connection, "SELECT usuario.idusuario, usuario.email FROM usuario INNER JOIN rol ON rol.idrol = usuario.idrol WHERE rol.idrol IN (1,2)");
        $executeUsuarios = oci_execute($selectUsuarios);
        $templateUsuarios = "";

        while ($fila = oci_fetch_array($selectUsuarios, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $boolPrint = false;

            foreach ($fila AS $key => $elemento) {
                if ($boolPrint === false) {
                    $boolPrint = true;
                } else {
                    $templateUsuarios .= "<option value='".$fila["IDUSUARIO"]."'>". ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") ."</option>";
                }
            }
        }

        // Cargos
        $selectCargos = oci_parse($db_connection, "SELECT cargoempleado.idcargo, cargoempleado.cargo FROM cargoempleado");
        $executeCargos = oci_execute($selectCargos);
        $templateCargos = "";

        while ($fila = oci_fetch_array($selectCargos, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $boolPrint = false;

            foreach ($fila AS $key => $elemento) {
                if ($boolPrint === false) {
                    $boolPrint = true;
                } else {
                    $templateCargos .= "<option value='".$fila["IDCARGO"]."'>". ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") ."</option>";
                }
            }
        }

        // Roles.
        $selectRoles = oci_parse($db_connection, "SELECT rol.idrol, rol.rol FROM rol");
        $executeRoles = oci_execute($selectRoles);
        $templateRoles = "";

        while ($fila = oci_fetch_array($selectRoles, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $boolPrint = false;

            foreach ($fila AS $key => $elemento) {
                if ($boolPrint === false) {
                    $boolPrint = true;
                } else {
                    $templateRoles .= "<option value='".$fila["IDROL"]."'>". ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") ."</option>";
                }
            }
        }

        // Sueldos.
        $selectSueldos = oci_parse($db_connection, "SELECT sueldoempleado.idsueldo, sueldoempleado.sueldofijo, sueldoempleado.comision, sueldoempleado.sueldototal FROM sueldoempleado");
        $executeSueldos = oci_execute($selectSueldos);
        $templateSueldos = "";

        while ($fila = oci_fetch_array($selectSueldos, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $boolPrint = false;

            foreach ($fila AS $key => $elemento) {
                if ($boolPrint === false) {
                    $boolPrint = true;
                } else {
                    $templateSueldos .= "<option value='".$fila["IDSUELDO"]."'>". ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") ."</option>";
                }
            }
        }

        ?>
        <script>
            let templateUsuarios = "<?= $templateUsuarios ?>";
            let templateCargos = "<?= $templateCargos?>";
            let templateRoles = "<?= $templateRoles ?>";
            let templateSueldos = "<?= $templateSueldos ?>";
        </script>

        <head>
            <title>Empleados</title>
            <link rel="icon" type="image/png" href="../../imgs/empleadosIcon.png" />
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <link rel="stylesheet" type="text/css" href="../styles/style.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
            <link rel="stylesheet" href="../../icons/font-awesome/css/font-awesome.min.css" />
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css" />
        </head>
        <body class="bodyInicio">
            <?php include('../cabecera.php'); ?>
            <div class="contPage employeeTable">
            <div class="titlePage">
                <h1>Administración de empleados</h1>
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
                    <table id="tableEmpleados" class="tableEmpleados">
                        <thead>
                            <tr>
                                <th hidden>No.</th>
                                <!--Empleados-->
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Dirección</th>
                                <th>DPI</th>
                                <th>Teléfono</th>
                                <!--Usuario-->
                                <th>Correo electrónico</th>
                                <th>Contraseña</th>
                                <!--Rol-->
                                <th>Rol</th>
                                <!--Cargo-->
                                <th>Cargo</th>
                                <!--Sueldo-->
                                <th>Sueldo fijo</th>
                                <th>Comisión</th>
                                <th>Sueldo total</th>
                                <!--Empleados-->
                                <th>Total vendido</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while ($fila = oci_fetch_array($selectBranchOffice, OCI_ASSOC + OCI_RETURN_NULLS)) {
                                    print "<tr id='idTr_".$fila["IDEMPLEADO"]."' class='idTrClass'>\n";
                                    $boolPrint = false;
                                    $hidden = "";

                                    foreach ($fila AS $key => $elemento) {
                                        if ($boolPrint === false) {
                                            $boolPrint = true;
                                            $hidden = "hidden";
                                        } else {
                                            $hidden = "";
                                        }

                                        if ($key !== "IDUSUARIO" && $key !== "IDCARGO" && $key !== "IDROL" && $key !== "IDSUELDO") {
                                            print "<td id='".$key."_".$fila["IDEMPLEADO"]."' $hidden>". ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") ."</td>\n";   
                                        }
                                    }
                                    print "<td>
                                            <button id='btnEdit_".$fila["IDEMPLEADO"]."' class='btn btn-primary btnEdit idUsuario_".$fila["IDUSUARIO"]." idRol__".$fila["IDROL"]." idSueldos___".$fila["IDSUELDO"]."'>
                                                <i class='fa fa-pencil-square-o' aria-hidden='true'></i>
                                            </button>
                                            <button id='btnDelete_".$fila["IDEMPLEADO"]."' class='btn btn-danger btnDelete'>
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
                    let tableEmpleados = $('#tableEmpleados');
                    tableEmpleados.DataTable({
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
        oci_free_statement($selectUsuarios);
        oci_free_statement($selectCargos);
        oci_free_statement($selectRoles);
        oci_free_statement($selectSueldos);
        oci_free_statement($selectBranchOffice);
        oci_close($db_connection);
    }
?>