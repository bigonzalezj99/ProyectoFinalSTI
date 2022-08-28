<?php 
    session_start();
	session_destroy();
?>

<html>
	<head>
		<title>Registro de usuario</title>
		<meta charset="UTF-8">
		<link rel="icon" type="image/png" href="imgs/titleLogin.png"/>
		<link rel="stylesheet" type="text/css" href="./Estilo/principal.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<!-- CALL SWEET ALERT -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	</head>
	<body style="overflow: hidden;">
		<div class="row" style="height: 100%;">
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 divBackgroundLogo">
				<div class="imgLoginCenter">
					<p class="parrToLoginTitle">CONCESIONARIO</p>
					<p class="parrToLoginGroup">Grupo #1</p>
					<img class="imgCarLogoOpacity" src="imgs/carroRojo.png" alt="car" width="80%" height="50%">
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divFormLogin">
				<form class="formLogin" method="post">
					<div class="titleLogin"> <p>Inicio de sesión</p> </div>
					<div class="inputsLogin">
						<input id="inputEmail" name="inputEmail" class="form-control" type="text" placeholder="Email"><br>
						<input id="inputPass" name="inputPass" class="form-control" type="password" placeholder="Contraseña"><br>
						<div class="separateElements">
							<a class="tagRestorePass" href="./registerUser.php">Crear cuenta</a>
							<a class="tagRestorePass" href="./restorePass.php">¿Perdió su contraseña?</a>
						</div>
						<div class="divGetIntoSystem">
							<button type="submit" id="btnGetToSystem" name="btnGetToSystem" class="btn btn-primary btnLogin">Ingresar</button>
						</div>
						<div>

						</div>
					</div>
				</form>
			</div>
		</div>

		<?php
			if(isset($_POST["btnGetToSystem"])){
				include './controllers/login/login.php';
			}
		?>
		
	</body>
</html>