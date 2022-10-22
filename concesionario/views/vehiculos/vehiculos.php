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
        // Vehículos
        $selectBranchOffice = oci_parse($db_connection, "SELECT v.idvehiculos, 
                                                                v.descripcion, 
                                                                v.precio, 
                                                                tp.idtipotransmicionvehiculo, 
                                                                tp.transmicion, 
                                                                t.idtipovehiculo, 
                                                                t.tipo, 
                                                                m.idmarcavehiculo, 
                                                                m.marca, 
                                                                e.idestadovehiculo, 
                                                                e.estado, 
                                                                v.imagen
                                                            FROM vehiculo v
                                                            INNER JOIN tipotransmicionvehiculo tp ON v.idtipotransmicionvehiculo = tp.idtipotransmicionvehiculo
                                                            INNER JOIN tipovehiculo t ON v.idtipovehiculo = t.idtipovehiculo
                                                            INNER JOIN marcavehiculo m ON v.idmarcavehiculo = m.idmarcavehiculo
                                                            INNER JOIN estadovehiculo e ON v.idestadovehiculo = e.idestadovehiculo ORDER BY idvehiculos");
        $executeBranchOffice = oci_execute($selectBranchOffice);

        // Transmisiones
        $selectTransmicion = oci_parse($db_connection, "SELECT tipotransmicionvehiculo.idtipotransmicionvehiculo, tipotransmicionvehiculo.transmicion FROM tipotransmicionvehiculo");
        $executeTransmicion = oci_execute($selectTransmicion);
        $templateTransmicion = "";

        while ($fila = oci_fetch_array($selectTransmicion, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $boolPrint = false;

            foreach ($fila AS $key => $elemento) {
                if ($boolPrint === false) {
                    $boolPrint = true;
                } else {
                    $templateTransmicion .= "<option value='".$fila["IDTIPOTRANSMICIONVEHICULO"]."'>". ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") ."</option>";
                }
            }
        }

        // Tipo
        $selectTipo = oci_parse($db_connection, "SELECT tipovehiculo.idtipovehiculo, tipovehiculo.tipo FROM tipovehiculo");
        $executeTipo = oci_execute($selectTipo);
        $templateTipo = "";

        while ($fila = oci_fetch_array($selectTipo, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $boolPrint = false;

            foreach ($fila AS $key => $elemento) {
                if ($boolPrint === false) {
                    $boolPrint = true;
                } else {
                    $templateTipo .= "<option value='".$fila["IDTIPOVEHICULO"]."'>". ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") ."</option>";
                }
            }
        }

        // Marca
        $selectMarca = oci_parse($db_connection, "SELECT marcavehiculo.idmarcavehiculo, marcavehiculo.marca FROM marcavehiculo");
        $executeMarca = oci_execute($selectMarca);
        $templateMarca = "";

        while ($fila = oci_fetch_array($selectMarca, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $boolPrint = false;

            foreach ($fila AS $key => $elemento) {
                if ($boolPrint === false) {
                    $boolPrint = true;
                } else {
                    $templateMarca .= "<option value='".$fila["IDMARCAVEHICULO"]."'>". ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") ."</option>";
                }
            }
        }

        // Estado
        $selectEstado = oci_parse($db_connection, "SELECT estadovehiculo.idestadovehiculo, estadovehiculo.estado FROM estadovehiculo");
        $executeEstado = oci_execute($selectEstado);
        $templateEstado = "";

        while ($fila = oci_fetch_array($selectEstado, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $boolPrint = false;

            foreach ($fila AS $key => $elemento) {
                if ($boolPrint === false) {
                    $boolPrint = true;
                } else {
                    $templateEstado .= "<option value='".$fila["IDESTADOVEHICULO"]."'>". ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") ."</option>";
                }
            }
        }

        ?>
        <script>
            let templateTransmicion = "<?= $templateTransmicion ?>";
            let templateTipo = "<?= $templateTipo ?>";
            let templateMarca = "<?= $templateMarca ?>";
            let templateEstado = "<?= $templateEstado ?>";
        </script>

        <head>
            <title>Vehículos</title>
            <link rel="icon" type="image/png" href="../../imgs/vehiculoIcon.png" />
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <link rel="stylesheet" type="text/css" href="../styles/style.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
            <link rel="stylesheet" href="../../icons/font-awesome/css/font-awesome.min.css" />
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css" />
            <!-- NECESARIO PARA LA CARGA DE IMAGENES -->
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        </head>
        <body class="bodyInicio">
            <?php include('../cabecera.php'); ?>
            
            <div class="contPage">
            <div class="titlePage">
                <h1>Administración de vehículos</h1>
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
                    <table id="tableVehiculos" class="tableVehiculos">
                        <thead>
                            <tr>
                                <th hidden>No.</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Transmisión</th>
                                <th>Tipo</th>
                                <th>Marca</th>
                                <th>Estado</th>
                                <th>Imagen</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($fila = oci_fetch_array($selectBranchOffice, OCI_ASSOC + OCI_RETURN_NULLS)) {
                                print "<tr id='idTr_".$fila["IDVEHICULOS"]."' class='idTrClass'>\n";
                                $boolPrint = false;
                                $hidden = "";

                                foreach ($fila AS $key => $elemento) {
                                    if ($boolPrint === false) {
                                        $boolPrint = true;
                                        $hidden = "hidden";
                                    }
                                    else{
                                        $hidden = "";
                                    }

                                    if ($key === "IMAGEN") {
                                        print "<td id='".$key."_".$fila["IDVEHICULOS"]."'>\n";
                                        print "<img id='tdImgView_".$fila["IDVEHICULOS"]."' src='../../var/".$elemento."' alt='img' class='imgPreviewTable'/>";
                                        print "</td>\n";
                                    } else {
                                        if($key !== "IDTIPOTRANSMICIONVEHICULO" && $key !== "IDTIPOVEHICULO" && $key !== "IDMARCAVEHICULO" && $key !== "IDESTADOVEHICULO"){
                                            print "<td id='".$key."_".$fila["IDVEHICULOS"]."' $hidden>". ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") ."</td>\n";
                                        }
                                    }
                                }
                                print "<td>
                                        <button id='btnEdit_".$fila["IDVEHICULOS"]."' class='btn btn-primary btnEdit idTransV_".$fila["IDTIPOTRANSMICIONVEHICULO"]." idTipoV__".$fila["IDTIPOVEHICULO"]." idMarcaV___".$fila["IDMARCAVEHICULO"]." idEstadoV____".$fila["IDESTADOVEHICULO"]."'>
                                            <i class='fa fa-pencil-square-o' aria-hidden='true'></i>
                                        </button>
                                        <button id='btnDelete_".$fila["IDVEHICULOS"]."' class='btn btn-danger btnDelete'>
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
                    let tableVehiculos = $('#tableVehiculos');
                    tableVehiculos.DataTable({
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
        oci_free_statement($selectTransmicion);
        oci_free_statement($selectTipo);
        oci_free_statement($selectMarca);
        oci_free_statement($selectEstado);
        oci_free_statement($selectBranchOffice);
        oci_close($db_connection);
    }
?>