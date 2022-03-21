<?php require_once RUTA_APP.'/vistas/inc/header.php';?>

  <h1>Grupos</h1>
    <div class="row d-flex justify-content-evenly" id="grupos_go_here">
      
    </div>
    <div class="text-center mt-5">
      <button type="button" class="btn btn-outline-success" onclick="add_grupo_modal()" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-circle"></i></button>
    </div>
  




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="ModalTitler" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTitler"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="contenidoModalGrupo">

        
        


      </div>
      <div class="modal-footer">
        <div id="extra_btn"></div>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
    async function load_grupos() {
      var group_zone=document.getElementById("grupos_go_here")
      group_zone.innerHTML=""
      var enlace="<?php echo RUTA_URL?>/grupos/obtener_gruposs";
        var nomP="se supone que debaria haber grupos";
        

        await fetch(enlace)
         .then(response => response.json())
         .then(data => nomP = data)
         .catch( err => console.error(err));

        //console.log(nomP);


        
        nomP.forEach(grupo => {
          var gru=document.createElement("div")
          gru.setAttribute("class","border border-primary col-6 col-lg-2 text-center p-2 me-1 my-2")

          var namee=document.createElement("div")
          var namee_txt=document.createTextNode(grupo.nombre)

          namee.setAttribute("class","")
          namee.appendChild(namee_txt)

          var editt=document.createElement("div")
          var btn=document.createElement("a")
          var btn_txt=document.createElement("i")
          btn_txt.setAttribute("class","bi bi bi-pencil-square")
          btn.appendChild(btn_txt)

          var function_edit="edit_grupo_modal("+grupo.id_grupo+",\""+grupo.nombre+"\")"
          btn.setAttribute("href","/pruebas/"+grupo.id_grupo+"")
          btn.setAttribute("class","btn btn-primary")


          
          

          editt.appendChild(btn)

          gru.appendChild(namee)
          gru.appendChild(editt)
          group_zone.appendChild(gru)

        });

    }
    load_grupos()


    function add_grupo_modal() {
      var modtitler=document.getElementById("ModalTitler")
        var modbody=document.getElementById("contenidoModalGrupo")
        var mod_aux_btn=document.getElementById("extra_btn")
        modbody.innerHTML="";
        modtitler.innerHTML="Añadir grupo";
        mod_aux_btn.innerHTML=""


        var lbl_new_gru=document.createElement("label")
        lbl_new_gru.appendChild(document.createTextNode("Nombre del nuevo grupo:"))

        var nombre_gru=document.createElement("input")
        nombre_gru.setAttribute("type","text")
        nombre_gru.id="nombre_add"

        var btn_addadir=document.createElement("button")
        btn_addadir.appendChild(document.createTextNode("Añadir grupo"))
        btn_addadir.setAttribute("class","btn btn-success")
        btn_addadir.setAttribute("onclick","add_grupo()")


        modbody.appendChild(lbl_new_gru)
        modbody.appendChild(nombre_gru)

        mod_aux_btn.appendChild(btn_addadir)

      
    }

    /* function edit_grupo_modal(id_grupo,nom_gru) {
      var modtitler=document.getElementById("ModalTitler")
        var modbody=document.getElementById("contenidoModalGrupo")
        var mod_aux_btn=document.getElementById("extra_btn")
        modbody.innerHTML="";
        modtitler.innerHTML="Editar grupo";
        mod_aux_btn.innerHTML=""


        var lbl_new_gru=document.createElement("label")
        var txt_lbl=document.createTextNode("Nombre del grupo:")
        lbl_new_gru.appendChild(txt_lbl)

        var nombre_gru=document.createElement("input")
        nombre_gru.setAttribute("type","text")
        nombre_gru.id="nombre_editar"
        nombre_gru.value=nom_gru


        var id_gru=document.createElement("input")
        id_gru.setAttribute("type","hidden")
        id_gru.id="id_editar"
        id_gru.value=id_grupo

        var btn_edit=document.createElement("button")
        btn_edit.appendChild(document.createTextNode("Editar grupo"))
        btn_edit.setAttribute("class","btn btn-warning")
        var func_edit="edit_grupo()"
        btn_edit.setAttribute("onclick",func_edit)


        modbody.appendChild(lbl_new_gru)
        modbody.appendChild(nombre_gru)
        modbody.appendChild(id_gru)

        mod_aux_btn.appendChild(btn_edit)
      
    } */

    async function add_grupo() {
      var nombre_grup=document.getElementById("nombre_add").value
      var enlace="<?php echo RUTA_URL?>/grupos/add_grupo";
        var nomP="grupo";
        


          const data_env=new FormData()
          data_env.append("namee",nombre_grup)

          await fetch(enlace,{
            method:"POST",
            body:data_env
          })
          .then(response => response.text())
          .then(data => nomP = data)
          .catch( err => console.error(err));
          

          if (nomP) {

            load_grupos()
            var modal = bootstrap.Modal.getInstance(document.getElementById("exampleModal"))
            modal.hide();
          }


      
    }

    /* async function edit_grupo(){
       //nombre_editar
       //id_editar
       var namee=document.getElementById("nombre_editar").value
       var idd=document.getElementById("id_editar").value

       var enlace="/grupos/edit_grupo";
        var nomP="grupo";
        


          const data_env=new FormData()
          data_env.append("namee",namee)
          data_env.append("idd",idd)

          await fetch(enlace,{
            method:"POST",
            body:data_env
          })
          .then(response => response.text())
          .then(data => nomP = data)
          .catch( err => console.error(err));

          if (nomP) {

            load_grupos()
            var modal = bootstrap.Modal.getInstance(document.getElementById("exampleModal"))
            modal.hide();
          }
    }; */


  
</script>


<?php require_once RUTA_APP.'/vistas/inc/footer.php'; ?>