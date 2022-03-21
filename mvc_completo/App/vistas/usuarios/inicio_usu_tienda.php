<?php require_once RUTA_APP.'/vistas/inc/header.php';?>
<!-- blyatman -->

<div class="row justify-content-center my-4 ">
    <div class="col-3 me-5">
        <input type="text" name="busqueda" id="busqueda" class="form-control" placeholder="BUSCAR" oninput="comprobarBusqueda()">
    </div> 
    <div class="col-2 ">
        <select name="num_registros_change" id="num_registros_change" class="form-select" oninput="change_epp(this)">
            <option value="5" selected>5 registros</option>
            <option value="10">10 registros</option>
            <option value="25">25 registros</option>
            <option value="50">50 registros</option>
            <option value="100">100 registros</option>

        </select>
    </div>   
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>  
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>DNI</th>
                <th>Tipo</th>
                <th>Talla</th>
                <th>Entregar</th>
            </tr>
        </thead>
        <tbody id="tbodyy">
                
            
        </tbody>
    </table>
</div>

<div class="text-center">
    <a onclick="action_decider(this)" id="gotofirst" class="btn btn-outline-secondary"><<</a>
    
    <a  onclick="action_decider(this)" id="num_prev" class="btn btn-outline-secondary">1</a>
    <a   id="num_this" class="btn btn-outline-success">2</a>
    <a  onclick="action_decider(this)" id="num_next" class="btn btn-outline-secondary">3</a>
   
    <a  onclick="action_decider(this)" id="gotolast" class="btn btn-outline-secondary">>></a>
</div>

 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="ModalTitler" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
        <div class="modal-header">
            <h5 class="modal-title" id="ModalTitler">Tienda</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="contenidoModalUsuario">

            <form method="post" class="card-body" id="form">

                <input  type="hidden" name="id_equipacion" id="id_equipacion">

                <div class="mt-3 mb-2">
                    <label for="nombre">Nombre: <sup>*</sup></label>
                    <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" readonly>
                </div>
                <div class="mb-2">
                    <label for="apellido">Apellido: <sup>*</sup></label>
                    <input type="text" name="apellido" id="apellido" class="form-control form-control-lg" readonly>
                </div>
                <div class="mb-2">
                    <label for="dni">DNI: <sup>*</sup></label>
                    <input type="text" name="dni" id="dni" class="form-control form-control-lg" readonly>
                </div>
                <div class="mb-2">
                    <label for="tipo">Tipo: <sup>*</sup></label>
                    <input type="text" name="tipo" id="tipo" class="form-control form-control-lg">
                </div>
                <div class="mb-2">
                    <label for="talla">Talla: <sup>*</sup></label>
                    <select class="form-select" name="talla" id="talla">
                        <option value="unica">unica</option>
                        <option value="XXXS">XXXS</option>
                        <option value="XXS">XXS</option>
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                        <option value="XXXL">XXXL</option>
                    </select>
                </div>
            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" onclick="equipacion_entregada()">Confirmar Entrega</button>
        </div>
        </div>
    </div>
