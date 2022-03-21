<?php require_once RUTA_APP.'/vistas/inc/header.php';
 ?>
 <div class="row justify-content-center my-4 "> 
    <div class="col-2 ">
        <select name="num_registros_change" id="num_registros_change" class="form-select" oninput="change_epp(this)">
            <option value="5">5 registros</option>
            <option value="10" selected>10 registros</option>
            <option value="25">25 registros</option>
            <option value="50">50 registros</option>
            <option value="100">100 registros</option>

        </select>
    </div>   
</div>
<div class="table-responsive">
<table class="table" id="tabla_usuarios">
    <tr class="tablaUsu">

        <td>Nombre</td>
        <td>Apellidos</td>
        <td>Rol</td>
        <td>Accion</td>

</tr>
    <tbody id='tbodyTablaUsuarios'>

    </tbody>
</table>


<div class="text-center">
    <a onclick="action_decider(this)" id="gotofirst" class="btn btn-outline-secondary"><<</a>
    
    <a  onclick="action_decider(this)" id="num_prev" class="btn btn-outline-secondary">1</a>
    <a   id="num_this" class="btn btn-outline-success">2</a>
    <a  onclick="action_decider(this)" id="num_next" class="btn btn-outline-secondary">3</a>
    
    <a  onclick="action_decider(this)" id="gotolast" class="btn btn-outline-secondary">>></a>
</div>
<br>

</div>





<?php if (tienePrivilegios($datos['usuarioSesion']->rol,[0])):?>
    <div class="col text-center pb-3">
        <button type="button" class="btn btn-outline-success btn-lg" data-bs-toggle="modal" data-bs-target="#Modal_Agregar">
        <i class="bi bi-person-plus-fill"></i>
        </button>
    </div>

<?php endif ?>

<!-- Modal editar -->  
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="ModalTitler" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
        <div class="modal-header">
            <h5 class="modal-title" id="ModalTitler">Editar Usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="contenidoModalUsuario">

            <form method="post" class="card-body" id="form-editar" >
                
                    <input  type="hidden" name="id_user" id="id_user" class="form-control form-control-lg">
                    <input  type="hidden" name="rol" id="rol" class="form-control form-control-lg" hidden>

                <div class="mt-3 mb-2">
                    <label for="nombre">Nombre: <sup>*</sup></label>
                    <input type="text" name="nombre" id="nombre" class="form-control form-control-lg">
                </div>
                <div class="mb-2">
                    <label for="apellido">Apellido: <sup>*</sup></label>
                    <input type="text" name="apellido" id="apellido" class="form-control form-control-lg">
                </div>
                <div class="mb-2">
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="email" name="email" id="email" class="form-control form-control-lg">
                </div>
                <div class="mb-2">
                    <label for="dni">DNI/NIE/CIF: <sup>*</sup></label>
                    <input type="text" name="dni" id="dni" class="form-control form-control-lg">
                </div>
                <div class="mb-2">
                    <label for="dni">Cuenta Corriente: <sup>*</sup></label>
                    <input type="text" name="cc" id="cc" class="form-control form-control-lg">
                </div>
                <div class="mb-2">
                    <label for="fecha_nac">Fecha Nacimiento: <sup>*</sup></label>
                    <input type="date" name="fecha_nac" id="fecha_nac" class="form-control form-control-lg">
                </div>
                <div class="mb-2">
                    <label for="telefono">Telefono: <sup>*</sup></label>
                    <input type="text" name="telefono" id="telefono" class="form-control form-control-lg">
                </div>
                <div hidden>
                    <label for="sueldo">Sueldo: <sup>*</sup></label>
                    <input type="text" name="sueldo" id="sueldo" class="form-control form-control-lg">
                </div>
                
            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success" onclick="editar_usuario()" data-bs-dismiss="modal">Editar </button>
        </div>
        </div>
    </div>
