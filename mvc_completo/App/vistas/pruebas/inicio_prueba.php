<?php require_once RUTA_APP.'/vistas/inc/header.php';
//print_r($datos); ?>


<h1 id="titulo" class="text-center mt-3 mb-5">Alumnos de <?php echo $datos["grupo"]->nombre ?></h1>
  
<?php if ($datos["usuarioSesion"]->rol == 0):?>
  <div class="row justify-content-evenly my-5">
    <button type="button" class="col-4 col-lg-2 btn btn-success" data-bs-toggle="modal" data-bs-target="#modal2" onclick="rellenarModalEditar('editar')">Editar Grupo</button>
    <button type="button" class="col-4 col-lg-2 btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal2" onclick="rellenarModalEditar('vaciar')">Vaciar Grupo</button>
  </div>
<?php endif;?>

    <div class="row">
      <?php if (empty($datos["tests"])):?>
          
          <h1>No hay ningun alumno en este grupo actualmente</h1>
          
          <?php endif;

          foreach ($datos["tests"] as $uruario) { ?>
 
            <div class="col-3 col-lg-2 border border-primary rounded-1 m-3 p-1 text-center"><?php echo $uruario->nombre." ".$uruario->apellido ?>
                <div id="img">
                  <img src="/public/imagenes/fotos_usu/<?php echo $uruario->img ?>" alt="" class="img-fluid p-2">
                </div>
                <button type="button" class="btn  btn-block editUruario"  data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="usuarios_tests(<?php echo $uruario->id_user?>,<?php echo $datos['grupo']->id_grupo ?> )" >
                  <i class="bi bi-eye-fill"></i>
                </button> 
              </div>

      <?php } ?>
    </div>
 

  <?php if ($datos["usuarioSesion"]->rol == 0):?>
    <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="ModalTitlerEdit" aria-hidden="true">
      <div class="modal-dialog  modal-xl text-center">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalTitlerEdit"><?php echo $datos["grupo"]->nombre ?></h5>
            <button type="button" class=" btn-danger btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body row" id="contenidoModalEdit">
            

          </div>
          <div class="modal-footer" id="modal_footer_edit">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  <?php endif;?>




<!-- Modal Tests Alumnos -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="ModalTitler" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTitler">404 Harran Not Found</h5>
        <button type="button" class=" btn-danger btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body row" id="contenidoModalGrupo">



      </div>
      <div class="modal-footer" id="modal_footer">
        
      </div>
    </div>
  </div>
</div>