</div> 




  <script>
    let listarEquipacion = [];
    let listarEquipacion_usar = [];

    
    
    async function obtener_peticiones_equipacion(){
        await fetch('/usuarios/equipacion/')
        .then((resp) => resp.json())
        .then(function(data) {
            listarEquipacion = data;
            listarEquipacion_usar=data;
            //console.log(usuarios)       
        })
        .catch( err => {
            console.error(err)            
        });
        //console.log(listarEquipacion)
    }


    async function rellenarTabla(listarEquipacionss,pos_ini){
        await obtener_peticiones_equipacion();
        tbody = document.getElementById("tbodyy");

       // console.log(listarEquipacionss)
        for (let i = 0; i < listarEquipacionss.length; i++) {
            if (listarEquipacionss[i] == undefined) {
                continue;
            }
            tr = document.createElement("tr")

            id_equipacion = document.createElement("td")
            td_tipo = document.createElement("td")
            td_fecha = document.createElement("td")
            td_nombre = document.createElement("td")
            td_apellido = document.createElement("td")
            td_dni = document.createElement("td")
            td_talla = document.createElement("td")
            td_entregar = document.createElement("td")

            id_equipacion.appendChild(document.createTextNode(listarEquipacionss[i].id_equipacion))
            id_equipacion.setAttribute("hidden",true)

            tipo = document.createElement("input")
            tipo.setAttribute('type', 'text')
            tipo.classList.add("form-control", "text-dark")
            tipo.id = "tipo_"+listarEquipacionss[i].id_equipacion
            if (listarEquipacionss[i].tipo=="") {
                tipo.setAttribute('placeholder',"seleccionar tipo")
            }else{
                tipo.value = listarEquipacionss[i].tipo
            }
            

            td_tipo.appendChild(tipo)


            selectList = document.createElement("select")
            selectList.id = "lista-equipacion-"+listarEquipacionss[i].id_equipacion;

            tallas = ["Seleccionar talla", "unica", "XXXS", "XXS", "XS","S","M","L", "XL", "XXL", "XXXL"];

            for (let j = 0; j < tallas.length; j++) {
                var option = document.createElement("option");
                    if (tallas[j]=="Seleccionar talla"){
                        option.value = null;
                    }else{
                        option.value = tallas[j];
                    }
                    option.text = tallas[j];
                    if (option.text==listarEquipacionss[i].talla) {
                        option.selected = true
                    }
                    
                    
                    selectList.appendChild(option);
            }

            td_fecha.appendChild(document.createTextNode(listarEquipacionss[i].fecha_peticion))
            td_nombre.appendChild(document.createTextNode(listarEquipacionss[i].nombre))
            td_apellido.appendChild(document.createTextNode(listarEquipacionss[i].apellido))
            td_dni.appendChild(document.createTextNode(listarEquipacionss[i].dni))


            td_talla.appendChild(selectList)
            td_entregar.innerHTML = "<button type='button' id='boton_"+listarEquipacionss[i].id_equipacion+"' disabled class='btn me-2 btn-outline-success btn-block' data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\" onclick=\"equipacionActual("+i+", '"+selectList.id+"', '"+tipo.id+"')\">Entregar</button>";

            selectList.setAttribute("onchange", "habilitarBoton(boton_"+listarEquipacionss[i].id_equipacion+".id,'"+selectList.id+"','"+tipo.id+"')")
            tipo.setAttribute("onkeyup", "habilitarBoton(boton_"+listarEquipacionss[i].id_equipacion+".id,'"+selectList.id+"','"+tipo.id+"')")
            selectList.classList.add("form-select", "col")

            tr.appendChild(id_equipacion)
            tr.appendChild(td_fecha)
            tr.appendChild(td_nombre)
            tr.appendChild(td_apellido)
            tr.appendChild(td_dni)
            tr.appendChild(td_tipo)
            tr.appendChild(td_talla)            
            tr.appendChild(td_entregar)

            tbody.appendChild(tr)  
            habilitarBoton("boton_"+listarEquipacionss[i].id_equipacion,selectList.id,tipo.id)
        }        
    }

    function equipacionActual(i, lista, tipo){
        
        document.getElementById("id_equipacion").value= listarEquipacion[i].id_equipacion
        document.getElementById("nombre").value= listarEquipacion[i].nombre
        document.getElementById("apellido").value= listarEquipacion[i].apellido
        document.getElementById("dni").value= listarEquipacion[i].dni
        document.getElementById("talla").value= document.getElementById(lista).value

        for (let i = 0; i < document.getElementById("talla").length; i++) {
            if (document.getElementById(lista).value==document.getElementById("talla")[i].value) {
                document.getElementById("talla")[i].selected
            }    
        }

        document.getElementById("tipo").value= document.getElementById(tipo).value

    }

    async function equipacion_entregada(){
           
        data = new FormData(document.getElementById("form"))
            
        //console.log(Object.fromEntries(data)) 
            
        await fetch('/usuarios/equipacion_entregada/', {
        method: "POST",
        body: data,
        })
        .then((resp) => resp.json())
        .then(function(data) {
            listarEquipacion = data
            //document.getElementById("tbodyy").innerHTML = ""
            //rellenarTabla();
        })
        .catch( err => {
            // alert("Error al actualizar el usuario")
            console.error(err)
        
        }); 
    }

    function habilitarBoton(id, tallas, tipo){
        
        //console.log(id)
        //console.log(tallas)
        //console.log(tipo)
        if(document.getElementById(tallas).value=="null" || document.getElementById(tipo).value==""){
           document.getElementById(id).setAttribute("disabled", true)
        }else{
           document.getElementById(id).removeAttribute("disabled")
        }        
    }

    




