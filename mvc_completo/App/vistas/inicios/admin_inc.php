<?php require_once RUTA_APP.'/vistas/inc/header.php';?>
<div class="contenedorAdmin row">
    <div class="row">
      <div class="col-6 col-lg-3 adminOPT ">
          <a href="<?php echo RUTA_URL ?>/usuarios" ><i class="bi bi-person adminBTN"></i>
          <p>USUARIOS</p> </a>
      </div>
      <div class="col-6 col-lg-3 adminOPT ">
          <a href="<?php echo RUTA_URL ?>/facturas" ><i class="bi bi-receipt-cutoff adminBTN"></i>
          <p>FACTURACION</p></a>
      </div>
      <div class="col-6 col-lg-3 adminOPT">
          <a href="<?php echo RUTA_URL ?>/grupos" ><i class="bi bi-people-fill adminBTN"></i>
          <p>GRUPOS</p></a>
      </div>
      <div class="col-6 col-lg-3 adminOPT">
          <a href="<?php echo RUTA_URL ?>/usuarios/solicitudes_socio"><i class="bi bi-person-check adminBTN"></i>
          <p>SOLICITUDES SOCIO</p></a> 
      </div>
    </div>
    <div class="row">
      <div class="col-6 col-lg-3 adminOPT">
          <a href="<?php echo RUTA_URL ?>/eventos/index" target="" ><i class="bi bi-server adminBTN"></i>
          <p>EVENTOS</p></a> 
      </div>
      <div class="col-6 col-lg-3 adminOPT">
          <a href="<?php echo RUTA_URL ?>/usuarios/solicitudes_grupos_eventos" target="" ><i class="bi bi-building adminBTN"></i>
          <p>SOLICITUDES GRUPOS Y EVENTOS</p></a>
      </div>
      <div class="col-6 col-lg-3 adminOPT">
          <a href="" target="" ><i class="bi bi-terminal-fill adminBTN"></i>
          <p>.......</p></a>
      </div>
      <div class="col-6 col-lg-3 adminOPT">
          <a href="" target="" ><i class="bi bi-suit-spade-fill adminBTN"></i>
          <p>.........</p></a>
      </div>
    </div>

</div>

<?php require_once RUTA_APP.'/vistas/inc/footer.php';?>