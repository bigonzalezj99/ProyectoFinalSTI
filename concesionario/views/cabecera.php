<style>
    @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";

    a,
    a:hover,
    a:focus {
        color: white;
        text-decoration: none !important;
        transition: all 0.3s;
    }

    body {
        display: flex;
        height: 100%;
        width: 100%;
    }
    
    .navbar {
        position: fixed;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    }

    .navbar-btn {
        box-shadow: none;
        border: none;
    }

    .wrapper {
        display: flex;
    }

    #sidebar {
        position: relative;
        min-width: 250px;
        max-width: 250px;
        background: #880000;
        color: #fff;
        transition: all 0.6s cubic-bezier(0.945, 0.020, 0.270, 0.665);
        transform-origin: bottom left;
    }

    #sidebar.active {
        margin-left: -250px;
        transform: rotateY(100deg);
    }

    #sidebar .sidebar-header {
        padding: 20px;
        background: #880000;
    }

    #sidebar ul.components {
        padding: 10px 0;
        border-bottom: 1px solid #47748b;
    }

    #sidebar ul p {
        color: #fff;
        padding: 10px;
    }

    #sidebar ul li a {
        color: white;
        padding: 10px;
        font-size: 1.1em;
        display: block;
    }

    #sidebar ul li a:hover {
        color: white;
    }

    #sidebar ul li.active>a,
    a[aria-expanded="true"] {
        color: #fff;
        background: #af0000;
    }


    a[data-toggle="collapse"] {
        position: relative;
    }

    .dropdown-toggle::after {
        display: block;
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
    }

    ul ul a {
        font-size: 0.9em !important;
        padding-left: 30px !important;
        background: #af0000;
    }

    ul.CTAs {
        padding: 20px;
    }

    ul.CTAs a {
        text-align: center;
        font-size: 0.9em !important;
        display: block;
        border-radius: 5px;
        margin-bottom: 5px;
    }

    a.download {
        background: white;
        color: black;
    }

    #contvar {
        width: 100%;
        padding: 10px;
        transition: all 0.3s;
        background: #880000;
    }

    #sidebarCollapse {
        width: 30px;
        height: 30px;
        background: #f5f5f5;
        cursor: pointer;
    }

    #sidebarCollapse span {
        width: 80%;
        height: 2px;
        margin: 0 auto;
        display: block;
        background: #555;
        transition: all 0.8s cubic-bezier(0.810, -0.330, 0.345, 1.375);
        transition-delay: 0.2s;
    }

    #sidebarCollapse span:first-of-type {
        transform: rotate(45deg) translate(2px, 2px);
    }

    #sidebarCollapse span:nth-of-type(2) {
        opacity: 0;
    }

    #sidebarCollapse span:last-of-type {
        transform: rotate(-45deg) translate(1px, -1px);
    }


    #sidebarCollapse.active span {
        transform: none;
        opacity: 1;
        margin: 5px auto;
    }

    @media (max-width: 768px) {
        #sidebar {
            margin-left: -250px;
            transform: rotateY(90deg);
        }

        #sidebar.active {
            margin-left: 0;
            transform: none;
        }

        #sidebarCollapse span:first-of-type,
        #sidebarCollapse span:nth-of-type(2),
        #sidebarCollapse span:last-of-type {
            transform: none;
            opacity: 1;
            margin: 5px auto;
        }

        #sidebarCollapse.active span {
            margin: 0 auto;
        }

        #sidebarCollapse.active span:first-of-type {
            transform: rotate(45deg) translate(2px, 2px);
        }

        #sidebarCollapse.active span:nth-of-type(2) {
            opacity: 0;
        }

        #sidebarCollapse.active span:last-of-type {
            transform: rotate(-45deg) translate(1px, -1px);
        }

    }
</style>

<?php
    if (!isset($_SESSION['administrador'])) 
    { 
        if (!isset($_SESSION['usuario'])) 
            { 
                /* nos envía a la siguiente dirección en el caso de no poseer autorización */
                header("location: ../../index.php"); 
        }
    }

?>


