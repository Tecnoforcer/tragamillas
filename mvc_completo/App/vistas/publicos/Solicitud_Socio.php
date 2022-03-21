<?php require_once RUTA_APP.'/vistas/inc/header_no_logueado.php' ?>

<a href=".." class="btn btn-light"><i class="bi bi-chevron-double-left"></i>Volver</a>

<!-- div clas container eliminado -->
  <div class="jumbotron">
    <form method="post" class="card-body">
      <legend>Solicitud para ser socio</legend>	 
        <div class="mt-3 mb-3">
          <label for="nombre">Nombre: <sup>*</sup></label>
          <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" placeholder="Benito">
        </div>
        <div class="mb-3">
          <label for="apellido">Apellidos: <sup>*</sup></label>
          <input type="text" name="apellido" id="apellido" class="form-control form-control-lg" placeholder="Pérez Galdós">  
        </div>
        <div class="mb-3">
          <label for="Dni">DNI/NIE: <sup>*</sup></label>
          <input type="text" name="Dni" id="Dni" class="form-control form-control-lg" placeholder="00000000A"> 
        </div> 
        <div class="mb-3">
          <label for="email">Email: <sup>*</sup></label>
          <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="tuprimaladelpueblo@gmail.com">
        </div>
        <div class="mb-3">
          <label for="telefono">Telefono: <sup>*</sup></label>
          <input type="text" name="telefono" id="telefono" class="form-control form-control-lg" placeholder="676547895">
        </div>
        <div class="mb-3">
          <label for="fecha_nac">fecha nacimiento: <sup>*</sup></label>
          <input type="date" name="fecha_nac" id="fecha_nac" class="form-control form-control-lg">
        </div>
        <div class="mb-3">
          <label for="CC">CC: <sup>*</sup></label>
          <input type="text" name="CC" id="CC"placeholder="ES00 0000 0000 00 0000000000" class="form-control form-control-lg">
        </div>
      <button type="submit" class="btn btn-outline-success">Enviar Solicitud</button>
    </form> 
  </div>    


<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>