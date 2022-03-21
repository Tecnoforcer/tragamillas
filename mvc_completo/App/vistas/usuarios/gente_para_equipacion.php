<?php require_once RUTA_APP.'/vistas/inc/header.php';?>


<div class="row justify-content-center my-4 ">
    <div class="col-3 me-5">
        <input type="text" name="busqueda" id="busqueda" class="form-control" placeholder="BUSCAR" oninput="comprobarBusqueda()">
    </div> 
    <div class="col-2 ">
        <select name="num_registros_change" id="num_registros_change" class="form-select" oninput="change_epp(this)">
            <option value="5">5 registros</option>
            <option value="10"  selected>10 registros</option>
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
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>  
                <th>Entrenador/Socio</th>                        
                <th>Tipo</th>
                <th>Talla</th>
                <th>Entregar</th>
            </tr>
        </thead>
        <tbody id="tbodyy">
                
            
        </tbody>
    </table>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="ModalTitler" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
        <div class="modal-header">
            <h5 class="modal-title" id="ModalTitler">Tienda</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="contenidoModalUsuario">

            <form method="post" class="card-body" id="form">

                <input  type="hidden" name="id_user" id="id_user">

                <div class="mb-2">
                    <label for="dni">DNI: <sup>*</sup></label>
                    <input type="text" name="dni" id="dni" class="form-control form-control-lg" readonly>
                </div>
                <div class="mt-3 mb-2">
                    <label for="nombre">Nombre: <sup>*</sup></label>
                    <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" readonly>
                </div>
                <div class="mb-2">
                    <label for="apellido">Apellido: <sup>*</sup></label>
                    <input type="text" name="apellido" id="apellido" class="form-control form-control-lg" readonly>
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
            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" onclick="pedirEquipacion()">Confirmar Pedido</button>
        </div>
        </div>
    </div>
</div> 




<div class="text-center">
    <a onclick="action_decider(this)" id="gotofirst" class="btn btn-outline-secondary"><<</a>
    
    <a  onclick="action_decider(this)" id="num_prev" class="btn btn-outline-secondary">1</a>
    <a   id="num_this" class="btn btn-outline-success">2</a>
    <a  onclick="action_decider(this)" id="num_next" class="btn btn-outline-secondary">3</a>
   
    <a  onclick="action_decider(this)" id="gotolast" class="btn btn-outline-secondary">>></a>
</div>



