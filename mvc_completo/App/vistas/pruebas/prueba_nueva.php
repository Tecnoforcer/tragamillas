<?php require_once RUTA_APP.'/vistas/inc/header.php'; 
$usuarioTest=$datos['usuarioTest'];
//print_r($datos['prueba_to_grupo']);
?>



<a class="btn btn-outline-primary" href="<?php echo RUTA_URL ?>/pruebas/<?php echo $datos["prueba_to_grupo"] ?>" class="col-4"><< VOLVER</a>
<div class="row">
  
  <h1 id="usuario_test" class="col-4">
    
    <?php
        
        echo $usuarioTest->nombre." ".$usuarioTest->apellido;
    ?>
  </h1>
  <div class="col-4"></div>
</div>


<div class="row">

  <div class="col-3 col-lg-6" id="test_selecc">
      <br>
  </div>

  <div class="col-6" class="btn-group-dm">
      <button type="button" class="btn btn-outline-secondary" onclick="llenar_modal()" data-open="modal2">
        Añadir prueba
      </button>
      <br>
  </div>

  <div class="col-12" id="pruebas"></div>


<div class="btn-group-dm">
    <button type="button" class="btn btn-outline-primary" onclick="guardar_marcas()">
      Guardar Marcas
    </button>
</div>
</div>






<div class="modal-dm" id="modal2" data-animation="zoomInOut">
        <div class="modal-dialog-dm" id="modal-1">
          <header class="modal-header-dm">
            Seleciones un tipo de prueba
            <button class="btn btn-outline-danger" aria-label="close modal-dm" data-close>
              ✕  
            </button>
          </header>
          <section class="modal-content-dm" id="modal-content-dm">
            <p><strong>Press ✕, ESC, or click outside of the modal to close it</strong></p>
            <form>
              <label>nombre</label>
              <input type="text" placeholder="nombre"><br>
              <label>apellidos</label>
              <input type="text" placeholder="apellidos"><br>
              <label>inroduce algo</label>
              <input type="text" placeholder="algo"><br>
              <label>aux</label>
              <input type="text" placeholder="aux"><br>
            </form> </section>
          <footer class="modal-footer-dm">
            <button class="btn btn-outline-success" onclick="add_prueba()">Añadir prueba</button>
          </footer>
        </div>
      </div>




