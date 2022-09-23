<?php
require_once './controllers/conexion.php';

$db_connection = oci_connect($db_esquema, $db_password, $db_instance);

if(!$db_connection){
	echo "Conexion sin exito a Oracle...";
	$m = oci_error();
	echo $m['message'], "n";
	exit;
}
else{
	$email = utf8_decode($_POST["inputEmail"]);
	$password = utf8_decode($_POST["inputPass"]);

	if($email && $password){
		$selectAdmin = oci_parse($db_connection, "SELECT usuario.IDUSUARIO, usuario.email, usuario.password FROM usuario INNER JOIN rol ON usuario.idrol = '1' OR usuario.idrol = '2' AND rol.idrol = usuario.idrol WHERE usuario.email = '".$email."' AND usuario.password = '".$password."'");
		$selectOthers = oci_parse($db_connection, "SELECT usuario.IDUSUARIO, usuario.email, usuario.password FROM usuario INNER JOIN rol ON usuario.idrol <> '1' AND usuario.idrol <> '2' AND rol.idrol = usuario.idrol WHERE usuario.email = '".$email."' AND usuario.password = '".$password."'");

		$intAdmin = oci_execute($selectAdmin);
		$intOther = oci_execute($selectOthers);

		$strAdmin = oci_fetch_all($selectAdmin, $res);
		$strAdmin = oci_fetch_all($selectOthers, $res2);

		$intIsAdmin = 0;
		$intIsOther = 0;

		foreach($res["EMAIL"] AS $value){
			$intIsAdmin = 1;
		}

		foreach($res2["EMAIL"] AS $value){
			$intIsOther = 1;
		}

		if($intIsAdmin){
			//WEBMASTER
			$idUsuario = 0;
			$intAdmin = oci_execute($selectAdmin);
			while($fila = oci_fetch_array($selectAdmin, OCI_ASSOC + OCI_RETURN_NULLS)){
				foreach ($fila AS $key => $elemento) {
					$idUsuario = $fila["IDUSUARIO"];
				}
			}
			session_start();
			$_SESSION['administrador']="$idUsuario";
			header("Location: views/inicio.php");
			exit(); 
		}
		if($intIsOther){
			//ES OTRO USER
			$idUsuario = 0;
			$intOther = oci_execute($selectOthers);
			while($fila = oci_fetch_array($selectOthers, OCI_ASSOC + OCI_RETURN_NULLS)){
				foreach ($fila AS $key => $elemento) {
					$idUsuario = $fila["IDUSUARIO"];
				}
			}
			session_start();
			$_SESSION['usuario']="$idUsuario";
			header("Location: views/inicio.php");
			exit();
		}

		//echo "<script> alert('Usuario no existe'); window.location= 'index.php'</script>";
	}
}

oci_close($db_connection);
?>
