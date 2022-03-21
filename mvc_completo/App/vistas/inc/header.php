<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css" integrity="sha384-7ynz3n3tAGNUYFZD3cWe5PDcE36xj85vyFkawcF6tIwxvIecqKvfwLiaFdizhPpN" crossorigin="anonymous">
     <link rel="stylesheet" href="/public/css/estilos.css">
    <!-- <link rel="stylesheet" href="css/estilos.css"> -->
    <title><?php echo NOMBRE_SITIO?></title>
    <style>
        
        
        
    </style>
</head>

<body class="container-fluid min-vh-100">

<header class="d-flex row sticky-top">

    <nav class="justify-content-between navbar navbar-dark bg-dark col-12">
        <div class="offcanvas offcanvas-start" id="demo">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title">Menu</h1>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
            <p>Usuario: <?php  echo $datos['usuarioSesion']->nombre  ?></p>
                <a href="/">INICIO</a>
                <?php 
                $rol=$datos['usuarioSesion']->rol;

                $isAdmin = ($rol == 0) ? true : false ;
                $isEntrendor = ($rol == 5) ? true : false ;
                $isSocio = ($rol == 10) ? true : false ;
                $isTienda = ($rol == 200) ? true : false ;
                

                if ($isTienda) { ?>
                    <a class="nav-link" aria-current="page "href="/usuarios/gente_para_equipacion">Pedir</a>
                    <a class="nav-link" aria-current="page "href="/usuarios/inicio_usu_tienda">Entregar</a>
                <?php }

                if ($isAdmin) { ?>
                    <a class="nav-link" aria-current="page" href="/usuarios">Usuarios</a>
                    <a class="nav-link" aria-current="page" href="/facturas">Facuracion</a>
                    <a class="nav-link" aria-current="page" href="/grupos">Grupos</a>
                    <a class="nav-link" aria-current="page" href="/usuarios/solicitudes_socio">Solicitudes Socio</a>
                    <a class="nav-link" aria-current="page" href="/eventos/index">Eventos</a>
                    <a class="nav-link" aria-current="page" href="/usuarios/solicitudes_grupos_eventos">Solicitudes Grupos y Eventos</a>
                <?php }

                if ($isSocio) { ?>
                    <a class="nav-link" aria-current="page" href="/socios/inicioLicencias">Linecia</a>
                    <a class="nav-link" aria-current="page" href="/socios/Inscripcion_eventos">Incripcion Grupo/Eventos</a>

                <?php }

                if ($isEntrendor) { ?>
                    <a class="nav-link" aria-current="page" href="/tests">Test</a>


                <?php }?>
                <br>
                <a class="btn btn-secondary" aria-current="page" href="<?php  echo RUTA_URL  ?>/login/logout">LogOut</a>
                
            </div>
        </div>


        <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo" style="background-color: #003df9; color:white;">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="" style="color:white;">
            <a href="/" style="color:white; text-decoration:none;"><h1 style="text-align:center;">TRAGAMILLAS</h1></a>
        </div>
        
        <div>
            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php  echo RUTA_URL  ?>/login/logout"><i class="bi bi-box-arrow-right" style="font-size: 4vh; margin-right:2vh"></i></a>
                </li>

            </ul>
        </div>
    </nav>
</header>






