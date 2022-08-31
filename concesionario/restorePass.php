<?php
ob_start();
require_once 'controllers/conexion.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Recuperación de contraseña</title>
        <link rel="icon" type="image/png" href="./imgs/restaurarPass.png"/>
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
                    <h3 class="text-center">Solicitud de recuperación de contraseña</h3>
                </div>
                <div class="col-md-6 whiteBackground">
                    <!-- procesar-solicitud --> 
                    <form id="procesar-recuperacion" action="" method="post">
                        <div class="row" style="padding: 5%">
                            <div class="col-md-12">
                                <label for="lbl_email" class="form-label"><b>Email</b></label>
                                <input type="text" name="txt_email" id="txt_email" class="form-control" placeholder="tu_mail@gmail.com" required>
                            </div>
                            <div id="divEmailSending" class="col-md-12 divEmailSendingHide" style="margin-top: 2%;">
                                <label for="lbl_password" class="form-label"><b>Se ha enviado a su correo la nueva contraseña</b></label><br>
                                <label for="lbl_password" class="form-label"><b>REFRESCANDO PÁGINA...</b></label>
                            </div>
                            <div id="divNewPass" class="col-md-12 divEmailSendingHide" style="margin-top: 2%;">
                                <input type="text" name="txt_newPass" id="txt_newPass" class="form-control" placeholder="mail@gmail.com">
                            </div>
                        </div>
                        <div class="text-center" style="margin-top: 2%;">
                            <input type="submit" name="btn_solicitar" id="btn_solicitar" class="btn btn-primary" value="Recuperar contraseña">
                            <a href="./" class="btn btn-warning">Regresar</a>
                        </div>
                        <br><br>
                    </form>
                </div>
                <div class="col-md-6 whiteBackground centerImg">
                    <div>
                        <img src="./imgs/siluetaRoja.png" alt="Carr" height="95%" width="95%">
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
        <script src="./controllers/usuarios/requestRetrive/recuperarPass.js"></script>
    </body>
</html>