</div>


                        
<!-- modal agraga -->
<div class="modal fade" id="Modal_Agregar" tabindex="-1" aria-labelledby="ModalTitler1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
        <div class="modal-header">
            <h5 class="modal-title" id="ModalTitler1">Agregar Entrenador/Tienda</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="contenidoModalUsuario">

            <form method="post" class="card-body" name="form_agraga" id="form_agraga" onsubmit="return false">
                <div class="mb-2">
                    <label for="rol_Agregar">Rol: <sup>*</sup></label>
                    <select name="rol_Agregar" id="rol_Agregar" class="form-control form-control-lg is-invalid" onchange="mostrar_modal();//comprobar_select(this)">
                        <option value="nil" disabled selected>selecione una opcion</option>
                        <option value="5">entrenador</option>
                        <option value="200">tienda</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="nombre_Agregar">Nombre: <sup>*</sup></label>
                    <input type="text" name="nombre_Agregar" id="nombre_Agregar" class="form-control form-control-lg" onkeyup="//comprobar_nombres(this)">
                </div>
                <div class="mb-2">
                    <label for="apellidos_Agregar">Apellidos: <sup>*</sup></label>
                    <input type="text" name="apellido_Agregar" id="apellido_Agregar" class="form-control form-control-lg" onkeyup="//comprobar_nombres(this)"  >
                </div>
                <div class="mb-2">
                    <label for="dni_Agregar">DNI/NIE/CIF: <sup>*</sup></label>
                    <input type="text" name="dni_Agregar" id="dni_Agregar" class="form-control form-control-lg" onkeyup="//comprobar_dni(this)" >
                </div>
                <div class="mb-2">
                    <label for="email_Agregar">Email: <sup>*</sup></label>
                    <input type="email" name="email_Agregar" id="email_Agregar" class="form-control form-control-lg" onkeyup="//comprobar_correo(this)">
                </div>
                
                <div class="mb-2">
                    <label for="telefono_Agregar">telefono: <sup>*</sup></label>
                    <input type="text" name="telefono_Agregar" id="telefono_Agregar" class="form-control form-control-lg" onkeyup="//comprobar_telefono(this)">
                </div>
                <div class="mb-2">
                    <label for="fnac_Agregar">fecha nacimiento: <sup>*</sup></label>
                    <input type="date" name="fnac_Agregar" id="fnac_Agregar" class="form-control form-control-lg is-invalid" onkeyup="//comprobar_fecha(this)" >
                </div>
                <div class="mb-2">
                    <label for="cc_Agregar">CC: <sup>*</sup></label>
                    <input type="text" name="cc_Agregar" id="cc_Agregar" class="form-control form-control-lg" onkeyup="//validarIBAN(this)">
                </div>
                <div hidden>
                    <label for="sueldo_Agregar">Sueldo: <sup>*</sup></label>
                    <input type="text" name="sueldo_Agregar" id="sueldo_Agregar" class="form-control form-control-lg">
                </div>

            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" id="btn_agraga" class="btn btn-success" form="form_agraga" onclick="return comprobar_formulario()">Agraga</button>
        </div>
        </div>
    </div>
</div>