<?php 
    // Si la sesión iniciada NO es webmaster
    if (!isset($_SESSION['administrador'])){
    ?>
    <html>
        <head>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <link rel="stylesheet" href="../icons/font-awesome/css/font-awesome.min.css">
            <div class="wrapper">
                <nav id="sidebar">
                    <div class="sidebar-header">
                        <h4>Concesionario</h4>
                    </div>
                    <ul class="list-unstyled components">
                        <li class="active" style="color: white;">
                            <a href="/proyectos/ProyectoFinalSTI/concesionario/views/inicio.php"><i class="fa fa-home" aria-hidden="true"></i> Inicio </a>
                        </li>
                        <li class="">
                            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fa fa-car" aria-hidden="true"></i> Vehículos
                            </a>
                            <ul class="collapse list-unstyled" id="homeSubmenu">
                                <li> <a href="/proyectos/ProyectoFinalSTI/concesionario/views/cotizar/cotizar.php"><i class="fa fa-car" aria-hidden="true"></i> Cotizar vehículo y repuestos</a> </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fa fa-user-circle" aria-hidden="true"></i> Usuarios
                            </a>
                            <ul class="collapse list-unstyled" id="pageSubmenu">
                                <li> <a href="/proyectos/ProyectoFinalSTI/concesionario/views/micuenta/micuenta.php"><i class="fa fa-user-o" aria-hidden="true"></i> Mi cuenta</a> </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="list-unstyled CTAs">
                        <li>
                            <a href="../redirectLogout.php" class="download" style="color: black;"><b>Cerrar sesión</b></a>
                        </li>
                    </ul>
                </nav>
                <div id="contvar">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                            <button type="button" id="sidebarCollapse" class="navbar-btn">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fas fa-align-justify"></i>
                            </button>
                        </div>
                    </nav>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

            <script type="text/javascript">
                $(document).ready(function() {
                    $('#sidebarCollapse').on('click', function() {
                        $('#sidebar').toggleClass('active');
                        $(this).toggleClass('active');
                    });
                });
            </script>
        </head>
    </html>

<?php 
    }
?>   

<?php 
    // Si la sesión iniciada SI ES WEBMASTER
    if (!isset($_SESSION['usuario'])){
    ?>
    <html>
        <head>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <div class="wrapper">
                <nav id="sidebar">
                    <div class="sidebar-header">
                        <h4>Concesionario</h4>
                    </div>
                    <ul class="list-unstyled components">
                        <li class="active" style="color: white;">
                            <a href="/proyectos/ProyectoFinalSTI/concesionario/views/inicio.php"><i class="fa fa-home" aria-hidden="true"></i> Inicio </a>
                        </li>
                        <li class="">
                            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fa fa-car" aria-hidden="true"></i> Vehículos
                            </a>
                            <ul class="collapse list-unstyled" id="homeSubmenu">
                                <li> <a href="/proyectos/ProyectoFinalSTI/concesionario/views/vehiculos/vehiculos.php"><i class="fa fa-car" aria-hidden="true"></i> Administración vehículos</a> </li>
                                <li> <a href="/proyectos/ProyectoFinalSTI/concesionario/views/repuestos/repuestos.php"><i class="fa fa-cogs" aria-hidden="true"></i> Administración de repuestos</a> </li>
                                <li> <a href="/proyectos/ProyectoFinalSTI/concesionario/views/cotizar/cotizar.php"><i class="fa fa-car" aria-hidden="true"></i> Cotizar vehículo y repuestos</a> </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fa fa-user-circle" aria-hidden="true"></i> Usuarios
                            </a>
                            <ul class="collapse list-unstyled" id="pageSubmenu">
                                <li> <a href="/proyectos/ProyectoFinalSTI/concesionario/views/usuarios/usuarios.php"><i class="fa fa-users" aria-hidden="true"></i> Administración Usuarios</a> </li>
                                <li> <a href="/proyectos/ProyectoFinalSTI/concesionario/views/empleados/empleados.php"><i class="fa fa-briefcase" aria-hidden="true"></i> Administración Empleados</a> </li>
                                <li> <a href="/proyectos/ProyectoFinalSTI/concesionario/views/clientes/clientes.php"><i class="fa fa-user-o" aria-hidden="true"></i> Administración Clientes</a> </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fa fa-book" aria-hidden="true"></i> Facturas
                            </a>
                            <ul class="collapse list-unstyled" id="pageSubmenu2">
                                <li> <a href="/proyectos/ProyectoFinalSTI/concesionario/views/compras/compras.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;<i class="fa fa-caret-left" aria-hidden="true"></i> Compras</a> </li>
                                <li> <a href="/proyectos/ProyectoFinalSTI/concesionario/views/ventas/ventas.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i> Ventas</a> </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fa fa-building" aria-hidden="true"></i> Sucursales
                            </a>
                            <ul class="collapse list-unstyled" id="pageSubmenu3">
                                <li> <a href="/proyectos/ProyectoFinalSTI/concesionario/views/sucursales/sucursales.php"><i class="fa fa-building" aria-hidden="true"></i> Administración Sucursales</a> </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="list-unstyled CTAs">
                        <li>
                            <a href="../redirectLogout.php" class="download" style="color: black;"><b>Cerrar sesión</b></a>
                        </li>
                    </ul>
                </nav>
                <div id="contvar">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                            <button type="button" id="sidebarCollapse" class="navbar-btn">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fas fa-align-justify"></i>
                            </button>
                        </div>
                    </nav>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
            
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#sidebarCollapse').on('click', function() {
                        $('#sidebar').toggleClass('active');
                        $(this).toggleClass('active');
                    });
                });
            </script>

        </head>
    </html>
    <?php 
    }
?>