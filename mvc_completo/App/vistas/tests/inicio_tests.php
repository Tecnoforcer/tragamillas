<?php require_once RUTA_APP.'/vistas/inc/header.php';?>
    <h1>TESTZONE (WW3 EDITION)</h1>
    
<?php //print_r($datos["tests"]) ?>

<div class="row">
<table class="table" id="tabla_usuarios">
    <thead id="table_head">
                <tr>
                    
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
    </thead>
    <tbody id='tbodyTablaUsuarios'>



    </tbody>

</table>
<?php if (tienePrivilegios($datos['usuarioSesion']->rol,[5])):?>
    <div class="col text-center">
        <button type="button" class="btn btn-outline-success btn-lg" onclick="clear_modal_test()" data-bs-toggle="modal" data-bs-target="#Modal_Agregar">
        <i class="bi bi-plus-circle"></i>
        </button>
</div>

    
<?php endif ?>
</div>
 



<div class="modal fade" id="Modal_Agregar" tabindex="-1" aria-labelledby="ModalTitler" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
        <div class="modal-header">
            <h5 class="modal-title" id="ModalTitler">Editar Usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="contenidoModalTest">

            <form method="post" class="card-body" id="form-editar" >
                <input type="hidden" value="nil" id="test">

                <div class="mt-3 mb-3">
                    <label for="nombre">Nombre: <sup>*</sup></label>
                    <input type="text" name="nombre" id="nombre" class="form-control form-control-lg">
                </div>
                <div class="mb-3">
                    <label for="fecha">Fecha: <sup>*</sup></label>
                    <input type="date" name="fecha" id="fecha" class="form-control form-control-lg">
                </div>
                
                
                
            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success" id="btn_send_modal" data-bs-dismiss="modal">Editar </button>
        </div>
        </div>
    </div>
</div>


<script>
async function rellenar_tabla() {
    var tbodyy=document.getElementById("tbodyTablaUsuarios")
    tbodyy.innerHTML=""

    var enlace="<?php echo RUTA_URL?>/tests/obtenerTestss"
    await fetch(enlace)
        .then(response => response.json())
        .then(data => nomP = data)
        .catch( err => console.error(err));

        //console.log(nomP)

    nomP.forEach(row => {
        var function_onclik="rellenar_modal("+row.id_test+")"
        //console.log(row)
        var trr=document.createElement("tr")

        var td_nom=document.createElement("td")
        var nom=document.createTextNode(row.Nombre)

        td_nom.appendChild(nom)


        var td_dat=document.createElement("td")
        var dat=document.createTextNode(row.fecha)

        td_dat.appendChild(dat)


        var td_act=document.createElement("td")
        var act=document.createTextNode(" ")
<?php if (tienePrivilegios($datos['usuarioSesion']->rol,[5])):?>
        act=document.createElement("button")
        act.setAttribute("type","button")
        act.setAttribute("class","btn btn-outline-primary btn-lg")
        act.setAttribute("onclick",function_onclik)
        act.setAttribute("data-bs-toggle","modal")
        act.setAttribute("data-bs-target","#Modal_Agregar")
        var icon=document.createElement("i")
        icon.setAttribute("class","bi bi-pencil-square")
        act.appendChild(icon)

<?php endif ?>
        
        td_act.appendChild(act)
        trr.appendChild(td_nom)
        trr.appendChild(td_dat)
        trr.appendChild(td_act)

        tbodyy.appendChild(trr)
    });



}
rellenar_tabla()


function clear_modal_test() {
    var titler=document.getElementById("ModalTitler")
    titler.innerHTML="Añadir Usuario"

    var btn=document.getElementById("btn_send_modal")
    btn.removeAttribute("onclick")
    btn.setAttribute("onclick","add_test()")
    btn.innerHTML="Añadir "


    var test=document.getElementById("test")
    var name=document.getElementById("nombre")
    var datee=document.getElementById("fecha")

    name.value=""
    datee.value="dd / mm / aaaa"
    test.value="nil"
}

async function rellenar_modal(id_test) {
    var titler=document.getElementById("ModalTitler")
    titler.innerHTML="Editar Usuario"

    var btn=document.getElementById("btn_send_modal")
    btn.removeAttribute("onclick")
    btn.setAttribute("onclick","editar_test()")
    btn.innerHTML="Editar "



    var test=document.getElementById("test")
    var name=document.getElementById("nombre")
    var datee=document.getElementById("fecha")


    var enlace="<?php echo RUTA_URL?>/tests/obtener_test/"+id_test
    var nomP="a"
    await  fetch(enlace)
        .then(response => response.json())
        .then(data => nomP = data)
        .catch( err => console.error(err));

      //console.log(nomP.Nombre)

    name.value=nomP.Nombre
    datee.value=nomP.fecha
    test.value=nomP.id_test
    
}

async function add_test() {
    
    var name=document.getElementById("nombre").value
    var datee=document.getElementById("fecha").value

    const data_env = new FormData()
    data_env.append("name",name)
    data_env.append("datee",datee)

    var enlace="<?php echo RUTA_URL?>/tests/guardar_tests"
    var nomP="a"
    await  fetch(enlace,{
        method: "POST",
        body:data_env,
        
      })
        .then(response => response.text())
        .then(data => nomP = data)
        .catch( err => console.error(err));

      //console.log(nomP)

      rellenar_tabla()
    
}

async function editar_test() {
    
    var test=document.getElementById("test").value
    var name=document.getElementById("nombre").value
    var datee=document.getElementById("fecha").value

    const data_env = new FormData()
    data_env.append("name",name)
    data_env.append("datee",datee)
    data_env.append("idd",test)

    var enlace="<?php echo RUTA_URL?>/tests/editar_Test"
    var nomP="a"
    await  fetch(enlace,{
        method: "POST",
        body:data_env,
        
      })
        .then(response => response.text())
        .then(data => nomP = data)
        .catch( err => console.error(err));

      //console.log(nomP)

      rellenar_tabla()
    
}


</script>

<?php require_once RUTA_APP.'/vistas/inc/footer.php';?>


























