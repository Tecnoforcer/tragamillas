<?php require_once RUTA_APP.'/vistas/inc/header.php';
 ?>
 <div class="table-responsive">
 <table class="table" id="tabla_solicitudes">
    <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Fecha Nacimiento</th>                    
                    <th>Cuenta Corriente</th>
                    <th>Acciones</th>                   
                </tr>
    </thead>
    <tbody id='tbodyTablaSolicitudes'>

    

    </tbody>
</table>

 </div>








<script>
    async function rellenarTablaSolicitudes(solicitudes){




        let salida = "";

        for (let i = 0; i < solicitudes.length; i++) {
            salida +=`<tr>
                            <td>${solicitudes[i]['nombre']}</td>
                            <td>${solicitudes[i]['apellido']}</td>
                            <td>${solicitudes[i]['Dni']}</td>
                            <td>${solicitudes[i]['email']}</td>
                            <td>${solicitudes[i]['telefono']}</td>
                            <td>${solicitudes[i]['fecha_nac']}</td>
                            <td>${solicitudes[i]['CC']}</td>
                            <td>
                                <input type="button" class="btn btn-outline-success btn-block" name="action" value="Aceptar" onclick="controlar_solicitud(${solicitudes[i]['id_solicitud_soc']},'Aceptar')">
                                &nbsp;
                                <input type="button" class="btn btn-outline-danger btn-block" name="action" value="Denegar" onclick="controlar_solicitud(${solicitudes[i]['id_solicitud_soc']},'Denegar')">
                            </td> 
                        </tr>`
        }

        document.getElementById("tbodyTablaSolicitudes").innerHTML = salida
    }


    async function controlar_solicitud(id_solicitud_soc, action){
        const data = new FormData()
        data.append("id_solicitud_soc", id_solicitud_soc)
        data.append("action", action)



        await fetch('<?php echo RUTA_URL?>/usuarios/solicitudes_socio/', {
            method: "POST",
            body: data,
        })
            .then((resp) => resp.json())
            .then(function(data) {
                //console.log(data)
                document.getElementById("tbodyTablaSolicitudes").innerHTML = ""
                rellenarTablaSolicitudes(data)
                
            })
            .catch( err => {
               // alert("Error al actualizar el usuario")
                console.error(err)
            
            });
    }



    let solicitudes = <?php echo json_encode($datos['solicitudes']) ?>

    window.onload = rellenarTablaSolicitudes(solicitudes)
</script>


<?php require_once RUTA_APP.'/vistas/inc/footer.php' ;?>