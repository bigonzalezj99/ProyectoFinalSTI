<?php
ob_start();
require_once 'controllers/conexion.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Solicitud de creación de usuario</title>
        <link rel="icon" type="image/png" href="./imgs/nuevoUsuario.png"/>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="./Estilo/principal.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="./tienda/css/sweetalert2.min.css">
    </head>

    <body class="divBackgroundLogo" style="background-repeat: repeat-y; background-size: cover;">
        <div class="divInitialRegister">
            <div class="row">
                <div class="col-md-12 divTitleRegisterUser">
                    <h3 class="text-center">Solicitar creación de una cuenta</h3>
                </div>
                <div class="col-md-6 whiteBackground">
                    <form id="procesar-solicitud" action="" method="post">
                        <div class="row" style="padding: 5%">
                            <!------------------->
                            <!-- DATOS CLIENTE -->
                            <!------------------->
                            <div class="col-md-12" style="margin-top: 2%; font-size: 24px; text-align: center;">
                                <label for="lbl_titleClient" class="form-label"><b>Datos de cliente</b></label>
                            </div>
                            <div class="col-md-12">
                                <label for="lbl_nombres" class="form-label"><b>Nombre</b></label>
                                <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Nombre1 Nombre2" required>
                            </div>
                            <div class="col-md-12" style="margin-top: 2%;">
                                <label for="lbl_apellidos" class="form-label"><b>Apellido</b></label>
                                <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Apellido1 Apellido2" required>
                            </div>
                            <div class="col-md-12" style="margin-top: 2%;">
                                <label for="lbl_direccion" class="form-label"><b>Direccion</b></label>
                                <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="#calle #avenida #zona, #casa" required>
                            </div>
                            <div class="col-md-12" style="margin-top: 2%;">
                                <label for="lbl_nit" class="form-label"><b>NIT</b></label>
                                <input type="text" name="txt_nit" id="txt_nit" class="form-control" placeholder="xxxxxxx-x" required>
                            </div>
                            <div class="col-md-12" style="margin-top: 2%;">
                                <label for="lbl_telefono" class="form-label"><b>Telefono</b></label>
                                <input type="number" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="12345678" required>
                            </div>

                            <!------------------->
                            <!-- DATOS USUARIO -->
                            <!------------------->
                            <div class="col-md-12" style="margin-top: 10%; font-size: 24px; text-align: center;">
                                <label for="lbl_titleClient" class="form-label"><b>Datos de usuario</b></label>
                            </div>

                            <div class="col-md-12">
                                <label for="lbl_email" class="form-label"><b>Email</b></label>
                                <input type="text" name="txt_email" id="txt_email" class="form-control" placeholder="ejemplo@gmail.com" required>
                            </div>

                            <div class="col-md-12" style="margin-top: 2%;">
                                <label for="lbl_password" class="form-label"><b>Password</b></label>
                                <input type="password" name="txt_password" id="txt_password" class="form-control" placeholder="pass.123" required>
                            </div>

                            <div class="col-md-12" style="margin-top: 2%;">
                                <label for="lbl_confPassword" class="form-label"><b>Confirmar Password</b></label>
                                <input type="password" name="txt_confPassword" id="txt_confPassword" class="form-control" placeholder="pass.123" required>
                            </div>
                        </div>

                        <div class="text-center" style="margin-top: 2%;">
                            <input type="submit" name="btn_solicitar" id="btn_solicitar" class="btn btn-primary" value="Solicitar una cuenta">
                            <a href="./" class="btn btn-warning">Regresar</a>
                        </div>
                        <br><br>
                    </form>
                </div>
                <div class="col-md-6 whiteBackground centerImg">
                    <div>
                        <img src="./imgs/carLogin.png" alt="Carr" height="95%" width="95%">
                    </div>
                    <div>
                        <img src="./imgs/siluetaCarroInicio.png" alt="Carr" height="95%" width="95%">
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/emailjs-com@2/dist/email.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="./tienda/js/jquery-3.4.1.min.js"></script>
        <script src="./tienda/js/bootstrap.min.js"></script>
        <script src="./tienda/js/sweetalert2.min.js"></script>
        <script src="./controllers/usuarios/requestRetrive/solicitarUsuario.js"></script>
    </body>
</html>