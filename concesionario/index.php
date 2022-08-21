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
						<ul class="parrToLoginMembers">
							<li>Bryan Iván González Jiménez 1290-18-6335</li>
							<li>Johan Estuardo Carrillo Berducido 1290-18-8728</li>
							<li>Julio Saúl Ramos Chacón 1290-18-16675</li>
							<li>Walter Eduardo Vásquez Moya 1290-18-18389</li>
						</ul>
					<img class="imgCarLogoOpacity" src="imgs/carLogin.png" alt="car" width="80%" height="50%">
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 divFormLogin">
				<div class="titleLogin"> <p>Inicio de sesión</p> </div>
				<div class="inputsLogin">
					<input id="inputEmail" class="form-control" type="text" placeholder="Email"><br>
					<input id="inputPass" class="form-control" type="password" placeholder="Contraseña"><br>
					<div class="divRestorePassword">
						<a class="tagRestorePass" href="./restorePass.php">¿Perdió su contraseña?</a>
					</div>
					<div class="divGetIntoSystem">
						<button id="btnGetToSystem" class="btn btn-primary">Ingresar</button>
					</div>
				</div>
			</div>
		</div>

		<script>
			const btnGetToSystem = document.getElementById('btnGetToSystem');
			if(btnGetToSystem){
				btnGetToSystem.addEventListener('click',()=>{
					let inputEmail = document.getElementById('inputEmail');
					let inputPass = document.getElementById('inputPass');

					if(inputEmail.value && inputPass.value){
						console.log(inputEmail.value);
						console.log(inputPass.value);

						let form = new FormData();
						form.append('inputEmail',inputEmail.value);
						form.append('inputPass',inputPass.value);

						fetch("controllers/login/login.php", {
							method: 'POST',
							body: form
						})
							.then(r=>r.json())
							.then((response)=>{
								console.log("Response");
							})
							.catch(e=> {
								console.log("Error");
							});
					}
					else{
						Swal.fire({
							icon: 'error',
							title: 'Lo sentimos',
							text: 'Ingrese usuario y contraseña'
                    	});
					}
				});
			}
		</script>
		
	</body>
</html>