<script>

    entrenadores = [];
    entrenadores_actuales = <?php echo json_encode($datos["entrenador"]);?>;
    nombre_grupo_actual = <?php echo json_encode($datos["grupo"]->nombre);?>;


    async function usuarios_tests(id_user,id_gru){
        var titler=document.getElementById("ModalTitler")
        var content=document.getElementById("contenidoModalGrupo")
        var footer=document.getElementById("modal_footer")
        titler.innerHTML="Pruebas "
        //console.log(id_user)

        content.innerHTML="";


        
        var enlace="<?php echo RUTA_URL?>/pruebas/obtener_socios_test/"+id_user;
        var nomP="users";
        
        
        

            await fetch(enlace)
            .then(response => response.json())
            .then(data => nomP = data)
            .catch( err => console.error(err));

            //console.log(nomP)
      
      titler.innerHTML+=nomP[0].nombre+" "+nomP[0].apellido

      if (nomP[1].length != 0) {
        nomP[1].forEach(objekt => {
          var unidades
          //console.log(nomP);
          if (objekt.unidades == "tiempo") {
            unidades=" s"
          } else {
            unidades=" m"
          }
          
          content.innerHTML+="<div class='col-8 col-lg-6'><label for='nombre_Borrar'>Prueba:</label><input type='text' name='nombre_Borrar' id='nombre_Borrar' class='form-control form-control-lg' value='"+objekt.nombr_prueba+"' readonly></div>"
          content.innerHTML+="<div class='col-4 col-lg-6'><label for='nombre_Borrar'>Marca:</label><input type='text' name='nombre_Borrar' id='nombre_Borrar' class='form-control form-control-lg' value='"+objekt.marca+unidades+"' readonly></div>"
        });
      } else {
        content.innerHTML="No se han encontrado pruebas recientes"
      }
      footer.innerHTML="<a href=\"<?php echo RUTA_URL?>/pruebas/prueba_nueva/"+id_user+"/"+id_gru+"\" class=\"btn btn-primary\"  >Test Nuevo</a>      <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Cerrar</button> <a href=\"/pruebas/mostrar_prueba/"+id_user+"\" class=\"btn btn-success\"   >Mostrar Todos Los Tests  </a> "
    }


    function rellenarModalEditar(accion){
      salida = document.getElementById("contenidoModalEdit")
      salida.innerHTML = ""
      salida.classList.add("row", "justify-content-center")
      footer = document.getElementById("modal_footer_edit")
      footer.innerHTML = ""


      botonCerrar = document.createElement("button")
      botonCerrar.appendChild(document.createTextNode("Cerrar"))
      botonCerrar.classList.add("btn", "btn-secondary")
      botonCerrar.setAttribute("data-bs-dismiss", "modal")

      footer.appendChild(botonCerrar)

      if (accion == "editar") {
        label = document.createElement("label")
        label.appendChild(document.createTextNode("Nombre del Grupo: "))
        label.classList.add( "col-6","col-lg-3")


        input = document.createElement("input")
        input.setAttribute("type","text")
        input.id = "nombre_grupo"
        input.setAttribute("value", nombre_grupo_actual)
        input.classList.add("col-5","col-lg-3")
        
        clear = document.createElement("div")
        clear.classList.add("clearfix")

        labelSelect = document.createElement("label")
        labelSelect.appendChild(document.createTextNode("Asignar nuevo entrenador: "))
        labelSelect.classList.add("col-5","col-lg-3") 

        selectList = document.createElement("select")
        selectList.id = "lista_entrenadores"
        selectList.classList.add("col-6","col-lg-3","me-1")

        for (let i = 0; i < entrenadores.length; i++) {
            option = document.createElement("option")
            option.text = entrenadores[i]["nombre"]+" "+entrenadores[i]["apellido"]
            option.value = entrenadores[i]["id_user"]
            selectList.appendChild(option)
        }

        add = document.createElement("button")
        add.setAttribute("onclick", "add_entrenador_modal()")
        add.classList.add("btn", "btn-success", "col-2","col-lg-1")
        i = document.createElement("i")
        i.classList.add("bi", "bi-plus-square")
        add.appendChild(i)

        lista = document.createElement("div")
        lista.id = "contenedor_entrenadores"
        

        
        salida.appendChild(label)
        salida.appendChild(input)
        salida.appendChild(clear)
        salida.appendChild(labelSelect)
        salida.appendChild(selectList)
        salida.appendChild(add)
        salida.appendChild(lista)

        

        botonEditar = document.createElement("button")
        botonEditar.appendChild(document.createTextNode("Guardar Cambios"))
        botonEditar.classList.add("btn", "btn-success")
        botonEditar.setAttribute("onclick", "guardar_cambios()")
        botonEditar.setAttribute("data-bs-dismiss", "modal")

        footer.appendChild(botonEditar)
        mostrar_lista_entrenadores()


      }else if(accion == "vaciar"){
        salida.innerHTML = "<h1>ESTE GRUPO VA VACIARSE COMPLETAMENTE, ¿ESTA SEGURO DE ELLO?</h1>"
        

        botonVaciar = document.createElement("button")
        botonVaciar.appendChild(document.createTextNode("Vaciar"))
        botonVaciar.classList.add("btn", "btn-danger")
        botonVaciar.setAttribute("onclick", "vaciarGrupo()")

        footer.appendChild(botonVaciar)

      }

    }

    async function guardar_cambios(){
      nombre_grupo = document.getElementById("nombre_grupo").value
      id_grupo = <?php echo $datos['grupo']->id_grupo; ?>;

      data = new FormData()
      data.append('nombre_grupo', nombre_grupo)
      data.append('id_grupo', id_grupo)

      await fetch('/pruebas/cambiar_nombre_grupo/', {
        method: "POST",
        body: data,
      })      
      .then((resp) => resp.json())
      .then(function(data) {
        if (data) {
          //console.log(data)
          document.getElementById("titulo").innerHTML ="Alumnos de "+nombre_grupo;
          nombre_grupo_actual = nombre_grupo
        } 
      })
      .catch( err => {
          console.error(err)            
      });
      
    }

    async function obtener_entrenadores(){
      await fetch('/pruebas/obtener_entrenadores/')
      .then((resp) => resp.json())
      .then(function(data) {
        entrenadores = data
          //console.log(usuarios)       
      })
      .catch( err => {
          console.error(err)            
      });
    }

    async function vaciarGrupo(){
      id_grupo = <?php echo $datos['grupo']->id_grupo; ?>;
      
      data = new FormData()
      data.append('id_grupo', id_grupo)

      await fetch('/pruebas/vaciar_grupo/', {
        method: "POST",
        body: data,
      })      
      .then((resp) => resp.text())
      .then(function(data) {
        location.reload();
      })
      .catch( err => {
          console.error(err)            
      });

    }

    async function add_entrenador_modal() {
      var entrenador_seleccionado=document.getElementById("lista_entrenadores").value
      esta = false;
      for (let i = 0; i < entrenadores_actuales.length; i++) {
        if (entrenadores_actuales[i]["id_user"]==entrenador_seleccionado) {
          esta = true;
          break;
        }
        
      }

      if (!esta) {
        for (let i = 0; i < entrenadores.length; i++) {
          if (entrenadores[i]["id_user"]==entrenador_seleccionado) {
            entrenadores_actuales.push(entrenadores[i])

            ids = []
            for (let i = 0; i < entrenadores_actuales.length; i++) {
              ids.push(entrenadores_actuales[i]["id_user"])   
            }
            
            id_grupo = <?php echo $datos['grupo']->id_grupo; ?>;

            
            
            data = new FormData();
            data.append('id_grupo',id_grupo)
            data.append('ids_entrenadores', ids)

            await fetch('/pruebas/modificar_entrenadores_grupo/', {
              method: "POST",
              body: data,
            })      
            .then((resp) => resp.text())
            .then(function(data) {
              //console.log(data)
            })
            .catch( err => {
                console.error(err)            
            });
            break;
          } 
        }
      }

            
      mostrar_lista_entrenadores()
    }

    async function eliminar_entrenador_modal(id){
      
      for (let i = 0; i < entrenadores_actuales.length; i++) {
        if (entrenadores_actuales[i]["id_user"]==id) {
          entrenadores_actuales.splice(i,1)

          ids = []
            for (let i = 0; i < entrenadores_actuales.length; i++) {
              ids.push(entrenadores_actuales[i]["id_user"])   
            }
            
            id_grupo = <?php echo $datos['grupo']->id_grupo; ?>;

            
            
            data = new FormData();
            data.append('id_grupo',id_grupo)
            data.append('ids_entrenadores', ids)

            await fetch('/pruebas/modificar_entrenadores_grupo/', {
              method: "POST",
              body: data,
            })      
            .then((resp) => resp.text())
            .then(function(data) {
              //console.log(data)
            })
            .catch( err => {
                console.error(err)            
            });
          break
        }    
      }


      mostrar_lista_entrenadores()
    }
      
    function mostrar_lista_entrenadores(){
      var contenedor_entrenadores=document.getElementById("contenedor_entrenadores")
      contenedor_entrenadores.innerHTML = ""

      for (let i = 0; i < entrenadores_actuales.length; i++) {
              var div_cont=document.createElement("div")
              div_cont.id = "entrenador_"+entrenadores_actuales[i]["id_user"];

              div_cont.appendChild(document.createTextNode(entrenadores_actuales[i]["nombre"]+" "+entrenadores_actuales[i]["apellido"]))

              var btn_eliminar=document.createElement("button")
              btn_eliminar.setAttribute("onclick","eliminar_entrenador_modal("+entrenadores_actuales[i]["id_user"]+")")
              btn_eliminar.setAttribute("type","button")
              btn_eliminar.classList.add("ms-2","btn","btn-outline-danger")
              btn_eliminar.innerHTML="X"

              
              div_cont.appendChild(btn_eliminar)
              contenedor_entrenadores.appendChild(div_cont)   
          }
      }

    obtener_entrenadores();
    //console.log(entrenadores)
    //console.log(entrenadores_actuales)
    


</script>

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ;?>