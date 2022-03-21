<?php require_once RUTA_APP.'/vistas/inc/header_no_logueado.php' ?>

<!-- div clas container eliminado -->

  <div class="row">

    <div class="jumbotron col-1  d-flex flex-row justify-content-center"></div>
    <div class="jumbotron col-7 col-lg-12  d-flex flex-row justify-content-center">
      <h1>Solicitud para ser Socio</h1>
    </div> 


    <div class="adminOPT col-4 col-lg-12 d-flex flex-row justify-content-center align-items-center">
      <a href="/Publicos/Solicitud_Socio" style="text-decoration:none;">
        <i class="bi bi-pencil-fill d-flex flex-row justify-content-center display-1"></i>
      </a>  
    </div>

    <div class="jumbotron col-1  d-flex flex-row justify-content-center"></div>
    <div class="jumbotron col-7 col-lg-12 d-flex flex-row justify-content-center">
      <h1>Inscripciones Eventos</h1>
    </div> 
    
    <div class="adminOPT col-4 col-lg-12 d-flex flex-row justify-content-center align-items-center">
      <a href="<?php echo RUTA_URL?>/Publicos/Inscripcion_eventos" style="text-decoration:none;">
        <i class="bi bi-pencil-fill d-flex flex-row justify-content-center display-1"></i>
      </a>
    </div>

  </div>



<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>