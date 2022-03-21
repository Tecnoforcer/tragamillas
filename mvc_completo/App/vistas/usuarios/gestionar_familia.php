<?php require_once RUTA_APP.'/vistas/inc/header.php';?>

<div id="titulo"></div>

<div hidden class="row justify-content-center">
    <h3 class="col-12 text-center mb-3">Familiares </h3>
    <ul class="col-lg-5" id="lista_familiares">

    </ul>
    <div class="clearfix"></div>
    <button type="button" class="btn btn-success col-lg-2 col-md-3 col-sm-4 col-3 me-2 p-auto" data-bs-toggle="modal" data-bs-target="#modal" onclick="rellenarModal('asignar')">Confirmar Familiares</button>
    <button hidden id="boton_des_familia" type="button" class="btn btn-danger col-lg-2 col-md-3 col-sm-4 col-3 ms-2"data-bs-toggle="modal" data-bs-target="#modal" onclick="rellenarModal('deshacer')">Deshacer Familia</button>
</div>

<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="ModalTitler3" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
        <div class="modal-header">
            <h5 class="modal-title" id="ModalTitler3">Miembros de Familia</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <ul id="contenidoModal">

            </ul>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" id="boton_modal"></button>
        </div>
        </div>
    </div>
</div>


<div class="row justify-content-center my-4 ">
    <div class="col-3 me-5">
        <input type="text" name="busqueda" id="busqueda" class="form-control" placeholder="BUSCAR" oninput="comprobarBusqueda()">
    </div>       
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>  
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>  
                <th>Asignar</th>
            </tr>
        </thead>
        <tbody id="tbodyy">
                
            
        </tbody>
    </table>
</div> 