<!-- modal borrascosas -->
<div class="modal fade" id="Modal_Borrar" tabindex="-1" aria-labelledby="ModalTitler2" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
        <div class="modal-header">
            <h5 class="modal-title" id="ModalTitler2">Baja de Usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="contenidoModalUsuario">

            <form method="post" class="card-body" action="/borrar.php">

                <input type="hidden" name="id_user_Borrar" id="id_user_Borrar" class="form-control form-control-lg">
                <input type="hidden" name="rol_Borrar" id="rol_Borrar" class="form-control form-control-lg">

                <div class="mt-3 mb-2">
                    <label for="nombre_Borrar">Nombre: <sup>*</sup></label>
                    <input type="text" name="nombre_Borrar" id="nombre_Borrar" class="form-control form-control-lg" readonly>
                </div>
                <div class="mb-2">
                    <label for="apellido_Borrar">Apellido: <sup>*</sup></label>
                    <input type="text" name="apellido_Borrar" id="apellido_Borrar" class="form-control form-control-lg" readonly>
                </div>
                <div class="mb-2">
                    <label for="email_Borrar">Email: <sup>*</sup></label>
                    <input type="email" name="email_Borrar" id="email_Borrar" class="form-control form-control-lg" readonly>
                </div>
                <div class="mb-2">
                    <label for="dni_Borrar">DNI/NIE/CIF: <sup>*</sup></label>
                    <input type="text" name="dni_Borrar" id="dni_Borrar" class="form-control form-control-lg" readonly>
                </div>
                <div class="mb-2">
                    <label for="cc_Borrar">Cuenta Corriente: <sup>*</sup></label>
                    <input type="text" name="cc_Borrar" id="cc_Borrar" class="form-control form-control-lg" readonly>
                </div>
                <div class="mb-2">
                    <label for="fecha_nac_Borrar">Fecha Nacimiento: <sup>*</sup></label>
                    <input type="date" name="fecha_nac_Borrar" id="fecha_nac_Borrar" class="form-control form-control-lg" readonly>
                </div>
                <div class="mb-2">
                    <label for="telefono_Borrar">Telefono: <sup>*</sup></label>
                    <input type="text" name="telefono_Borrar" id="telefono_Borrar" class="form-control form-control-lg" readonly>
                </div>
                <div hidden>
                    <label for="sueldo_Borrar">Sueldo: <sup>*</sup></label>
                    <input type="text" name="sueldo" id="sueldo_Borrar" class="form-control form-control-lg" readonly>
                </div>
            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" id="boton-cambiante" class="btn btn-danger" data-bs-dismiss="modal" onclick="baja_usuario()" >Dar de baja</button>
        </div>
        </div>
    </div>
</div>


<div class="modal fade" id="Modal_Pass" tabindex="-1" aria-labelledby="ModalTitler3" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
        <div class="modal-header">
            <h5 class="modal-title" id="ModalTitler3">Cambiar Contraseña</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="contenidoModalUsuario">

            <form method="post" class="card-body">

                <input  type="hidden" name="id_user_Pass" id="id_user_Pass" class="form-control form-control-lg">
                <div class="mb-2">
                    <label for="email_Pass">Email: <sup>*</sup></label>
                    <input type="email" name="email_Pass" id="email_Pass" class="form-control form-control-lg" readonly>
                </div>
                <div class="mb-2">
                    <label for="pass_Pass">Nueva Contraseña: <sup>*</sup></label>
                    <input type="password" name="pass_Pass" id="pass_Pass" class="form-control form-control-lg">
                </div>
                <div class="mb-2">
                    <label for="confirmar_Pass">Confirmar Contraseña: <sup>*</sup></label>
                    <input type="password" name="confirmar_Pass" id="confirmar_Pass" class="form-control form-control-lg">
                </div>

            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal" onclick="cambiar_pass()">Cambiar Contraseña</button>
        </div>
        </div>
    </div>
</div>









