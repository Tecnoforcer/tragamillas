<?php require_once RUTA_APP.'/vistas/inc/header_no_logueado.php' ?>

<a href=".." class="btn btn-light"><i class="bi bi-chevron-double-left"></i>Volver</a>

<div class="row">

  <div class="row d-flex flex-row justify-content-center">
    <div class="jumbotron col-1">
      <h1>Login</h1>
    </div> 
  </div>



  <div class="row d-flex flex-row justify-content-center">
    <form method="post" class="col-9 col-lg-6">


      <div class="form-floating mb-3 ">
        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="" required>
        <label for="floatingInput">Email</label>
      </div>


      <div class="form-floating mb-3">
        <input type="password" name="pass" class="form-control" id="floatingInputPass" placeholder="" required>
        <label for="floatingInputPass">Contraseña/DNI</label>
      </div>

      <div class=" col-12 d-lg-flex flex-row justify-content-between">

        <input type="submit" class="btn col-12 col-lg-3 btn-success" value="Login">
        <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="col-12 col-lg-6" style=" text-align: right; cursor:pointer;">Recuperar contraseña</a>

      </div>


      <div class=" col-12 flex-row float-right" style=" text-align: right; margin-top: -4vh;">
        
      </div>

    </form>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="ModalTitler" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ModalTitler">Recuperar Contraseña</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="contenidoModalUsuario">
            <form method="post" class="card-body" id="form">
                <div class="mb-2">
                    <label for="dni">Email <sup>*</sup></label>
                    <input type="text" name="email" id="email" class="form-control form-control-lg">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" onclick="recuperar_pass()">Enviar</button>
        </div>
        </div>
    </div>
</div>
    
  <script>
    async function recuperar_pass(){
      data = new FormData(document.getElementById('form'));

      await fetch('/Login/recuperarPass', {
          method: "POST",
          body: data,
      })
      .then((resp) => resp.text())
      .then(function(data) {
          //console.log(data)

          if (Boolean(data)){
            alert('Revisa tu correo')
          } else {
            alert('Error al enviar la nueva contraseña')
          }
      })
    }
  </script>



</div>

  <?php if (isset($datos['error']) && $datos['error'] == 'error_1' ):?>
    <br><br>
    <div class="row">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
      </symbol>
    </svg>

    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
      <div>
        Intentelo de nuevo. <strong>El Email no existe!!!</strong>
      </div>
    </div>

  <?php endif ?>

</div>
<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>