<script>
    let usuarios = [];
    let usuarios_usar = [];
    
    async function obtener_peticiones_equipacion(){
        await fetch('/usuarios/obtener_usuarios_equipacion/')
        .then((resp) => resp.json())
        .then(function(data) {
            usuarios = data;
            usuarios_usar=data;
            //console.log(usuarios)       
        })
        .catch( err => {
            console.error(err)            
        });

    }
    


    async function pedirEquipacion(){
        data = new FormData(document.getElementById("form"))
        //console.log(Object.fromEntries(data))

        await fetch('/usuarios/add_pedido/',{
            method: "POST",
            body:data,      
        })
        .then((resp) => resp.json())
        .then(function(data) {
            //console.log(data)      
           
            usuarios = data;
            tbody.innerHTML = ""
            get_paige(p_actual) //  rellenarTabla()   //ffs: check this
        })
        .catch( err => {
            console.error(err)            
        });
    }
    

    function rellenarTabla(usuarioss,pos_ini){
        //console.log(usuarioss);
        //await obtener_peticiones_equipacion();
        tbody = document.getElementById("tbodyy");

        for (let i = 0; i < usuarioss.length; i++) {
            if (usuarioss[i] == undefined) {
                continue;
            }
            tr = document.createElement("tr");
            tr.id = "linea_"+usuarioss[i].id_user
            
            id_user = document.createElement("td");
            td_dni = document.createElement("td");
            td_nombre = document.createElement("td");
            td_apellido = document.createElement("td");
            td_rol = document.createElement("td");
            td_talla = document.createElement("td");
            td_tipo = document.createElement("td");
            td_entregar = document.createElement("td");

            id_user.appendChild(document.createTextNode(usuarioss[i].id_user));
            id_user.setAttribute("hidden",true);

            td_dni.appendChild(document.createTextNode(usuarioss[i].dni));

            td_nombre.appendChild(document.createTextNode(usuarioss[i].nombre));
            td_apellido.appendChild(document.createTextNode(usuarioss[i].apellido));

            if (usuarioss[i].rol==5){
                td_rol.appendChild(document.createTextNode("Entrenador"))
                td_rol.classList.add("text-danger")
            }else{
                td_rol.appendChild(document.createTextNode("Socio"))
                td_rol.classList.add("text-primary")
            }

            selectList = document.createElement("select")
            selectList.id = "lista-equipacion-"+usuarioss[i].id_user;

            tallas = ["Seleccionar talla", "unica", "XXXS", "XXS", "XS","S","M","L", "XL", "XXL", "XXXL"];

            for (let i = 0; i < tallas.length; i++) {
                var option = document.createElement("option");
                    if (tallas[i]=="Seleccionar talla"){
                        option.value = null;
                    }else{
                        option.value = tallas[i];
                    }
                    option.text = tallas[i];
                    selectList.appendChild(option);
            }

            td_talla.appendChild(selectList)

            tipo = document.createElement("input")
            tipo.setAttribute('type', 'text')
            tipo.classList.add("form-control", "text-dark")
            tipo.id = "tipo_"+usuarioss[i].id_user
            tipo.setAttribute('placeholder',"seleccionar tipo")
            td_tipo.appendChild(tipo)
            pos_user=pos_ini+i;
            td_entregar.innerHTML = "<button type='button' id='boton_"+usuarioss[i].id_user+"' disabled class='btn me-2 btn-outline-success btn-block' data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\" onclick=\"usuarioActual("+pos_user+", '"+selectList.id+"', '"+tipo.id+"')\">Pedir</button>";


            selectList.setAttribute("onchange", "habilitarBoton(boton_"+usuarioss[i].id_user+".id,'"+selectList.id+"','"+tipo.id+"')")
            tipo.setAttribute("onkeyup", "habilitarBoton(boton_"+usuarioss[i].id_user+".id,'"+selectList.id+"','"+tipo.id+"')")
            selectList.classList.add("form-select", "col")
            

            tr.appendChild(id_user)
            tr.appendChild(td_dni)
            tr.appendChild(td_nombre)
            tr.appendChild(td_apellido)
            tr.appendChild(td_rol)
            tr.appendChild(td_tipo)
            tr.appendChild(td_talla)            
            tr.appendChild(td_entregar)
            tbody.appendChild(tr);
        }
    }

    function usuarioActual(i, lista, tipo){
        document.getElementById("id_user").value= usuarios_usar[i].id_user
        document.getElementById("nombre").value= usuarios_usar[i].nombre
        document.getElementById("apellido").value= usuarios_usar[i].apellido
        document.getElementById("dni").value= usuarios_usar[i].dni

        document.getElementById("talla").value= document.getElementById(lista).value

        for (let i = 0; i < document.getElementById("talla").length; i++) {
            if (document.getElementById(lista).value==document.getElementById("talla")[i].value) {
                document.getElementById("talla")[i].selected
            }    
        }

        document.getElementById("tipo").value= document.getElementById(tipo).value
    }

    function habilitarBoton(id, tallas, tipo){
        
        //console.log(tipo)
        //console.log(id)
        //console.log(tallas)
        if(document.getElementById(tallas).value=="null" || document.getElementById(tipo).value==""){
           document.getElementById(id).setAttribute("disabled", true)
        }else{
           document.getElementById(id).removeAttribute("disabled")
        }

    }

    //rellenarTabla()



    function comprobarBusqueda(){
        input_busqueda=document.getElementById("busqueda")
        busqueda = input_busqueda.value.trim().toLowerCase();

         
        //console.log(busqueda);
        usuarios_usar=[];
        cont=0;
        
        for (let i = 0; i < usuarios.length; i++) {
            dni=usuarios[i].dni.toLowerCase()
            nombre=usuarios[i].nombre.toLowerCase()
            apellido=usuarios[i].apellido.toLowerCase()

            nom_apel=nombre+" "+apellido


            if(dni.includes(busqueda) || nombre.includes(busqueda) || apellido.includes(busqueda) || nom_apel.includes(busqueda)){
                usuarios_usar[cont]=usuarios[i]
                cont++
            } 
        }
        
        
    
            get_pmax_busqeda()
     
        //console.log(usuarios_usar)
        if (usuarios_usar.length == 0 || busqueda == "") {
            usuarios_usar=usuarios;
            
           //console.log(usuarios_usar)
           
        }
        if (busqueda == "") {
            input_busqueda.value=""
        }
    }

    function change_epp(dis) {
        
        //console.log(dis.value);
        element_per_paige=parseInt(dis.value)
        get_pmax_busqeda()
    }

    change_epp(document.getElementById("num_registros_change"))

    //////////////////////////////////////////////////////////////////////////PARTE-PAGINACION-SOLO-JS/////////////////////////////////////////////////////////////





    var element_per_paige=10//ffs: or any other number  //ffs: futuras versiones poder cambiar el num elementos
    var p_actual=1 //ffs: comprobaciones / reload pag btns
    var pmax //ffs: se establece al cargar pagina, ya nos ocuparemos de eso luego
    var p_next //ffs: num nxt
    var p_prev //ffs: num prev
    var p_jump //ffs: mejora para futura version

    //var pmax //ffs: obtenido del aguait

    async function get_pmax() {
        await obtener_peticiones_equipacion()
        pmax=Math.ceil(usuarios_usar.length/element_per_paige)
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
        
        pmax=Math.ceil(usuarios_usar.length/element_per_paige)
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


    if (usuarios_usar.length == 0) {
        document.getElementById("tbodyy").innerHTML = ""
    } else {
        for (let i = 0; i < element_per_paige; i++) {
            var position=ini_pagina+i
            usu_env[cont]=usuarios_usar[position]
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







</script>

<?php require_once RUTA_APP.'/vistas/inc/footer.php';?> 