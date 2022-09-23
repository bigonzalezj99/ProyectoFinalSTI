<?php
session_start();

if (!isset($_SESSION['usuario'])) {
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
}
else{
    $selectUserProfile = oci_parse($db_connection, "SELECT
                                                        usuario.idusuario,
                                                        usuario.email,
                                                        usuario.password,
                                                        rol.idrol,
                                                        rol.rol,
                                                        cliente.nombres,
                                                        cliente.apellidos,
                                                        cliente.direccion,
                                                        cliente.nit,
                                                        cliente.telefono
                                                    FROM 
                                                        usuario
                                                            INNER JOIN rol ON usuario.idrol = rol.idrol
                                                            INNER JOIN cliente ON usuario.idusuario = cliente.idusuario
                                                    WHERE usuario.idusuario = '".$_SESSION['usuario']."'");
    $executeUserProfile = oci_execute($selectUserProfile);
    ?>
    <head>
        <title>Mi Cuenta</title>
        <link rel="icon" type="image/png" href="../../imgs/miCuenta.png" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" type="text/css" href="../styles/style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <link rel="stylesheet" href="../../icons/font-awesome/css/font-awesome.min.css" />
    </head>
    <body class="bodyInicio">
        <?php include('../cabecera.php'); ?>
        <div class="contPage">
            <div class="titlePage">
                Administración de perfil web
            </div>
            <br><br>
            <div class="text-justify marginBottom">
                <div id="sessionId_<?php echo $_SESSION['usuario'];?>" class="tableInfo">
                    <?php
                        while ($fila = oci_fetch_array($selectUserProfile, OCI_ASSOC + OCI_RETURN_NULLS)) {
                            $boolPrint = false;
                            foreach ($fila AS $key => $elemento) {
                                if($boolPrint === false){
                                    $boolPrint = true;
                                }
                                else{
                                    if($key !== "IDROL"){
                                        $key==="EMAIL" ? print "<strong style='font-size:24px; text-align:center;'><i><p>Datos de usuario</p></i></strong>" : ($key==="NOMBRES" ? print "<strong style='font-size:24px; text-align:center;'><i><p>Datos de Cuenta</p></i></strong>" : "");
                                        print "<div class='row' style='margin-bottom: 4%;'>";
                                        print "     <div class='col-lg-2 col-md-2 col-sm-4 col-xs-6'>";
                                        print "         <strong><label>".$key.":</label></strong>";
                                        print "     </div>";
                                        print "     <div class='col-lg-8 col-md-8 col-sm-6 col-xs-6'>";
                                        print "         <input id='".$key."' class='form-control inputDataForm' type='text' value='".($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "")."'".($key==='ROL' ? 'disabled' : '').">";
                                        print "     </div>";
                                        print "     <div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' style='text-align: center;'>";
                                        print "         <img id='imgIcon_".$fila["IDUSUARIO"]."' src='../../imgs/img_".$key.".png' alt='img' class='imgIcon'/>";
                                        print "     </div>";
                                        print "</div>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                        <button id="btnEditData" class="btn btn-primary" disabled>
                            <i class="fa fa-save" aria-hidden="true"></i>
                            Editar datos
                        </button>
                        <button id="btnDeleteAccount" class="btn btn-danger">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                            Eliminar cuenta
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="modalForm" class="modalForm">
            <div class="modal-content">
                <span id="close" class="closeModal">&times;</span>
                <div id="modalBody" class="modalBody"></div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="js/events.js"></script>
    </body>
    <?php
    oci_free_statement($selectUserProfile);
    oci_close($db_connection);
}

?>