//////////////////////////////////////////////////////////////////////////////////////////////////////////




    function comprobarBusqueda(){
        input_busqueda=document.getElementById("busqueda")
        busqueda = input_busqueda.value.trim().toLowerCase();

         
        //console.log(busqueda);
        listarEquipacion_usar=[];
        cont=0;
        
        for (let i = 0; i < listarEquipacion.length; i++) {
            dni=listarEquipacion[i].dni.toLowerCase()
            nombre=listarEquipacion[i].nombre.toLowerCase()
            apellido=listarEquipacion[i].apellido.toLowerCase()

            nom_apel=nombre+" "+apellido


            if(dni.includes(busqueda) || nombre.includes(busqueda) || apellido.includes(busqueda) || nom_apel.includes(busqueda)){
                listarEquipacion_usar[cont]=listarEquipacion[i]
                cont++
            } 
        }
        
        
    
            get_pmax_busqeda()
     
        //console.log(listarEquipacion_usar)
        if (listarEquipacion_usar.length == 0 || busqueda == "") {
            listarEquipacion_usar=listarEquipacion;
            
           //console.log(listarEquipacion_usar)
           
        }
        if (busqueda == "") {
            input_busqueda.value=""
        }
    }






//paginacion


    var element_per_paige=5//ffs: or any other number  //ffs: futuras versiones poder cambiar el num elementos
    var p_actual=1 //ffs: comprobaciones / reload pag btns
    var pmax //ffs: se establece al cargar pagina, ya nos ocuparemos de eso luego
    var p_next //ffs: num nxt
    var p_prev //ffs: num prev
    var p_jump //ffs: mejora para futura version

    //var pmax //ffs: obtenido del aguait

    async function get_pmax() {
        await obtener_peticiones_equipacion()
        pmax=Math.ceil(listarEquipacion_usar.length/element_per_paige)
        //console.log(pmax);
        if (p_actual > pmax) {
            p_actual=pmax
        }else if (p_actual <= 0){
            p_actual=1
        }
        
        get_paige(p_actual)
    }
    get_pmax()



    function get_pmax_busqeda() {
        
        pmax=Math.ceil(listarEquipacion_usar.length/element_per_paige)
        //console.log(pmax);
        if (p_actual > pmax) {
            p_actual=pmax
        }else if (p_actual <= 0){
            p_actual=1
        }
        
        get_paige(p_actual)
    }
    
    

async function get_paige(gotop) {
    //await get_pmax();
    var first_page=document.getElementById("gotofirst")
    //var prev_dot=document.getElementById("dot_prev")

    var dis_page=document.getElementById("num_this")
    var nxt_page=document.getElementById("num_next")
    var prv_page=document.getElementById("num_prev")


    //var next_dot=document.getElementById("dot_next")
    var last_page=document.getElementById("gotolast")
 
    
    p_actual=gotop //ffs: watch this out


    //console.log(pmax+"---"+p_actual);
    if (p_actual <= 1) {
        p_prev="nil" //ffs: controlar esto mejor
        prv_page.innerHTML="nil"


        //prev_dot.setAttribute("hidden",true)
        first_page.setAttribute("hidden",true)
        prv_page.setAttribute("hidden",true)
    }else{
        p_prev=parseInt(p_actual)-1
        prv_page.innerHTML=p_prev

        //prev_dot.removeAttribute("hidden")
        first_page.removeAttribute("hidden")
        prv_page.removeAttribute("hidden")
    }
    
    if (p_actual >= pmax) {
        p_next="nil" //ffs: controlar esto mejor
        nxt_page.innerHTML="nil"


        //next_dot.setAttribute("hidden",true)
        last_page.setAttribute("hidden",true)
        nxt_page.setAttribute("hidden",true)
    }else{
        p_next=parseInt(p_actual)+1
        nxt_page.innerHTML=p_next

        //next_dot.removeAttribute("hidden")
        last_page.removeAttribute("hidden")
        nxt_page.removeAttribute("hidden")
    }
    
    dis_page.innerHTML=p_actual

    


    var ini_pagina=(p_actual-1)*element_per_paige
    var cont=0
    var usu_env=[]


    if (listarEquipacion_usar.length == 0) {
        document.getElementById("tbodyy").innerHTML = ""
    } else {
        for (let i = 0; i < element_per_paige; i++) {
            var position=ini_pagina+i
            usu_env[cont]=listarEquipacion_usar[position]
            cont++
        }
    //console.log("-----------------");
            document.getElementById("tbodyy").innerHTML = ""
           rellenarTabla(usu_env,ini_pagina)
    }



    
     
    
}


function action_decider(dis) {
    


    switch (dis.id) {
        case "gotofirst":
            get_paige(1)
            break;
        case "gotolast":
            get_paige(pmax)
        break;
        case "num_prev":
            
            get_paige(p_prev)
        break;
        case "num_next":
            get_paige(p_next)
        break;
        

        default:
            break;
    }


}


    function change_epp(dis) {
        
        //console.log(dis.value);
        element_per_paige=parseInt(dis.value)
        comprobarBusqueda()
    }
</script>
<?php require_once RUTA_APP.'/vistas/inc/footer.php';?> 