<script>
    let cabeza;
    let usuarios = [];
    let usuarios_usar = [];
    let usuarios_datos = [];

    let familiares = [];
    

    async function cabeza_de_familia(){

        await fetch('/usuarios/obtener_usu_actual/<?php echo $datos["id_socio"]?>')
        .then((resp) => resp.json())
        .then(function(data) {
            cabeza = data
        })
    }

    function rellenarModal(accion){
        salida = document.getElementById("contenidoModal")
        salida.innerHTML = ""

        for (let i = 0; i < familiares.length; i++) {
            li = document.createElement("li")
            
            if (i==0) {
                li.appendChild(document.createTextNode("Cabeza de Familia: "+familiares[i]["nombre"]+" "+familiares[i]["apellido"]))
                li.classList.add("fw-bold")
            }else{
                li.appendChild(document.createTextNode("Familiar "+i+": "+familiares[i]["nombre"]+" "+familiares[i]["apellido"]))
            }

            salida.appendChild(li)
        }

        boton_modal = document.getElementById("boton_modal")

        if(accion == "asignar"){
            boton_modal.setAttribute('onclick', "asignar_familiares()")
            
            boton_modal.classList.remove("btn-danger")
            boton_modal.classList.add("btn-success")
            boton_modal.innerHTML= "Confirmar" 

        }else if(accion == "deshacer"){
            boton_modal.setAttribute('onclick', "deshacer_familia()")

            boton_modal.classList.remove("btn-success")
            boton_modal.classList.add("btn-danger")
            boton_modal.innerHTML= "Deshacer Familia" 
        }

    }
    

    async function deshacer_familia(){

        id_cabeza=<?php echo $datos["id_socio"]?>

        data = new FormData()
        data.append('id_cabeza', id_cabeza)

        
        await fetch('/usuarios/deshacer_familia/', {
            method: "POST",
            body: data,
        })
        .then((resp) => resp.json())
        .then(function(data) {
            window.alert("Familia disuelta correctamente")
            usuarios = data
            familiares.splice(1)     
        }) 

        mostrar_lista()
        
        document.getElementById("boton_des_familia").setAttribute("hidden",true)

        rellenarTabla(usuarios)

        

        for (let i = 0; i < usuarios.length; i++) {
            document.getElementById("checkbox_"+usuarios[i]["id_user"]).removeAttribute("checked")
        }
    }


    async function titulo(){
        await cabeza_de_familia();

        //console.log(cabeza["datos_usu"]["nombre"])

        titulo = document.createElement("h1")
        titulo.appendChild(document.createTextNode("Asignar Familiares a "+cabeza["datos_usu"]["nombre"]+" "+cabeza["datos_usu"]["apellido"]))
        titulo.classList.add("my-3", "text-center", )

        document.getElementById("titulo").appendChild(titulo)
        
    }

    async function asignar_familiares(){
        ids = "("
        for (let i = 0; i < familiares.length; i++) {
            if (i==(familiares.length-1)) {
                ids+=familiares[i]["id_user"]
            }else{
                ids+=familiares[i]["id_user"]+","
            }
            
        }
        ids+=")"
        
        id_cabeza=<?php echo $datos["id_socio"]?>

        data = new FormData()
        data.append('ids',ids)
        data.append('id_cabeza',id_cabeza)

        await fetch('/usuarios/asignar_familiares/', {
            method: "POST",
            body: data,
        })
        .then((resp) => resp.json())
        .then(function(data) {
            //console.log(data)

            if (Boolean(data)){
                window.alert("Familiares asignados correctamente")
            } else {
                alert('Error al asignar los familiares')
            }  
            
        })  

        document.getElementById("boton_des_familia").removeAttribute("hidden")


    }

    async function obtener_socios(){
        await fetch('/usuarios/obtener_socios')
        .then((resp) => resp.json())
        .then(function(data) {
            //console.log(data);
            usuarios=data;
                              
        })
        .catch( err => {
            console.error(err)            
        });


        for (let i = 0; i < usuarios.length; i++) {
            if (usuarios[i].id_user==<?php echo $datos["id_socio"]?>) {
                familiares.push(usuarios[i]);
                usuarios.splice(i,1);
            }

            if (usuarios[i].familiar!=null && usuarios[i].familiar!=<?php echo $datos["id_socio"]?>) {
                usuarios.splice(i,1);
                i--;
            }  
        }

        usuarios_usar=usuarios
        //console.log(usuarios)
        rellenarTabla(usuarios_usar)
    }


    titulo();
    obtener_socios();


    function rellenarTabla(usuarioss){

        tbody = document.getElementById("tbodyy");
        tbody.innerHTML=""

        usuarios_datos_seted=false
        if (usuarios_datos.length != 0) {
            usuarios_datos_seted=true
        }
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
            td_asignar = document.createElement("td");

            id_user.appendChild(document.createTextNode(usuarioss[i].id_user));
            id_user.setAttribute("hidden",true);

            td_dni.appendChild(document.createTextNode(usuarioss[i].Dni));

            td_nombre.appendChild(document.createTextNode(usuarioss[i].nombre));
            td_apellido.appendChild(document.createTextNode(usuarioss[i].apellido));



            checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.name = "checkbox_"+usuarioss[i].id_user;
            checkbox.id = "checkbox_"+usuarioss[i].id_user;
            checkbox.value = usuarioss[i].id_user;
            checkbox.setAttribute("onclick","change_checkbox_usu(this)")

                        
                if (usuarios_datos_seted) {
                    for (let j = 0; j < usuarios_datos.length; j++) {
                        if (usuarioss[i].id_user == usuarios_datos[j][0]) {
                            if (usuarios_datos[j][1] == "nil") {
                                checkbox.removeAttribute("checked")
                            }else{
                                checkbox.setAttribute("checked",true)
                            }
                        }
                        
                    }
                }else{
                    var checkbox_dat=[]
                    checkbox_dat[0]=usuarioss[i].id_user
                    checkbox_dat[1]="nil"
                    usuarios_datos[i]=checkbox_dat
                    
                    checkbox.removeAttribute("checked")
                }
      

            td_asignar.appendChild(checkbox)


            

            tr.appendChild(id_user)
            tr.appendChild(td_dni)
            tr.appendChild(td_nombre)
            tr.appendChild(td_apellido)           
            tr.appendChild(td_asignar)
            tbody.appendChild(tr);

            if (usuarioss[i].familiar==cabeza["datos_usu"]["id_user"]) {
                checkbox.checked = true

                insertar_familiar_lista(usuarioss[i].id_user)
                if (familiares.length>1) {
                    document.getElementById("boton_des_familia").removeAttribute("hidden")
                }
            }

        }
        //console.log(familiares)
    }

    function mostrar_lista(){
        lista = document.getElementById("lista_familiares")
        lista.innerHTML = ""

        if (familiares.length<=1) {
            document.getElementById("lista_familiares").parentElement.setAttribute("hidden", true)
        }else{
            document.getElementById("lista_familiares").parentElement.removeAttribute("hidden")

            for (let i = 0; i < familiares.length; i++) {
                if (i==0) {
                    lista.innerHTML += "<li class=\"fw-bold\" id=\""+familiares[i]["id_user"]+"\" style=\"list-style: none;\">Cabeza de Familia: "+familiares[i]["nombre"]+" "+familiares[i]["apellido"]+"</li>"
                }else{
                    lista.innerHTML += "<li id=\"familiar_"+familiares[i]["id_user"]+"\" style=\"list-style: none;\">familiar "+i+": "+familiares[i]["nombre"]+" "+familiares[i]["apellido"]+"</li>"
                }
            }
        }
    }

    function insertar_familiar_lista(id){
        existe=false
        for (let i = 0; i < familiares.length; i++) {
           
            if (familiares[i]["id_user"]==id) {
                existe=true
                break
            }
            
        }

        if (document.getElementById("checkbox_"+id).checked && existe==false) {
            for (let i = 0; i < usuarios.length; i++) {
                if (usuarios[i]["id_user"]==id) {
                    familiares.push(usuarios[i])
                    break;
                }       
            }
        }
        //console.log(familiares)
        mostrar_lista()
        
    }

    function retirar_familiar_lista(id){

        if (!document.getElementById("checkbox_"+id).checked && document.getElementById("familiar_"+id)!=null) {
           for (let i = 0; i < familiares.length; i++) {
                if (familiares[i]["id_user"]==id) {
                    familiares.splice(i,1) 
                    break;
                }
            }

        }
        //console.log(familiares)
        mostrar_lista()
        
    }

    function comprobarBusqueda(){
        input_busqueda=document.getElementById("busqueda")
        busqueda = input_busqueda.value.trim().toLowerCase();

         
        //console.log(busqueda);
        usuarios_usar=[];
        cont=0;
        
        for (let i = 0; i < usuarios.length; i++) {
            dni=usuarios[i].Dni.toLowerCase()
            nombre=usuarios[i].nombre.toLowerCase()
            apellido=usuarios[i].apellido.toLowerCase()

            nom_apel=nombre+" "+apellido

            if(dni.includes(busqueda) || nombre.includes(busqueda) || apellido.includes(busqueda) || nom_apel.includes(busqueda)){
                usuarios_usar[cont]=usuarios[i]
                cont++
            } 
        }

        rellenarTabla(usuarios_usar)
          
        //console.log(usuarios_usar)
        if (usuarios_usar.length == 0 || busqueda == "") {
            usuarios_usar=usuarios;
            
           //console.log(usuarios_usar)
        } 

        if (busqueda == "") {
            input_busqueda.value=""
        }
    }


    function change_checkbox_usu(dis) {
        
       var checkbox_id = dis.value
       
       if (dis.checked) {

        insertar_familiar_lista(checkbox_id)

            //console.log(checkbox_id);
            for (let i = 0; i < usuarios_datos.length; i++) {
                if (usuarios_datos[i][0] == checkbox_id) {
                    var arr_dat=[]
                    arr_dat[0]=checkbox_id
                    arr_dat[1]="tru"

                    usuarios_datos[i]=arr_dat
                }
                
                
            }
        }else{

            retirar_familiar_lista(checkbox_id)

            //console.log("banhamer");
            for (let i = 0; i < usuarios_datos.length; i++) {
                if (usuarios_datos[i][0] == checkbox_id) {
                    var arr_dat=[]
                    arr_dat[0]=checkbox_id
                    arr_dat[1]="nil"

                    usuarios_datos[i]=arr_dat
                }
                
                
            }
        }

       
   }

   
</script>

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ;?>