<script>

    function cambiar_modal(tipo){
        if (tipo=="borrar") {
            document.getElementById("ModalTitler2").innerHTML = "Baja de Usuario";
            document.getElementById("boton-cambiante").removeAttribute("hidden");
        }else if (tipo=="ver"){
            document.getElementById("ModalTitler2").innerHTML = "Datos Personales";
            document.getElementById("boton-cambiante").setAttribute("hidden", true);
        }
    }


    async function usuarioActual($id,$act){// crea un fetch, recibe los datos procesados(en la pagina llamada por fetch) y luego cambia los datos del modal
        var modtitle

        var term="";
        if ($act==1) {
            term="_Borrar"
        }
        var enlace="<?php echo RUTA_URL?>/usuarios/obtener_usu_actual/"+$id;
        var nomP="users";

            await fetch(enlace)
            .then(response => response.json())
            .then(data => nomP = data)
            .catch( err => console.error(err));

        //console.log(nomP);
        
        //obtenemos los elementos cuyo valor vamos a cambiar  sd
        var modCont_id_user= document.getElementById("id_user"+term)
        var modCont_rol= document.getElementById("rol"+term)
        var modCont_nombre= document.getElementById("nombre"+term)
        var modCont_apellido= document.getElementById("apellido"+term)
        var modCont_email= document.getElementById("email"+term)
        var modCont_dni= document.getElementById("dni"+term)
        var modCont_CC= document.getElementById("cc"+term)      
        var modCont_fnac= document.getElementById("fecha_nac"+term)
        var modCont_telef= document.getElementById("telefono"+term)
        var modCont_sueldo= document.getElementById("sueldo"+term);
        
        //console.log(modCont_sueldo);
        //--------------------------------------cambiamos los datos de los elementos
        datos_usu=nomP.datos_usu;
        modCont_nombre.value = datos_usu.nombre;
        modCont_rol.value = datos_usu.rol;
        modCont_apellido.value = datos_usu.apellido;
        modCont_email.value = datos_usu.email;
        modCont_dni.value = datos_usu.Dni;
        modCont_CC.value = datos_usu.CC;
        modCont_id_user.value = $id;
        modCont_fnac.value=datos_usu.fecha_nac;
        modCont_telef.value=datos_usu.telefono;     
        

        //console.log(modCont_rol.value)
        //console.log("llegamos")
        

        if(modCont_rol.value == 5){
            //console.log("ent")
            modCont_sueldo.value=datos_usu.sueldo;
            document.getElementById("sueldo"+term).parentElement.removeAttribute("hidden")
            modCont_apellido.parentElement.removeAttribute("hidden")
            modCont_fnac.parentElement.removeAttribute("hidden")
        } 
        if (modCont_rol.value != 5) {
            //console.log("succ")
            modCont_sueldo.value=null;
            document.getElementById("sueldo"+term).parentElement.setAttribute("hidden",true)
            modCont_apellido.parentElement.removeAttribute("hidden")
            modCont_fnac.parentElement.removeAttribute("hidden")
        } 
        if(modCont_rol.value==200){
           // console.log("store")
            modCont_sueldo.value="nil";
            modCont_apellido.parentElement.setAttribute("hidden",true)
            modCont_fnac.parentElement.setAttribute("hidden",true)
        }
        
       
        
    }
    
    function mostrar_modal(){
        rol = document.getElementById("rol_Agregar").value
        //console.log(rol);
        
        if(rol==5){
            document.getElementById("sueldo_Agregar").parentElement.removeAttribute("hidden")
            document.getElementById("apellido_Agregar").parentElement.removeAttribute("hidden")
            document.getElementById("fnac_Agregar").parentElement.removeAttribute("hidden")
        }
        if(rol==200){
            document.getElementById("sueldo_Agregar").parentElement.setAttribute("hidden",true)
            document.getElementById("apellido_Agregar").parentElement.setAttribute("hidden",true)
            document.getElementById("fnac_Agregar").parentElement.setAttribute("hidden",true)
        }
    }


    function getSesiones(id_usuario){
        fetch('<?php echo RUTA_URL?>/usuarios/sesiones/'+id_user, {
            headers: {
                "Content-Type": "application/json"
            },
            credentials: 'include'
        })
            .then((resp) => resp.json())
            .then(function(data) {
                let sesiones = data.sesiones
                let usuario = data.usuario

                document.getElementById("tbodyTablaSesiones").innerHTML = ""
                document.getElementById("usuarioSesion").innerHTML = usuario.nombre

                document.getElementById("listadoSesiones").style.display="block";

                for (i = 0; i < sesiones.length; i++){
                    let fechaInicio = new Date(sesiones[i].fecha_inicio)
                    let fechaFin = new Date(sesiones[i].fecha_fin)
                    let fechaFinOut = "-"
                    let estado
                    if (sesiones[i].fecha_fin) {
                        fechaFinOut = fechaFin.toLocaleString()
                        estado = "cerrada"
                    } else {
                        estado = '<div class="col text-center"> \
                                    <a class="btn btn-success" href="javascript:cerrarSesion(\''+id_user+'\',\''+sesiones[i].id_sesion+'\')"> \
                                        Cerrar \
                                    </a> \
                                </div>' 
                    }
                    
                    document.getElementById("tbodyTablaSesiones").insertRow(-1).innerHTML = 
                                '<td>' + sesiones[i].id_sesion + '</td>' + 
                                '<td>' + sesiones[i].id_user + '</td>' + 
                                '<td>' + fechaInicio.toLocaleString() + '</td>' + 
                                '<td>' + fechaFinOut + '</td>' +
                                '<td>' + estado + '</td>'
                }
            })
    }


    async function cerrarSesion(id_usuario,id_sesion){
        const data = new FormData();
        data.append('id_sesion', id_sesion);
        
        await fetch('/usuarios/cerrarSesion/', {
            method: "POST",
            body: data,
        })
            .then((resp) => resp.json())
            .then(function(data) {
    
                if (Boolean(data)){
                    getSesiones(id_user)
                } else {
                    alert('Error al Cerrar la sesión')
                }
                
            })
    }

    async function cambiar_pass(){
        let id_user= document.getElementById("id_user_Pass").value
        let pass = document.getElementById("pass_Pass").value
        let confirm = document.getElementById("confirmar_Pass").value

        if (pass == confirm){
            const data = new FormData()
            data.append("id_user", id_user)
            data.append("pass",pass)
            
            await fetch('/usuarios/cambiar_pass/', {
            method: "POST",
            body: data,
            })
            .then((resp) => resp.json())
            .then(function(data) {
                alert("Contraseña cambiada con exito")
            })
            .catch( err => {
               // alert("Error al actualizar el usuario")
                console.error(err)
            
            });
        }else{
            alert("las contraseñas no coinciden, asegurese de poner la misma")
        }


        document.getElementById("pass_Pass").value = ""
        document.getElementById("confirmar_Pass").value = ""

        
    }

    async function editar_usuario(){

        let nombre=document.getElementById("nombre").value
        let id_user=document.getElementById("id_user").value
        let apel=document.getElementById("apellido").value
        let email=document.getElementById("email").value
        let dni=document.getElementById("dni").value
        let cc=document.getElementById("cc").value
        var rol= document.getElementById("rol").value
        let fnac=document.getElementById("fecha_nac").value
        let telef=document.getElementById("telefono").value
        let sueldo=document.getElementById("sueldo").value 
    
        const data = new FormData()
        data.append("id_user", id_user)
        data.append("nombre", nombre)
        data.append("apellido", apel)
        data.append("Dni", dni)
        data.append("email", email)
        data.append("rol", rol)
        data.append("CC", cc)
        data.append("fecha_nac", fnac)
        data.append("telefono", telef)
        data.append("sueldo", sueldo)
        
        await fetch('<?php echo RUTA_URL?>/usuarios/editar_usuario/', {
            method: "POST",
            body: data,
        })
            .then((resp) => resp.text())
            .then(function(data) {
                //console.log(data)
                //ffs: document.getElementById("tbodyTablaUsuarios").innerHTML = ""
                //ffs: rellenarTabla(data)
                get_paige(p_actual)
            })
            .catch( err => {
               // alert("Error al actualizar el usuario")
                console.error(err)
            
            });
    } 
    
    async function cambiarPass(id_user, email){
        document.getElementById("id_user_Pass").value = id_user
        document.getElementById("email_Pass").value = email
        

    }
    
    async function agregar_usuario(){       

        const data_env = new FormData(document.getElementById("form_agraga"))
        

            //console.log("llegamos")

            await fetch('/usuarios/agregar_usuario/',{
                method: "POST",
                body:data_env,

            })
            .then(response => response.text())
            .then(async function(data) {
                //ffs: document.getElementById("tbodyTablaUsuarios").innerHTML = ""
                //ffs: rellenarTabla(data) 
                     await get_pmax()  
                     await get_paige(pmax)       
            })
            .catch( err => {   
                console.error(err)
                
                alert("Error al actualizar el usuario")

            });
            


}

    
    async function baja_usuario(){
        
        let id_user= document.getElementById("id_user_Borrar").value;
        let email= document.getElementById("email_Borrar").value;


        //alert("¿Esta seguro de que quiere eliminar al usuario con el correo: "+email+"?")

        const data = new FormData()
        
        data.append("id", id_user)

        await fetch('<?php echo RUTA_URL?>/usuarios/baja_usuario/',{
                method: "POST",
                body:data,

            })
            .then(response => response.json())
            .then(async function(data) {
                //console.log(data)
                //ffs: document.getElementById("tbodyTablaUsuarios").innerHTML = ""
                //ffs: rellenarTabla(data)
               await get_pmax()
               
            if (p_actual > pmax) {
                p_actual=pmax
            }
             
            await get_paige(p_actual)
                
            })
            .catch( err => { 
                console.error(err)
                alert("Error al actualizar el usuario")
            });

            
        
    }


    // hace una llamada para obtener los usuarios activos y rellena la tabla con los datos de los usuarios
    async function rellenarTabla(usuarios){

        tbody = document.getElementById("tbodyTablaUsuarios")
        /*ffs:
        await fetch('/usuarios/get_active_users/')
            .then(response => response.json())
            .then(function(data) {
                document.getElementById("tbodyTablaUsuarios").innerHTML = ""
                usuarios=data               
            })
            .catch( err => {   
                console.error(err)
                
                alert("Error al actualizar el usuario")

            });*/

        for (let i = 0; i < usuarios.length; i++) {
            tr = document.createElement("tr")

            // td_id_user=document.createElement("td") //creamos td
            // td_id_user.appendChild(document.createTextNode(usuarios[i].id_user)) //rellenamos el td con el id del usuario

            td_nombre=document.createElement("td")
            td_nombre.appendChild(document.createTextNode(usuarios[i].nombre))

            td_apellido=document.createElement("td")
            if (usuarios[i].apellido == null) {
                usuarios[i].apellido="---"
            }
            td_apellido.appendChild(document.createTextNode(usuarios[i].apellido))


            // td_email=document.createElement("td")
            // td_email.appendChild(document.createTextNode(usuarios[i].email))

            // td_Dni=document.createElement("td")
            // td_Dni.appendChild(document.createTextNode(usuarios[i].Dni))

            // td_CC=document.createElement("td")
            // td_CC.appendChild(document.createTextNode(usuarios[i].CC))

            // td_fecha_nac=document.createElement("td")
            // if (usuarios[i].fecha_nac == null) {
            //     usuarios[i].fecha_nac="---"
            // }
            // td_fecha_nac.appendChild(document.createTextNode(usuarios[i].fecha_nac))

            // td_telefono=document.createElement("td")
            // td_telefono.appendChild(document.createTextNode(usuarios[i].telefono))

            
            td_rol=document.createElement("td")
            var rol_pero_entendible=""
            switch (usuarios[i].rol) {
                    case 0:
                        td_rol.classList.add("text-primary");
                        rol_pero_entendible="Administrador";
                        break;

                    case 5:
                        td_rol.classList.add("text-danger");
                        rol_pero_entendible="Entrenador";
                        break;

                    case 10:
                        rol_pero_entendible="Socio";
                        break;

                    case 200:
                        td_rol.classList.add("text-success");
                        rol_pero_entendible="Tienda";
                        break;
                }
            td_rol.appendChild(document.createTextNode(rol_pero_entendible))

            
            td_acciones=document.createElement("td")
            if (usuarios[i].rol == 0) {
                
                td_acciones.innerHTML ="<div><button type=\"button\" class=\"btn btn-outline-secondary btn-block\" data-bs-toggle=\"modal\" data-bs-target=\"#Modal_Pass\" onclick=\"cambiarPass("+usuarios[i].id_user+",'"+usuarios[i].email+"')\"><i class=\"bi bi-shield-lock-fill\"></i></button></div>";
                   
            } else if (usuarios[i].rol == 10) {
                td_acciones.innerHTML += "<div><button type=\"button\" class=\"btn me-2 btn-outline-primary btn-block\" data-bs-toggle=\"modal\" data-bs-target=\"#Modal_Borrar\" onclick=\"cambiar_modal('ver');usuarioActual("+usuarios[i].id_user+",1)\"><i class=\"bi bi-eye\"></i></button><button type=\"button\" class=\"btn me-2 btn-block editUruario\"  data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\" onclick=\"usuarioActual( "+usuarios[i].id_user+",0)\"><i class=\"bi bi-pencil-square\"></i></button><button type=\"button\" class=\"btn me-2 btn-outline-danger btn-block\" data-bs-toggle=\"modal\" data-bs-target=\"#Modal_Borrar\" onclick=\"cambiar_modal('borrar');usuarioActual( "+usuarios[i].id_user+",1)\"><i class=\"bi bi-person-x-fill\"></i></button><button type=\"button\" class=\"btn me-2 btn-outline-secondary btn-block\" data-bs-toggle=\"modal\" data-bs-target=\"#Modal_Pass\" onclick=\"cambiarPass("+usuarios[i].id_user+",'"+usuarios[i].email+"')\"><i class=\"bi bi-shield-lock-fill\"></i></button><form class=\"d-inline-block\" method=\"post\" action=\"usuarios/gestionar_familia\"><input type=\"hidden\" name=\"id_socio\" value="+usuarios[i].id_user+"><button type=\"submit\" class=\"btn me-2 btn-outline-primary btn-block\">Familia</button></form></div>";
            }else{
                td_acciones.innerHTML ="<div><button type=\"button\" class=\"btn me-2 btn-outline-primary btn-block\" data-bs-toggle=\"modal\" data-bs-target=\"#Modal_Borrar\" onclick=\"cambiar_modal('ver');usuarioActual("+usuarios[i].id_user+",1)\"><i class=\"bi bi-eye\"></i></button><button type=\"button\" class=\"btn me-2 btn-block editUruario\"  data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\" onclick=\"usuarioActual( "+usuarios[i].id_user+",0)\"><i class=\"bi bi-pencil-square\"></i></button><button type=\"button\" class=\"btn me-2 btn-outline-danger btn-block\" data-bs-toggle=\"modal\" data-bs-target=\"#Modal_Borrar\" onclick=\"cambiar_modal('borrar');usuarioActual( "+usuarios[i].id_user+",1)\"><i class=\"bi bi-person-x-fill\"></i></button><button type=\"button\" class=\"btn me-2 btn-outline-secondary btn-block\" data-bs-toggle=\"modal\" data-bs-target=\"#Modal_Pass\" onclick=\"cambiarPass("+usuarios[i].id_user+",'"+usuarios[i].email+"')\"><i class=\"bi bi-shield-lock-fill\"></i></button></div>";
            }

            

            //tr.appendChild(td_id_user)
            tr.appendChild(td_nombre)
            tr.appendChild(td_apellido)
            // tr.appendChild(td_email)
            // tr.appendChild(td_Dni)
            // tr.appendChild(td_CC)
            // tr.appendChild(td_fecha_nac)
            // tr.appendChild(td_telefono)
            tr.appendChild(td_rol)
            tr.appendChild(td_acciones)
            
            
            tbody.appendChild(tr)

        }


    }
    //ffs: rellenarTabla()


    async function comprobar_formulario() {

        //IMPORTANTE CAMBIAR LUEGO

        //var valid_nombre= comprobar_nombres(document.getElementById("nombre_Agregar"));
        //var valid_apel= comprobar_nombres(document.getElementById("apellido_Agregar"));
        //var valid_email= comprobar_correo(document.getElementById("email_Agregar"));
        //var valid_dni= comprobar_dni(document.getElementById("dni_Agregar"));
        //var valid_cc= validarIBAN(document.getElementById("cc_Agregar")) ;
        //var valid_fnac= comprobar_fecha(document.getElementById("fnac_Agregar"));
        //var valid_telef= comprobar_telefono(document.getElementById("telefono_Agregar"));
        //var valid_rol= comprobar_select(document.getElementById("rol_Agregar"));

        //var is_all_valid=false;
        var is_all_valid=true;

        //if (valid_rol && valid_telef && valid_fnac && valid_cc && valid_dni && valid_email && valid_apel && valid_nombre) {
        //    is_all_valid=true
        //}

        if (is_all_valid) {
            await agregar_usuario()

            var modal = bootstrap.Modal.getInstance(document.getElementById("Modal_Agregar"))
            modal.hide();
            //close_modal_manually(elementor)
            
            
        }
        return is_all_valid
    }

    
    //////////////////////////////////////////////////////////////////////////PARTE-PAGINACION/////////////////////////////////////////////////////////////





    var element_per_paige=5//ffs: or any other number  //ffs: futuras versiones poder cambiar el num elementos
    var p_actual //ffs: comprobaciones / reload pag btns
    var pmax //ffs: se establece al cargar pagina, ya nos ocuparemos de eso luego
    var p_next //ffs: num nxt
    var p_prev //ffs: num prev
    var p_jump //ffs: mejora para futura version

    //var pmax //ffs: obtenido del aguait

    async function get_pmax() {
        var data_env=new FormData();
        data_env.append("limitt",element_per_paige)
        //console.log("aaa");
        await fetch('<?php echo RUTA_URL?>/usuarios/reloadPaginationBTN/', {
            method: "POST",
            body: data_env,
        })
            .then((resp) => resp.text())
            .then(function(data) {
                //console.log(data)
                pmax=data
                
            })
            .catch( err => {
               
                console.error(err)
            
            });

        if (p_actual > pmax) {
            p_actual=pmax
        }else if (p_actual <= 0){
            p_actual=1
        }

    }
    get_pmax()