<script>
    var pruebas_modal;
    var pruebas_modal_aux=[];
    
    async function cargar_pruebas() {
      var enlace="<?php echo RUTA_URL?>/pruebas/obtener_pruebas";
        var nomP="users";

            await fetch(enlace)
            .then(response => response.json())
            .then(data => nomP = data)
            .catch( err => console.error(err));
            pruebas_modal=nomP
            
           
    }
    cargar_pruebas()
    

    async function select_testss(){
      var test_select_container=document.getElementById("test_selecc")
      

      var enlace="<?php echo RUTA_URL?>/pruebas/obtener_tests";
        var nomP="users";

            await fetch(enlace)
            .then(response => response.json())
            .then(data => nomP = data)
            .catch( err => console.error(err));

            //console.log(nomP)


            test_select_container.innerHTML="";

            let select = document.createElement("select");
            
            select.id="select_tests"
            select.classList.add("form-select","mb-2");

            var todayy=new Date();

            month=todayy.getMonth()+1
            //console.log(month)
            var month1=month;
            if (month.toString().length < 2) {
               month1= "0"+month;
            }
            day=todayy.getDate()
            var day1=day
            if (day.toString().length < 2) {
               day1 = "0" + day.toString();
            }

            var fecha_hoy=todayy.getFullYear() + '-' + month1 + '-' + day1;
            //console.log(fecha_hoy)
            let option1=document.createElement("option");
            option1.setAttribute("value", "nil_"+fecha_hoy);
            let option1Texto=document.createTextNode("Pruebas Libres");
            
            option1.appendChild(option1Texto);
            
            option1.setAttribute("selected","true")
            select.appendChild(option1);


          nomP.forEach(test => {
            let option1=document.createElement("option");
            option1.setAttribute("value", test.id_test+"_"+test.fecha);
            
            let option1Texto=document.createTextNode(test.Nombre);
            option1.appendChild(option1Texto);
            select.appendChild(option1);
        
        

            
              
          });
          test_select_container.appendChild(select);
    }
    select_testss()

  


    function add_prueba() {
        var seleccc=document.getElementById("select_pruebas")
        
        var mod=document.getElementById("modal2")
        
        
        

        if (seleccc.value != "nil") {
            var tipo=seleccc.value.split("-")
            
            if (tipo[1]  ==  "distancia") {
                unidad="metros"
            }else{
                unidad="segundos"
            }

            var prrr=document.getElementById("pruebas")
            

            var id_prueba=document.createElement("input")
            id_prueba.setAttribute("type","hidden")
            id_prueba.setAttribute("value",tipo[0])
            id_prueba.id="id_"+tipo[0]

            var cont_prueba=document.createElement("div")
            cont_prueba.id="prueba_"+tipo[0]
            var prueba=document.createTextNode(seleccc.options[seleccc.selectedIndex].text)

            var marka=document.createElement("input")
            marka.setAttribute("type","number")
            marka.setAttribute("step","0.001")
            marka.classList.add("mt-2","form-control","marca")
            marka.id="marka_"+tipo[0]

            var unit=document.createTextNode(unidad+" ")

            var btn_delete=document.createElement("button")
            var btn_delete_text=document.createTextNode("Retirar prueba")
            //btn_delete..classList.add("btn btn-outline-danger");
            btn_delete.setAttribute("onClick","delete_prueba(this.parentNode)")
            btn_delete.setAttribute("type","button")
            btn_delete.classList.add("btn","btn-outline-danger","mt-2","mb-2")
            btn_delete.appendChild(btn_delete_text);


            
            cont_prueba.appendChild(id_prueba);           
            cont_prueba.appendChild(prueba);
            cont_prueba.appendChild(marka);
            cont_prueba.appendChild(unit);
            cont_prueba.appendChild(btn_delete);


            prrr.appendChild(cont_prueba);
            
            mod.classList.remove(isVisible)

              for (let i = 0; i < pruebas_modal.length; i++) {
                if ((pruebas_modal[i] != null) && (pruebas_modal[i].Id_prueba == tipo[0])) {
                  pruebas_modal_aux[i]=pruebas_modal[i]
                  pruebas_modal[i]=null
                }
                
              }

        }
    }
        



    function llenar_modal(){
        var contenedor=document.getElementById("modal-content-dm")
        contenedor.innerHTML=""
        
        pruebasArr=pruebas_modal

        let select
        if (pruebasArr.length != 0) {
          select = document.createElement("select");
        
          select.id="select_pruebas"
          select.classList.add("form-select","mb-2");
          let option1 = document.createElement("option");
          option1.setAttribute("value", "nil");
          let option1Texto = document.createTextNode("Seleccione una opcion");
          
          option1.appendChild(option1Texto);
          option1.setAttribute("disabled","true")
          option1.setAttribute("selected","true")
          select.appendChild(option1);


          pruebasArr.forEach(pruevva => {
            if (pruevva != null) {
              let option1 = document.createElement("option");
              option1.setAttribute("value", pruevva.Id_prueba+"-"+pruevva.tipo);
              
              let option1Texto = document.createTextNode(pruevva.nombre);
              option1.appendChild(option1Texto);
              select.appendChild(option1);
            }
              
              
          });
        }else{
          select = document.createTextNode("No hay mas pruebas disponibles");

        }


        
        contenedor.appendChild(select)
    }



    async function guardar_marcas(){
      var pruebas_envv=[]

      var select=document.getElementById("select_tests")
      //console.log(select)
      test_seleccionado=select.value


       const data_env = new FormData()

      pruebas_modal_aux.forEach(prueba => {
        var marka=document.getElementById("marka_"+prueba.Id_prueba)
        
        var prueba_env=[]
        prueba_env[0]=prueba.Id_prueba
        prueba_env[1]=marka.value

        

        pruebas_envv[prueba.Id_prueba]=prueba_env

        

        
      });

      var enlace="<?php echo RUTA_URL?>/pruebas/guardar_pruebas"

      
      var user=<?php echo $usuarioTest->id_user;?>+""
      var datos_envvv=JSON.stringify(pruebas_envv);
        data_env.append("datos", datos_envvv)
        data_env.append("test", test_seleccionado)
        data_env.append("user", user)
        //console.log(data_env)
        
      

      await  fetch(enlace,{
        method: "POST",
        body:data_env,
        
      })
        .then(response => response.text())
        .then(data => nomP = data)
        .catch( err => console.error(err));

        window.location.href = "<?php echo RUTA_URL?>/pruebas/<?php echo $datos['prueba_to_grupo']; ?>";
        



    }


    function delete_prueba(dis) {
      var parent=dis.parentNode
      var nodos_hijos=parent.childNodes
      var id_prueba=dis.firstChild.getAttribute("value")

      
      for (let i = 0; i < pruebas_modal_aux.length; i++) {
        if ( (pruebas_modal_aux[i] !=null && pruebas_modal_aux[i] != undefined)   && (pruebas_modal_aux[i].Id_prueba == id_prueba)) {
          pruebas_modal[i]=pruebas_modal_aux[i]
          pruebas_modal_aux[i]=null
        }
        
      }

      
      
      
      for (let j = 0; j < nodos_hijos.length; j++) {
        //console.log(nodos_hijos[j])
        if (nodos_hijos[j].firstChild.getAttribute("value") == id_prueba) {
          
          parent.removeChild(nodos_hijos[j])
          break;
        }
        
      }
      
      
    }

//MODAL WEEEEEEEEEEE
    const openEls = document.querySelectorAll("[data-open]");
const closeEls = document.querySelectorAll("[data-close]");
const isVisible = "is-visible-dm";

for (const el of openEls) {
  el.addEventListener("click", function() {
    const modalId = this.dataset.open;
    document.getElementById(modalId).classList.add(isVisible);
  });
}

for (const el of closeEls) {
  // click X
  el.addEventListener("click", function() {
    this.parentElement.parentElement.parentElement.classList.remove(isVisible);
  });
}

document.addEventListener("click", e => {
  //click outside modal
  if (e.target == document.querySelector(".modal-dm.is-visible-dm")) {
    document.querySelector(".modal-dm.is-visible-dm").classList.remove(isVisible);
  }
});

document.addEventListener("keyup", e => {
  // if we press the ESC
  if (e.key == "Escape" && document.querySelector(".modal-dm.is-visible-dm")) {
    document.querySelector(".modal-dm.is-visible-dm").classList.remove(isVisible);
  }
});

</script>


<?php require_once RUTA_APP.'/vistas/inc/footer.php'; ?>