<?php require_once RUTA_APP.'/vistas/inc/header.php'; //print_r($datos);?>
<a href="/usuarios/solicitudes_grupos_eventos" class="btn btn-outline-primary"><< VOLVER</a>
<div id="datos" class="table-responsive" class="row">
    <table class="table" id="tabla">
        <thead>
            <tr>
                <th id="th_soc_ext" hidden>Soc/Ext</th>
                <th id="th_fech_sol" hidden>Fecha Solicitud</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>DNI</th>                    
                <th>Fecha Nacimiento</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id='tbodyTablaUsuarios'>

        </tbody>
    </table>
</div>

<script>
    solicitudes = <?php echo json_encode($datos["solicitudes"]); ?>;
    id_solicitud = <?php echo json_encode($datos["id_solicitud"]); ?>;
    tipo = <?php echo json_encode($datos["tipo"]); ?>;
    
    //console.log(solicitudes);
    //console.log(id_solicitud);
    //console.log(tipo);
    
    function rellenarTabla(){
        tbody = document.getElementById("tbodyTablaUsuarios")

        for (let i = 0; i < solicitudes.length; i++) {
            tr = document.createElement("tr")

            
            td_nombre = document.createElement("td")
            td_apellido = document.createElement("td")
            td_email = document.createElement("td")
            td_dni = document.createElement("td")
            td_fecha_nac = document.createElement("td")
            td_telefono = document.createElement("td")
            td_acciones = document.createElement("td")


            if (tipo=="grupo") {
                document.getElementById("th_soc_ext").setAttribute("hidden", true);
                document.getElementById("th_fech_sol").removeAttribute("hidden")
                td_fech_sol = document.createElement("td")
                td_fech_sol.appendChild(document.createTextNode(solicitudes[i].fecha_sol))

                acciones = "<button type=\"button\" class=\"btn btn-block btn-outline-success me-2\" onclick=\"aceptar_solicitud("+solicitudes[i].id_user+",'grupo','"+solicitudes[i].fecha_sol+"')\">Aceptar</button>"
                acciones += "<button type=\"button\" class=\"btn btn-block btn-outline-danger\" onclick=\"rechazar_solicitud("+solicitudes[i].id_user+",'grupo','"+solicitudes[i].fecha_sol+"')\">Rechazar</button>"

                tr.appendChild(td_fech_sol)
            }else{
                document.getElementById("th_soc_ext").removeAttribute("hidden")
                document.getElementById("th_fech_sol").setAttribute("hidden", true)
                td_soc_ext = document.createElement("td")

                if ("id_user" in solicitudes[i]){
                    td_soc_ext.appendChild(document.createTextNode("Socio"))
                    td_soc_ext.setAttribute("id_user", solicitudes[i].id_user)
                    td_soc_ext.classList.add("text-success","fw-bold")

                    acciones = "<button type=\"button\" class=\"btn btn-block btn-outline-success me-2\" onclick=\"aceptar_solicitud("+solicitudes[i].id_user+",'socio','nada')\">Aceptar</button>"
                    acciones += "<button type=\"button\" class=\"btn btn-block btn-outline-danger\" onclick=\"rechazar_solicitud("+solicitudes[i].id_user+",'socio','nada')\">Rechazar</button>"

                }else{
                    td_soc_ext.appendChild(document.createTextNode("Externo"))
                    td_soc_ext.setAttribute("id_externo", solicitudes[i].id_externo)
                    td_soc_ext.classList.add("text-primary","fw-bold")

                    acciones = "<button type=\"button\" class=\"btn btn-block btn-outline-success me-2\" onclick=\"aceptar_solicitud("+solicitudes[i].id_externo+",'externo','nada')\">Aceptar</button>"
                    acciones += "<button type=\"button\" class=\"btn btn-block btn-outline-danger\" onclick=\"rechazar_solicitud("+solicitudes[i].id_externo+",'externo','nada')\">Rechazar</button>"

                }
                tr.appendChild(td_soc_ext)
            }

            td_nombre.appendChild(document.createTextNode(solicitudes[i].nombre))
            td_apellido.appendChild(document.createTextNode(solicitudes[i].apellido))
            td_email.appendChild(document.createTextNode(solicitudes[i].email))
            td_dni.appendChild(document.createTextNode(solicitudes[i].Dni))
            td_fecha_nac.appendChild(document.createTextNode(solicitudes[i].fecha_nac))
            td_telefono.appendChild(document.createTextNode(solicitudes[i].telefono))

            
            td_acciones.innerHTML = acciones
            

            
            tr.appendChild(td_nombre)
            tr.appendChild(td_apellido)
            tr.appendChild(td_email)
            tr.appendChild(td_dni)
            tr.appendChild(td_fecha_nac)
            tr.appendChild(td_telefono)
            tr.appendChild(td_acciones)

            tbody.appendChild(tr)   
        }
    }

    async function aceptar_solicitud(id_participante, tipo, fecha){
        
        data = new FormData();
        data.append('id_participante',id_participante);
        data.append('id_solicitud',id_solicitud);
        
        
        switch (tipo) {
            case "grupo":
                    data.append('fecha_sol',fecha);

                    await fetch('/usuarios/aceptar_solicitud_grupo/',  {
                    method: "POST",
                    body: data,
                    })
                    .then(response => response.json())
                    .then(function(data) {
                        //console.log(data)
                        solicitudes = data
                        tbody.innerHTML = "";
                        rellenarTabla()
                    })
                    .catch( err => {   
                        console.error(err)
                        alert("Error al aceptar la peticion")
                    });
                break;
        
            case "socio":
                    await fetch('/usuarios/aceptar_solicitud_evento_socio/',  {
                    method: "POST",
                    body: data,
                    })
                    .then(response => response.json())
                    .then(function(data) {
                        solicitudes = data
                        tbody.innerHTML = "";
                        rellenarTabla()
                    })
                    .catch( err => {   
                        console.error(err)
                        alert("Error al aceptar la peticion")
                    });
                break;

            case "externo":
                    await fetch('/usuarios/aceptar_solicitud_evento_externo/',  {
                    method: "POST",
                    body: data,
                    })
                    .then(response => response.json())
                    .then(function(data) {
                        solicitudes = data
                        tbody.innerHTML = "";
                        rellenarTabla()
                    })
                    .catch( err => {   
                        console.error(err)
                        alert("Error al aceptar la peticion")
                    });
                break;
        }
        
    }

    async function rechazar_solicitud(id_participante, tipo, fecha){
        
        data = new FormData();
        data.append('id_participante',id_participante);
        data.append('id_solicitud',id_solicitud);

        switch (tipo) {
            case "grupo":
                data.append('fecha_sol',fecha);

                await fetch('/usuarios/rechazar_solicitud_grupo/',  {
                method: "POST",
                body: data,
                })
                .then(response => response.json())
                .then(function(data) {
                    //console.log(data)
                    solicitudes = data
                    tbody.innerHTML = "";
                    rellenarTabla()
                })
                .catch( err => {   
                    console.error(err)
                    alert("Error al rechazar la peticion")
                });
                break;
        
            case "socio":
                await fetch('/usuarios/rechazar_solicitud_evento_socio/',  {
                method: "POST",
                body: data,
                })
                .then(response => response.json())
                .then(function(data) {
                    solicitudes = data
                    tbody.innerHTML = "";
                    rellenarTabla()
                })
                .catch( err => {   
                    console.error(err)
                    alert("Error al rechazar la peticion")
                });
                break;

            case "externo":
                await fetch('/usuarios/rechazar_solicitud_evento_externo/',  {
                method: "POST",
                body: data,
                })
                .then(response => response.json())
                .then(function(data) {
                    //console.log(data)
                    solicitudes = data
                    tbody.innerHTML = "";
                    rellenarTabla()
                })
                .catch( err => {   
                    console.error(err)
                    alert("Error al rechazar la peticion")
                });
                break;
        }
    }

    rellenarTabla();
</script>
<?php require_once RUTA_APP.'/vistas/inc/footer.php' ;?>