async function get_paige(gotop) {
    var first_page=document.getElementById("gotofirst")
   


    var dis_page=document.getElementById("num_this")
    var nxt_page=document.getElementById("num_next")
    var prv_page=document.getElementById("num_prev")


   
    var last_page=document.getElementById("gotolast")
 
    
    p_actual=gotop //ffs: watch this out

    
    if (p_actual <= 1) {
        p_prev="nil" //ffs: controlar esto mejor
        prv_page.innerHTML="nil"


        first_page.setAttribute("hidden",true)
        prv_page.setAttribute("hidden",true)
    }else{
        p_prev=parseInt(p_actual)-1
        prv_page.innerHTML=p_prev

       
        first_page.removeAttribute("hidden")
        prv_page.removeAttribute("hidden")
    }
    
    if (p_actual >= pmax) {
        p_next="nil" //ffs: controlar esto mejor
        nxt_page.innerHTML="nil"


        last_page.setAttribute("hidden",true)
        nxt_page.setAttribute("hidden",true)
    }else{
        p_next=parseInt(p_actual)+1
        nxt_page.innerHTML=p_next

     
        last_page.removeAttribute("hidden")
        nxt_page.removeAttribute("hidden")
    }
    
    dis_page.innerHTML=p_actual

    




    var data_env=new FormData();
    data_env.append("limitt",element_per_paige)
    data_env.append("p_actual",p_actual)

    await fetch('<?php echo RUTA_URL?>/usuarios/obtenerUsuariosPaginacion/', {
        method: "POST",
        body: data_env,
    })
        .then((resp) => resp.json())
        .then(function(data) {
            //console.log(data)
            document.getElementById("tbodyTablaUsuarios").innerHTML = ""
            rellenarTabla(data)
            
        })
        .catch( err => {
            // alert("Error al actualizar el usuario")
            console.error(err)
        
        });
    
}
get_paige(1)

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


async function change_epp(dis) {
        
        //console.log(dis.value);
        element_per_paige=parseInt(dis.value)
        await get_pmax()
        await get_paige(p_actual)
    }

    change_epp(document.getElementById("num_registros_change"))
</script>


<?php require_once RUTA_APP.'/vistas/inc/footer.php' ;?>









