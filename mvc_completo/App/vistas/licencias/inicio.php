<?php require_once RUTA_APP.'/vistas/inc/header.php';?>
<?php //print_r($datos)?>
    <div class="row">
        <h1><?php echo $datos['usuarioSesion']->nombre. " ". $datos['usuarioSesion']->apellido ?> </h1>
    </div>


    <form enctype="multipart/form-data" action="subirLicencia" method="POST">

        <p> Enviar mi archivo: <input class="btn btn-outline-secondary" name="subir_archivo" type="file" /></p>
        <p> <input type="submit" class="btn btn-outline-success" value="Enviar Archivo" /></p>
    </form>

    



<?php require_once RUTA_APP.'/vistas/inc/footer.php';?>