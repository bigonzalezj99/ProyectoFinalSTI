<?php
    session_start();
    if(!isset($_SESSION['administrador']) && !isset($_SESSION['usuario'])){
        header("location: ../inicio.php");
    }

    ob_start();
    require_once '../../controllers/conexion.php';
    $db_connection = oci_connect($db_esquema, $db_password, $db_instance);

    if(!$db_connection){
        echo "Conexion sin exito a Oracle...";
        $m = oci_error();
        echo $m['message'], "n";
        exit;
    }
    else{
        // Transmisiones
        $selectTransmicion = oci_parse($db_connection, "SELECT tipotransmicionvehiculo.idtipotransmicionvehiculo, tipotransmicionvehiculo.transmicion FROM tipotransmicionvehiculo");
        $executeTransmicion = oci_execute($selectTransmicion);
        $templateTransmicion = "";
        while($fila = oci_fetch_array($selectTransmicion, OCI_ASSOC + OCI_RETURN_NULLS)){
            $boolPrint = false;
            foreach($fila AS $key => $elemento){
                if($boolPrint === false){
                    $boolPrint = true;
                }
                else{
                    $templateTransmicion .= "<option value='".$fila["IDTIPOTRANSMICIONVEHICULO"]."'>". ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") ."</option>";
                }
            }
        }

        // Tipo
        $selectTipo = oci_parse($db_connection, "SELECT tipovehiculo.idtipovehiculo, tipovehiculo.tipo FROM tipovehiculo");
        $executeTipo = oci_execute($selectTipo);
        $templateTipo = "";
        while($fila = oci_fetch_array($selectTipo, OCI_ASSOC + OCI_RETURN_NULLS)){
            $boolPrint = false;
            foreach($fila AS $key => $elemento){
                if($boolPrint === false){
                    $boolPrint = true;
                }
                else{
                    $templateTipo .= "<option value='".$fila["IDTIPOVEHICULO"]."'>". ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") ."</option>";
                }
            }
        }

        // Marca
        $selectMarca = oci_parse($db_connection, "SELECT marcavehiculo.idmarcavehiculo, marcavehiculo.marca FROM marcavehiculo");
        $executeMarca = oci_execute($selectMarca);
        $templateMarca = "";
        while($fila = oci_fetch_array($selectMarca, OCI_ASSOC + OCI_RETURN_NULLS)){
            $boolPrint = false;
            foreach($fila AS $key => $elemento){
                if($boolPrint === false){
                    $boolPrint = true;
                }
                else{
                    $templateMarca .= "<option value='".$fila["IDMARCAVEHICULO"]."'>". ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") ."</option>";
                }
            }
        }

        $strPriceForm = "";
        $strPriceTo = "";
        $strTransmition = "";
        $strVehicleType = "";
        $strBrand = "";
        
        $strFilter = "";
        $boolHasFilter = 0;

        if(isset($_GET["btnP"])){
            $boolHasFilter = 1; //Se ha presionado el boton para realizar una busqueda
        }

        if(isset($_GET["pF"])){
            $strPriceForm = $_GET["pF"]; //priceForm --> Precio desde
            $strFilter .= " AND PRECIO >= '$strPriceForm' ";
        }

        if(isset($_GET["pT"])){
            $strPriceTo = $_GET["pT"]; //priceTt --> Precio hasta
            $strFilter .= " AND v.PRECIO <= '$strPriceTo' ";
        }

        if(isset($_GET["Tr"])){
            $strTransmition = $_GET["Tr"]; //Transmition --> Transmision
            $strFilter .= " AND v.IDTIPOTRANSMICIONVEHICULO = '$strTransmition' ";
        }

        if(isset($_GET["vT"])){
            $strVehicleType = $_GET["vT"]; //vehicleType --> Tipo vehiculo
            $strFilter .= " AND v.IDTIPOVEHICULO = '$strVehicleType' ";
        }

        if(isset($_GET["Br"])){
            $strBrand = $_GET["Br"]; //Brand --> Marca
            $strFilter .= " AND v.IDMARCAVEHICULO = '$strBrand' ";
        }

        if(!empty($strFilter)){
            $boolHasFilter = 1;
        }

        if($boolHasFilter){
            $selectBranchOffice = oci_parse($db_connection, "SELECT v.idvehiculos, v.descripcion, v.precio, tp.transmicion, t.tipo, m.marca, v.imagen
                                                                FROM vehiculo v
                                                                INNER JOIN tipotransmicionvehiculo tp ON v.idtipotransmicionvehiculo = tp.idtipotransmicionvehiculo
                                                                INNER JOIN tipovehiculo t ON v.idtipovehiculo = t.idtipovehiculo
                                                                INNER JOIN marcavehiculo m ON v.idmarcavehiculo = m.idmarcavehiculo
                                                                INNER JOIN estadovehiculo e ON v.idestadovehiculo = e.idestadovehiculo 
                                                            WHERE v.IDESTADOVEHICULO = '2' $strFilter 
                                                            ORDER BY v.idvehiculos");
            $executeBranchOffice = oci_execute($selectBranchOffice);
        }
        ?>
        <script>
            let boolHasFilter = "<?= $boolHasFilter ?>";
        </script>
        <head>
            <title>Cotizaciones</title>
            <link rel="icon" type="image/png" href="../../imgs/cotizacion.png" />
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <link rel="stylesheet" type="text/css" href="../styles/style.css" />
            <link rel="stylesheet" type="text/css" href="css/navTabs.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
            <link rel="stylesheet" href="../../icons/font-awesome/css/font-awesome.min.css" />
            <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css" />
        </head>
        <body class="bodyInicio">
            <?php include('../cabecera.php'); ?>
            <div class="contPage">
            <div class="titlePage">
                Cotizaciones
            </div>

            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#busqueda">Búsqueda</a></li>
                <li><a data-toggle="tab" href="#cotizacion">Mi Cotización</a></li>
            </ul>
            
            <div class="tab-content">
                <div id="busqueda" class="tab-pane fade in active show">
                    <h3 class="titleTabPane">Búsqueda</h3>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label><strong>Precio desde:</strong></label>
                            <input type="number" name="txt_precioDesde" id="txt_precioDesde" class="form-control" step="0.01">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label><strong>Precio hasta:</strong></label>
                            <input type="number" name="txt_precioHasta" id="txt_precioHasta" class="form-control" step="0.01">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label><strong>Transmisión:</strong></label>
                            <select type="number" name="txt_transmision" id="txt_transmision" class="form-control">
                                <option value="0" disabled selected>Seleccione una opción</option>
                                <?php print $templateTransmicion?>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label><strong>Tipo de vehículo:</strong></label>
                            <select type="number" name="txt_tipo" id="txt_tipo" class="form-control">
                                <option value="0" disabled selected>Seleccione una opción</option>
                                <?php print $templateTipo?>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label><strong>Marca:</strong></label>
                            <select type="number" name="txt_marca" id="txt_marca" class="form-control">
                                <option value="0" disabled selected>Seleccione una opción</option>
                                <?php print $templateMarca?>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 divBtnSearch" style="display: flex; align-items: flex-end;">
                            <button id="btnSearch" name="btnSearch" class="btn btn-primary">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                Buscar
                            </button>&nbsp;&nbsp;
                            <button id="btnClear" name="btnClear" class="btn btn-warning">
                                <i class="fa fa-eraser" aria-hidden="true"></i>
                                Limpiar
                            </button>
                        </div>
                    </div>
                    <div id="divTableInfoFiltered" class="divTableInfoFiltered">
                        <?php 
                            if($boolHasFilter){
                            ?>
                                <table id="tableVehiculos" class="tableVehiculos">
                                    <thead>
                                        <tr>
                                            <th>Descripción</th>
                                            <th>Precio</th>
                                            <th>Transmisión</th>
                                            <th>Tipo</th>
                                            <th>Marca</th>
                                            <th>Imagen</th>
                                            <th>Ver imagen</th>
                                            <th>Agregar a cotizacion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        while ($fila = oci_fetch_array($selectBranchOffice, OCI_ASSOC + OCI_RETURN_NULLS)) {
                                            print "<tr id='idTr_".$fila["IDVEHICULOS"]."' class='idTrClass'>\n";
                                            $boolPrint = false;
    
                                            foreach ($fila AS $key => $elemento) {
                                                if ($boolPrint === false) {
                                                    $boolPrint = true;
                                                } else {
                                                    if ($key === "IMAGEN") {
                                                        print "<td id='".$key."_".$fila["IDVEHICULOS"]."'>\n";
                                                        print "<img id='tdImgView_".$fila["IDVEHICULOS"]."' src='../../var/".$elemento."' alt='img' class='imgPreviewTable'/>";
                                                        print "</td>\n";
                                                    } else {
                                                        print "<td id='".$key."_".$fila["IDVEHICULOS"]."'>". ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") ."</td>\n";
                                                    }
                                                }
                                            }
                                            print "<td width='8%'>
                                                    <button id='btnView_".$fila["IDVEHICULOS"]."' class='btn btn-primary btnView'>
                                                        <i class='fa fa-eye' aria-hidden='true'></i>
                                                    </button>
                                                   </td>
                                                   <td width='8%'>
                                                    <button id='btnSelect_".$fila["IDVEHICULOS"]."' class='btn btn-success btnSelect'>
                                                        <i class='fa fa-plus' aria-hidden='true'></i>
                                                    </button>
                                                </td>";
                                            print "</tr>\n";
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            <?php
                            }
                        ?>
                    </div>
                </div>
                <div id="cotizacion" class="tab-pane fade">
                    <i><p style ="color: #818080">Puede arrastrar las tarjetas si desea reordenar</p></i>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <h3 class="titleTabPane">Cotización</h3>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="text-align: right;">
                            <button id="btnPrintImage" name="btnPrintImage" class="btn btn-success">
                                <i class="fa fa-file-image-o" aria-hidden="true"></i>
                                Imprimir imagen
                            </button>
                        </div>
                    </div>
                    <div id="divToCards" class="row divToCards" style="margin-bottom: 5%"></div>
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
        <?php
            if($boolHasFilter){
                ?>
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
                <?php
            }
        ?>
        <script src="js/Sortable.js"></script>
        <script type="text/javascript" charset="utf8" src="js/events.js"></script>

        <script type="text/javascript" charset="utf8" src="js/html2canvas/html2canvas.esm.js"></script>
        <script type="text/javascript" charset="utf8" src="js/html2canvas/html2canvas.js"></script>
        <script type="text/javascript" charset="utf8" src="js/html2canvas/html2canvas.min.js"></script>

        </body>
        <?php
        oci_free_statement($selectTransmicion);
        oci_free_statement($selectTipo);
        oci_free_statement($selectMarca);
        if(isset($selectBranchOffice)){
            oci_free_statement($selectBranchOffice);
        }
        oci_close($db_connection);
    }
?>