<?php
//Open session
session_start();
 
//If NO webmaster -->  No Total control
if (!isset($_SESSION['administrador'])){
    // If NO other user --> 
    if (!isset($_SESSION['usuario'])){
        /* Si no se posee autorización, nos envía de regreso */
        header("location:../index.php");
    }
}
?>

<head>
    <title>Inicio</title>
    <link rel="icon" type="image/png" href="../imgs/inicio.png"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../icons/font-awesome/css/font-awesome.min.css">
</head>

<body class="bodyInicio">
    <?php include('cabecera.php'); ?>
    <div class="contPage">
        <div class="titlePage">
            Seminario de Tecnologías - Grupo #1
        </div>
        <br><br>
        <div class="text-justify marginBottom">
            <div class="row" style="align-items: center;">
                <div class="col-md-6">
                    <table border="0">
                        <tr>
                            <td colspan="2">INTEGRANTES:</td>
                        </tr>
                        <tr>
                            <td>CARNE:</td>
                            <td></td>
                            <td>NOMBRES:</td>
                        </tr>
                        <tr>
                            <td>1290-18-6335</td>
                            <td>-----</td>
                            <td>Bryan Iván González Jiménez</td>
                        </tr>
                        <tr>
                            <td>1290-18-8728</td>
                            <td>-----</td>
                            <td>Johan Estuardo Carrillo Berducido</td>
                        </tr>
                        <tr>
                            <td>1290-18-16675</td>
                            <td>-----</td>
                            <td>Julio Saúl Ramos Chacón</td>
                        </tr>
                        <tr>
                            <td>1290-18-18389</td>
                            <td>-----</td>
                            <td>Walter Eduardo Vásquez Moya</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <img src="../imgs/carroAzul.png" height="100%" width="100%">
                </div>
            </div>
            <br>
            <div align="justify">
                Proyecto del curso de Seminario de Tecnologías del décimo semestre de Ingeniería en Sistemas de la Universidad Mariano Gálvez de Guatemala, 
                el cual consta de la elaboración de una concesionaria de vehículos que permita la compra y cotización de los mismos además de repuestos.
                Así mismo permite llevar la administración de:
                <ul>
                    <li>Vehículos</li>
                    <li>Repuestos y herramientas</li>
                    <li>Sucursales</li>
                    <li>Usuarios
                        <ul>
                            <li>Empleados</li>
                            <li>Clientes</li>
                            <li>"Mi cuenta"</li>
                        </ul>
                    </li>
                    <li>Facturas
                        <ul>
                            <li>Compras</li>
                            <li>Ventas</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <hr size="8px" color="black" style="background-color: #880000; opacity: 1;"/>
        <div class="row">
            <div class="col-lg-6 textPromotions">
                <p class="titlePromotions">Elije el vehículo que tú quieras</p>
                <p class="parrPromotios">
                    Puedes seleccionar varios vehículos a la vez para comprar precios y relizar tu cotización.
                    Elije las marcas que prefieras, los modelos que más te gusten y los tipos de vehículos que más te agraden.
                </p>
            </div>
            <div class="col-lg-6">
                <img src="../imgs/carroGris.png" height="100%" width="100%">
            </div>
        </div>
        <hr size="8px" color="black" style="background-color: #880000; opacity: 1;"/>
        <div class="row">
            <div class="col-lg-6">
                <img src="../imgs/carroAmarillo.png" height="100%" width="100%">
            </div>
            <div class="col-lg-6 textPromotions">
                <p class="titlePromotions">Adquiere los repuestos para tu vehículo</p>
                <p class="parrPromotios">
                    Puedes seleccionar, cotizar y comprar los diferentes repuestos o piezas para tu vehículo, tenemos de todo tipo para nuestros modelos.
                    Si no los encuentras puedes preguntarnos y te responderemos.
                </p>
            </div>
        </div>
        <hr size="8px" color="black" style="background-color: #880000; opacity: 1;"/>
        <div class="row divContent">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <!-------------------------------------------
                    REFERENCIA A LA PÁGINA DE COTIZACIONES 
                -------------------------------------------->
                <a href="/proyectos/ProyectoFinalSTI/concesionario/views/cotizar/cotizar.php" style="text-decoration: none; color: black">
                    <div class="container" align="justify" style="background-color: #000000; width: 100%; border: solid; border-color: black;">
                        <div class="text-center">
                            <b><font size=5 face="Times New Roman" color="white">COTIZAR VEHICULO</font></b>
                            <img src="../imgs/concesionariaEj.jpg" width="90%" class="card-img-top" style="border: solid">
                        </div>
                        <p align="center" style="margin-top: 2em; color: white;"><i>
                            ¡Cotiza tu producto!<br>
                            Contamos con variedad de vehículos y repuestos.
                        </i></p>
                    </div>
                </a>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>