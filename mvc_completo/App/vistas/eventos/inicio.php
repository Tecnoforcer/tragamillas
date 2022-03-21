<?php require_once RUTA_APP.'/vistas/inc/header.php';?>

    <section class="row">
        <h1 class="text-center mt-2">ADMINISTRAR EVENTOS</h1>

        <div class="d-flex justify-content-evenly mt-2">
            <div>
                <label for="carrera">Carrera</label>
                <input type="radio" id="carrera" name="ev_curs" value="carrera" onchange="rellenar_datos()" checked>
            </div>
            <div>
                <label for="curso">Curso</label>
                <input type="radio" id="curso" name="ev_curs" value="curso" onchange="rellenar_datos()">
            </div>
        </div>        
    </section>

    <main id="datos" class="row d-flex justify-content-evenly mt-5">


    </main>

    <section class="row pt-5">
        <div class="text-center">
            <button class="col btn btn-outline-success btn-lg mb-3" data-bs-toggle="modal" data-bs-target="#modal" onclick="cambiarModal('add')">
                <i class="bi bi-plus-lg"></i>
            </button>
        </div>
    </section>  


    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="ModalTitler" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">                    
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalTitler">Editar Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="contenidoModalUsuario">

                    <form method="post" class="card-body" id="form-modal" >
                    
                        <input  type="hidden" name="id_evento" id="id_evento" class="form-control form-control-lg">
                        
                        <div class="mt-3 mb-3">
                            <label for="Nombre">Nombre: <sup>*</sup></label>
                            <input type="text" name="Nombre" id="Nombre" class="form-control form-control-lg">
                        </div>

                        <div class="mt-3 mb-3" id="escondido" hidden>
                            <label for="Entrenador">Entrenador: <sup>*</sup></label>
                            <select name="Entrenador" id="Entrenador" class="form-control form-control-lg">
                                <option value="NULL">Seleccione un entrenador</option>
                                <?php 
                                    $entrenadores = $datos["entrenadores"];
                                    for ($i=0; $i < count($entrenadores); $i++) { 
                                        echo "<option value=\"".$entrenadores[$i]->id_user."\">".$entrenadores[$i]->nombre." ".$entrenadores[$i]->apellido."</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="mt-3 mb-3">
                            <label for="Precio">Precio: <sup>*</sup></label>
                            <input type="int" name="Precio" id="Precio" class="form-control form-control-lg">
                        </div>

                        <div class="mt-3 mb-3">
                            <label for="descuento">Descuento: <sup>*</sup></label>
                            <input type="int" name="descuento" id="descuento" class="form-control form-control-lg">
                        </div>

                        <div class="mt-3 mb-3">
                            <label for="fecha_ini">Fecha Inicio: <sup>*</sup></label>
                            <input type="date" name="fecha_ini" id="fecha_ini" class="form-control form-control-lg">
                        </div>

                        <div class="mt-3 mb-3">
                            <label for="fecha_fin">Fecha Fin: <sup>*</sup></label>
                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control form-control-lg">
                        </div>


                        <div class="mt-3 mb-3">
                            <label for="fecha_ini_ins">Fecha Inicio Inscripcion: <sup>*</sup></label>
                            <input type="date" name="fecha_ini_ins" id="fecha_ini_ins" class="form-control form-control-lg">
                        </div>

                        <div class="mt-3 mb-3">
                            <label for="fecha_fin_ins">Fecha Fin Inscripcion: <sup>*</sup></label>
                            <input type="date" name="fecha_fin_ins" id="fecha_fin_ins" class="form-control form-control-lg">
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="actuador" class="btn btn-success" data-bs-dismiss="modal">Editar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let carreras =  [];
        let cursos = [];
        let ultimo = ""

        //obtenemos dos arrays con los cursos y las carreras de BBDD
        async function obtener_eventos(){
            
            await fetch('<?php echo RUTA_URL?>/eventos/obtener_eventos/')
            .then((resp) => resp.json())
            .then(function(data) {
                carreras = data.carreras
                cursos = data.cursos                        
            })
            .catch( err => {
                console.error(err)            
            });
        }

        //esto se puede sustituir ya que ahora si que es autoincrement el id
        async function obtener_ultimo_id(){
            await fetch('<?php echo RUTA_URL?>/eventos/obtener_ultimo_id/')
            .then((resp) => resp.json())
            .then(function(data) {
                ultimo = data.ultimo.id_evento                             
            })
            .catch( err => {
                console.error(err)            
            });
            
        }
        
        obtener_ultimo_id();


        //muestra los datos en la pantalla
        async function rellenar_datos(){
            await obtener_eventos();
            radio = document.getElementById("carrera")
            salida= "";

            

            if (radio.checked==true) {
                document.getElementById("escondido").setAttribute("hidden", "")

                for (let i = 0; i < carreras.length; i++) {   
                    salida += `
                                <div class="border border-primary col-6 col-lg-2 text-center p-2 me-1 my-2">
                                    <div>`+carreras[i]["Nombre"]+`</div>

                                    <div>
                                        <button type="button" class="btn  btn-block editUruario me-1"  data-bs-toggle="modal" data-bs-target="#modal" onclick="eventoActual(`+carreras[i]["id_evento"]+`, 'carrera');cambiarModal('editar')">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-block" data-bs-toggle="modal" data-bs-target="#modal" onclick="eventoActual(`+carreras[i]["id_evento"]+`, 'carrera');cambiarModal('borrar')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </div>
                                
                            `
                }
            }else{
                document.getElementById("escondido").removeAttribute("hidden")
                for (let i = 0; i < cursos.length; i++) {
                    salida += `
                                <div class="border border-primary col-6 col-lg-2 text-center p-2 me-1 my-2">
                                    `+cursos[i]["Nombre"]+`

                                    <div>
                                        <button type="button" class="btn  btn-block editUruario me-1"  data-bs-toggle="modal" data-bs-target="#modal" onclick="eventoActual(`+cursos[i]["id_evento"]+`, 'cursos');cambiarModal('editar')">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-block" data-bs-toggle="modal" data-bs-target="#modal" onclick="eventoActual(`+cursos[i]["id_evento"]+`, 'cursos');cambiarModal('borrar')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </div>
                            `
                }
            }

            document.getElementById("datos").innerHTML = salida
        }


        //mostramos los datos del evento seleccionado
        async function eventoActual(id_evento, tipo){
            if (tipo=="carrera"){
                for (let i = 0; i < carreras.length; i++) {
                    if (carreras[i]["id_evento"]==id_evento) {
                        document.getElementById("id_evento").value = carreras[i]["id_evento"];
                        document.getElementById("Nombre").value = carreras[i]["Nombre"];
                        document.getElementById("Precio").value = carreras[i]["Precio"];
                        document.getElementById("descuento").value = carreras[i]["descuento"];
                        document.getElementById("fecha_ini").value = carreras[i]["fecha_ini"];
                        document.getElementById("fecha_fin").value = carreras[i]["fecha_fin"];
                        document.getElementById("fecha_ini_ins").value = carreras[i]["fecha_ini_ins"];
                        document.getElementById("fecha_fin_ins").value = carreras[i]["fecha_fin_ins"];

                        break;
                    }                    
                }
            }else{
                for (let i = 0; i < cursos.length; i++) {
                    if (cursos[i]["id_evento"]==id_evento) {
                        document.getElementById("id_evento").value = cursos[i]["id_evento"];
                        document.getElementById("Nombre").value = cursos[i]["Nombre"];
                        for (let j = 0; j < document.getElementById("Entrenador").options.length; j++) {
                            if (document.getElementById("Entrenador").options[j].value == cursos[i]["id_entrenador"]){
                                document.getElementById("Entrenador").options[j].selected = 'selected'
                            }
                            
                        }
                        document.getElementById("Precio").value = cursos[i]["Precio"];
                        document.getElementById("descuento").value = cursos[i]["descuento"];
                        document.getElementById("fecha_ini").value = cursos[i]["fecha_ini"];
                        document.getElementById("fecha_fin").value = cursos[i]["fecha_fin"];
                        document.getElementById("fecha_ini_ins").value = cursos[i]["fecha_ini_ins"];
                        document.getElementById("fecha_fin_ins").value = cursos[i]["fecha_fin_ins"];
                        break;
                    }                    
                }
            }
        }


        //cambia el funcionamiento del modal dependiendo del boton pulsado
        async function cambiarModal(accion){
            boton = document.getElementById("actuador")

            //quitamos el eventos anteriores
            boton.removeEventListener("click", editar_evento)
            boton.removeEventListener("click", agregar_evento)
            boton.removeEventListener("click", borrar_evento)

            //hacemos que el modal se pueda modificar
            document.getElementById("id_evento").readOnly = false
            document.getElementById("Nombre").readOnly = false
            document.getElementById("Precio").readOnly = false
            document.getElementById("Entrenador").removeAttribute("disabled")
            document.getElementById("descuento").readOnly = false
            document.getElementById("fecha_ini").readOnly = false
            document.getElementById("fecha_fin").readOnly = false
            document.getElementById("ModalTitler").readOnly = false
            document.getElementById("fecha_ini_ins").readOnly = false
            document.getElementById("fecha_fin_ins").readOnly = false
            

            switch (accion) {
                case 'editar':
                    document.getElementById("ModalTitler").innerHTML = "Editar Evento"
                    boton.innerHTML = "Editar"                   
                    boton.addEventListener("click", editar_evento)
                    break;
                case 'add':
                    document.getElementById("id_evento").value = ""
                    document.getElementById("Nombre").value = ""
                    document.getElementById("Precio").value = ""
                    document.getElementById("Entrenador").options[0].selected = "selected"
                    document.getElementById("descuento").value = "" //vaciamos el modal
                    document.getElementById("fecha_ini").value = ""
                    document.getElementById("fecha_fin").value = ""

                    document.getElementById("fecha_ini_ins").value = ""
                    document.getElementById("fecha_fin_ins").value = ""

                    document.getElementById("ModalTitler").innerHTML = "Nuevo Evento"
                    boton.innerHTML = "Añadir"
                    boton.addEventListener("click", agregar_evento)
                    break;
                case 'borrar':

                    //hacemos que no se puedan cambiar los datos del usuario
                    document.getElementById("id_evento").readOnly = true
                    document.getElementById("Nombre").readOnly = true
                    document.getElementById("Precio").readOnly = true
                    document.getElementById("Entrenador").disabled = "disabled"
                    document.getElementById("descuento").readOnly = true
                    document.getElementById("fecha_ini").readOnly = true
                    document.getElementById("fecha_fin").readOnly = true
                    document.getElementById("ModalTitler").readOnly = true
                    document.getElementById("ModalTitler").innerHTML = "Borrar Evento"
                    boton.innerHTML = "Borrar"
                    boton.addEventListener("click", borrar_evento)
                    break;
            }
            
        }

        
        async function editar_evento(){            
            if(document.getElementById("carrera").checked==true){
                //editamos una carrera
                for (let i = 0; i < carreras.length; i++) {
                    if (carreras[i]["id_evento"]==document.getElementById("id_evento").value) {
                        //actualizamos en cliente
                        carreras[i]["Nombre"] = document.getElementById("Nombre")
                        carreras[i]["Precio"] = document.getElementById("Precio")
                        carreras[i]["Entrenador"] = document.getElementById("Entrenador")
                        carreras[i]["descuento"] = document.getElementById("descuento")
                        carreras[i]["fecha_ini"] = document.getElementById("fecha_ini")
                        carreras[i]["fecha_fin"] = document.getElementById("fecha_fin")
                        carreras[i]["fecha_ini_ins"] = document.getElementById("fecha_ini_ins")
                        carreras[i]["fecha_fin_ins"] = document.getElementById("fecha_fin_ins")
                        

                        //actualizamos en servidor
                        let data = new FormData(document.getElementById("form-modal"));

                        await fetch('/eventos/editar_carrera/', {
                        method: "POST",
                        body: data,
                        })
                        .then((resp) => resp.json())
                        .then(function(data) {
                            rellenar_datos() 
                        })
                        .catch( err => {
                        // alert("Error al actualizar el usuario")
                            console.error(err)
                        });
                    }
                }
            }else{
                //editamos un curso
                for (let i = 0; i < cursos.length; i++) {
                    if (cursos[i]["id_evento"]==document.getElementById("id_evento").value) {
                        //actualizamos en cliente
                        cursos[i]["Nombre"] = document.getElementById("Nombre")
                        cursos[i]["Precio"] = document.getElementById("Precio")
                        cursos[i]["Entrenador"] = document.getElementById("Entrenador")
                        cursos[i]["descuento"] = document.getElementById("descuento")
                        cursos[i]["fecha_ini"] = document.getElementById("fecha_ini")
                        cursos[i]["fecha_fin"] = document.getElementById("fecha_fin")
                        cursos[i]["fecha_ini_ins"] = document.getElementById("fecha_ini_ins")
                        cursos[i]["fecha_fin_ins"] = document.getElementById("fecha_fin_ins")
                        
                        
                        //actualizamos en servidor
                        let data = new FormData(document.getElementById("form-modal"));
                        await fetch('/eventos/editar_curso/', {
                        method: "POST",
                        body: data,
                        })
                        .then((resp) => resp.json())
                        .then(function(data) {
                            rellenar_datos() 
                        })
                        .catch( err => {
                        // alert("Error al actualizar el usuario")
                            console.error(err)
                        });
                    }
                }
            }
        }

        async function agregar_evento(tipo){
            nuevo_evento = []

            nuevo_evento["id_evento"] = (ultimo+1)
            nuevo_evento["Nombre"] = document.getElementById("Nombre").value
            nuevo_evento["Precio"] = document.getElementById("Precio").value
            nuevo_evento["descuento"] = document.getElementById("descuento").value
            nuevo_evento["fecha_ini"] = document.getElementById("fecha_ini").value
            nuevo_evento["fecha_fin"] = document.getElementById("fecha_fin").value

            nuevo_evento["fecha_ini_ins"] = document.getElementById("fecha_ini_ins").value
            nuevo_evento["fecha_fin_ins"] = document.getElementById("fecha_fin_ins").value


            let data = new FormData(document.getElementById("form-modal"));
            data.append('id_evento',nuevo_evento["id_evento"])
            //console.log(data);
            if(document.getElementById("carrera").checked==true){         
                nuevo_evento["tipo"]="carrera"
                data.append('Tipo',nuevo_evento["tipo"])

                carreras.push(nuevo_evento)

            }else{
                nuevo_evento["tipo"]="curso"
                data.append('Tipo',nuevo_evento["tipo"])
                nuevo_evento["id_entrenador"] = document.getElementById("Entrenador").value

                cursos.push(nuevo_evento)
            }

            await fetch('/eventos/add_evento/', {
                method: "POST",
                body: data,
            })
            .then((resp) => resp.text())
            .then(function(data) {
                //console.log(data)
                rellenar_datos() 
            })
            .catch( err => {
                console.error(err)
            });

            ultimo++;
        }

        async function borrar_evento(tipo){
            data = new FormData()

            if(document.getElementById("carrera").checked==true){
                for (let i = 0; i < carreras.length; i++) {
                    if (carreras[i]["id_evento"]==document.getElementById("id_evento").value) {
                        //indicamos el id que eliminara al servidor
                        data.append("id_evento", carreras[i]["id_evento"])


                        //eliminamos carrera en cliente
                        carreras.splice(i,1)
                    }
                }
            }else{
                for (let i = 0; i < cursos.length; i++) {
                    if (cursos[i]["id_evento"]==document.getElementById("id_evento").value) {
                        //eliminamos carrera en servidor
                        data.append("id_evento", cursos[i]["id_evento"])
                        
                        //eliminamos carrera en cliente
                        cursos.splice(i,1) 
                    }
                }
            }

            await fetch('/eventos/borrar_evento/', {
                method: "POST",
                body: data,
            })
            .then((resp) => resp.text())
            .then(function(data) {
                //console.log(data)
                rellenar_datos() 
            })
            .catch( err => {
                console.error(err)
            });
        }

        

        rellenar_datos();
        
    </script>
<?php require_once RUTA_APP.'/vistas/inc/footer.php';?>