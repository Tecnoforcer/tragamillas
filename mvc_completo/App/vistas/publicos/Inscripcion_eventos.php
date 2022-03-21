<?php require_once RUTA_APP.'/vistas/inc/header.php'; print_r($datos["usuarioSesion"]);?>


<a href=".." class="btn btn-light"><i class="bi bi-chevron-double-left"></i>Volver</a>

    <!-- div clas container eliminado -->
        <div class="row d-flex justify-content-center">
            <form action="" class="col-10 border border-primary d-flex flex-column justify-content-center pb-3">
                    <legend class="d-flex justify-content-center">Inscripcion Eventos</legend>
                    <div class="d-flex justify-content-evenly">
                <?php if (isset($datos['usuarioSesion'])):?>
                        <div>
                            <label for="grupo">Grupo</label>
                            <input type="radio" id="grupo" name="ev_curs" value="grupo" onchange="rellenar_datos(this)" checked>
                        </div>
                <?php endif;?>
                
                    <div>
                        <label for="carrera">Carrera</label>
                        <input type="radio" id="carrera" name="ev_curs" value="carrera" onchange="rellenar_datos(this)" <?php if (!isset($datos['usuarioSesion'])):?>checked<?php  endif;?>>
                    </div>
                
                    <div>
                        <label for="curso">Curso</label>
                        <input type="radio" id="curso" name="ev_curs" value="curso" onchange="rellenar_datos(this)">
                    </div>
                </div>
            </form>
            <br>
           <div id="datos" style="margin-top:2vh" class="row"></div>
        </div>
    

    <!-- Modal Evento-->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="ModalTitler" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">                    
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalTitler"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="contenidoModalUsuario">

                    <form method="post" enctype="multipart/form-data" class="card-body  d-flex flex-row justify-content-around" id="form-modal" >
                    
                        <input  type="hidden" name="id_evento" id="id_evento" class="form-control form-control-lg">
                        <input  type="hidden" name="id_socio" value="<?php echo($datos["usuarioSesion"]->id_user)?>" id="id_socio" class="form-control form-control-lg">
                        
                        <?php if (!isset($datos['usuarioSesion'])):?>
                            <div class="col-5">               
                                <legend>Datos Personales</legend>	 
                                <div class="mt-3 mb-3">
                                    <label for="nombre_ext">Nombre: <sup>*</sup></label>
                                    <input type="text" name="nombre_ext" id="nombre_ext" class="form-control form-control-lg" placeholder="Benito">
                                </div>
                                    <div class="mb-3">
                                    <label for="apellido_ext">Apellidos: <sup>*</sup></label>
                                <input type="text" name="apellido_ext" id="apellido_ext" class="form-control form-control-lg" placeholder="Pérez Galdós">  
                                </div>
                                <div class="mb-3">
                                    <label for="Dni_ext">DNI/NIE: <sup>*</sup></label>
                                    <input type="text" name="Dni_ext" id="Dni_ext" class="form-control form-control-lg" placeholder="00000000A"> 
                                </div> 
                                <div class="mb-3">
                                    <label for="email_ext">Email: <sup>*</sup></label>
                                    <input type="email" name="email_ext" id="email_ext" class="form-control form-control-lg" placeholder="tuprimaladelpueblo@gmail.com">
                                </div>
                                <div class="mb-3">
                                    <label for="telefono_ext">Telefono: <sup>*</sup></label>
                                    <input type="text" name="telefono_ext" id="telefono_ext" class="form-control form-control-lg" placeholder="676547895">
                                </div>
                                <div class="mb-3">
                                    <label for="fecha_nac_ext">fecha nacimiento: <sup>*</sup></label>
                                    <input type="date" name="fecha_nac_ext" id="fecha_nac_ext" class="form-control form-control-lg">
                                </div>
                                <div class="mb-3">
                                    <label for="CC_ext">CC: <sup>*</sup></label>
                                    <input type="text" name="CC_ext" id="CC_ext"placeholder="ES00 0000 0000 00 0000000000" class="form-control form-control-lg">
                                </div>
                            </div>
                        <?php endif;?>
                        <div class="<?php if (!isset($datos['usuarioSesion'])):?>col-5<?php else:?>col<?php endif;?>">
                            <legend>Evento</legend>
                            <div class="mt-3 mb-3">
                                <label for="Nombre">Nombre: <sup>*</sup></label>
                                <input type="text" name="Nombre" id="Nombre" class="form-control form-control-lg">
                            </div>

                            <div class="mt-3 mb-3" id="escondido1">
                                <label for="Precio" id="precio">Precio: <sup>*</sup></label>
                                <input type="int" name="Precio" id="Precio" class="form-control form-control-lg">
                            </div>

                            <div class="mt-3 mb-3" id="escondido2">
                                <label for="Descuento">Descuento: <sup>*</sup></label>
                                <input type="int" name="Descuento" id="Descuento" class="form-control form-control-lg">
                            </div>

                            <div class="mt-3 mb-3" id="escondido3">
                                <label for="Fecha_ini">Fecha Inicio: <sup>*</sup></label>
                                <input type="date" name="Fecha_ini" id="Fecha_ini" class="form-control form-control-lg">
                            </div>

                            <div class="mt-3 mb-3" id="escondido4">
                                <label for="Fecha_fin">Fecha Fin: <sup>*</sup></label>
                                <input type="date" name="Fecha_fin" id="Fecha_fin" class="form-control form-control-lg">
                            </div>


                            <div class="mt-3 mb-3 d-flex justify-content-around row" id="escondido5">
                                <div class="me-3 col-lg-4">    
                                    <?php if (!is_null($datos["usuarioSesion"]->img)):?>
                                        <div id="text_before_img">Imagen actual:</div>   
                                        <img src="/public/imagenes/fotos_usu/<?php echo $datos["usuarioSesion"]->img;?>" id="img" alt="" class="img_usuario">
                                    <?php else:?>
                                        <div id="text_before_img">No hay ninguna imagen actualmente</div>   
                                        <img src="" id="img" alt="" hidden class="img_usuario">
                                    <?php endif;?>
                                    
                                </div>
                                <div class="col-lg-6">
                                    <label for="imagen">Seleccionar nueva imagen: <sup>*</sup></label>
                                    <input type="file" name="imagen" id="imagen" class="form-control form-control-lg">
                                </div>
                            </div>


                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="actuador" class="btn btn-success" data-bs-dismiss="modal">Inscribirse</button>
                    <!-- <button type="button" onclick="add_externo()">Prueba</button> -->
                </div>
            </div>
        </div>
    </div>




    <script>
        let carreras = [];
        let cursos = [];
        let grupos = [];
        let ultimoId;

        async function obtener_eventos(){
            await fetch('/<?php if (!isset($datos['usuarioSesion'])):?>publicos<?php else:?>socios<?php endif;?>/obtener_eventos/')
            .then((resp) => resp.json())
            .then(function(data) {
                //console.log(data);
                carreras = data.carreras;
                cursos = data.cursos  
                grupos = data.grupos                        
            })
            .catch( err => {
                console.error(err)            
            });
            //console.log(carreras)
            //console.log(cursos)
            //console.log(grupos)
        }

        async function rellenar_datos(dis){
            await obtener_eventos();
            salida= "";

            

            if (dis.id=="carrera") {
                for (let i = 0; i < carreras.length; i++) {   
                    salida += `
                                <div class="border border-primary col-3 text-center p-2 m-2">
                                    <div>`+carreras[i]["Nombre"]+`</div>

                                    <div>
                                        <button type="button" class="btn  btn-block btn-outline-primary me-1"  data-bs-toggle="modal" data-bs-target="#modal" onclick="eventoActual(`+carreras[i]["id_evento"]+`, 'carrera');cambiarModal('inscrip_carrera',)">
                                        <i class="bi bi-plus-circle"></i>
                                        </button>

                                    </div>
                                </div>
                                
                            `
                }

            } else if (dis.id=="grupo") {
            
                for (let i = 0; i < grupos.length; i++) {   
                    salida += `
                                <div class="border border-primary col-3 text-center p-2 m-2">
                                    <div>`+grupos[i]["nombre_grupo"]+`</div>

                                    <div>
                                        <button type="button" class="btn  btn-block btn-outline-primary"  data-bs-toggle="modal" data-bs-target="#modal" onclick="eventoActual(`+grupos[i]["id_grupo"]+`, 'grupo');cambiarModal('grupo')">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>


                                    </div>
                                </div>

                            `           
                                
                }
            
            }else{
                for (let i = 0; i < cursos.length; i++) {
                    salida += `
                                <div class="border border-primary col-3 text-center p-2 m-2">
                                    `+cursos[i]["nombre_evento"]+`

                                    <div>
                                        <button type="button" class="btn  btn-block btn-outline-primary me-1"  data-bs-toggle="modal" data-bs-target="#modal" onclick="eventoActual(`+cursos[i]["id_evento"]+`, 'cursos');cambiarModal('inscrip_curso')">
                                        <i class="bi bi-plus-circle"></i>
                                        </button>

                                    </div>
                                </div>
                            `
                }
            }

            document.getElementById("datos").innerHTML = salida
        }

        async function eventoActual(id_evento, tipo){
            if (tipo=="carrera"){
                for (let i = 0; i < carreras.length; i++) {
                    if (carreras[i]["id_evento"]==id_evento) {
                        document.getElementById("id_evento").value = carreras[i]["id_evento"];
                        document.getElementById("Nombre").value = carreras[i]["Nombre"];
                        document.getElementById("Precio").value = carreras[i]["Precio"];
                        document.getElementById("Descuento").value = carreras[i]["descuento"];
                        document.getElementById("Fecha_ini").value = carreras[i]["fecha_ini"];
                        document.getElementById("Fecha_fin").value = carreras[i]["fecha_fin"];
                        break;
                    }                    
                }
            }else if(tipo=="grupo"){

                //console.log(grupos)
                for (let i = 0; i < grupos.length; i++) {
                    if (grupos[i]["id_grupo"]==id_evento) {
                        document.getElementById("id_evento").value = grupos[i]["id_grupo"];
                        document.getElementById("Nombre").value = grupos[i]["nombre_grupo"];
                        break;
                    }
                }

            }else{
                for (let i = 0; i < cursos.length; i++) {
                    if (cursos[i]["id_evento"]==id_evento) {
                        document.getElementById("id_evento").value = cursos[i]["id_evento"];
                        document.getElementById("Nombre").value = cursos[i]["nombre_evento"];
                        document.getElementById("Precio").value = cursos[i]["Precio"];
                        document.getElementById("Descuento").value = cursos[i]["descuento"];
                        document.getElementById("Fecha_ini").value = cursos[i]["fecha_ini"];
                        document.getElementById("Fecha_fin").value = cursos[i]["fecha_fin"];
                        break;
                    }                    
                }
            }
        }


//mostramos los datos del evento seleccionado
        

        async function cambiarModal(accion){
            boton = document.getElementById("actuador")

            //console.log(boton)

            //quitamos el eventos anteriores
            //boton.removeEventListener(("click", inscribirseEvento))
            //boton.removeEventListener("click", borrar_evento)

            //hacemos que el modal no se pueda modificar
            document.getElementById("id_evento").readOnly = true
            document.getElementById("Nombre").readOnly = true
            document.getElementById("Precio").readOnly = true
            document.getElementById("Descuento").readOnly = true
            document.getElementById("Fecha_ini").readOnly = true
            document.getElementById("Fecha_fin").readOnly = true
            document.getElementById("ModalTitler").readOnly = true


            document.getElementById("escondido1").removeAttribute("hidden")
            document.getElementById("escondido2").removeAttribute("hidden")
            document.getElementById("escondido3").removeAttribute("hidden")
            document.getElementById("escondido4").removeAttribute("hidden")
            document.getElementById("escondido5").classList.add("d-none")


            
            switch (accion) {
                case 'inscrip_curso':

                    document.getElementById("escondido2").setAttribute("hidden",true)
                    
                    document.getElementById("ModalTitler").innerHTML = "Inscribirse Evento"
                    boton.innerHTML = "Inscribirse"                   
                    <?php if (!isset($datos['usuarioSesion'])):?>
                        boton.addEventListener("click", add_solicitud_ev_externo)
                    <?php else:?>
                        boton.addEventListener("click", addPeticionEvento)
                    <?php endif;?>
                        
                    break;


                case 'inscrip_carrera':
                    //document.getElementById("escondido").removeAttribute("hidden")
                    document.getElementById("escondido5").setAttribute("hidden",true)

                    //hacemos que no se puedan cambiar los datos del usuario
                    document.getElementById("ModalTitler").innerHTML = "Incribirse grupo"
                    boton.innerHTML = "incribirse"
                    <?php if (!isset($datos['usuarioSesion'])):?>
                        boton.addEventListener("click", add_solicitud_ev_externo)
                    <?php else:?>
                        boton.addEventListener("click", addPeticionEvento)
                    <?php endif;?>

                break;

                case 'grupo':
                    document.getElementById("escondido1").setAttribute("hidden",true)
                    document.getElementById("escondido2").setAttribute("hidden",true)
                    document.getElementById("escondido3").setAttribute("hidden",true)
                    document.getElementById("escondido4").setAttribute("hidden",true)
                    document.getElementById("escondido5").classList.remove("d-none")

                    //hacemos que no se puedan cambiar los datos del usuario
                    document.getElementById("ModalTitler").innerHTML = "Incribirse grupo"
                    boton.innerHTML = "inscribirse"
                    <?php if (!isset($datos['usuarioSesion'])):?>
                        boton.addEventListener("click", add_externo)
                    <?php endif;?>
                    boton.addEventListener("click", aDDadirPeticionGrupo)

                    break;
            }
            
            
        }


        <?php if (!isset($datos['usuarioSesion'])):?>
            //FUNCIONES PARA LOS EXTERNOS
            async function add_externo(){
                let data = new FormData(document.getElementById("form-modal"));

                //console.log(Object.fromEntries(data));

                await fetch('/publicos/add_externo/', {
                    method: "POST",
                    body:data,
                })
                .then((resp) => resp.json())
                .then(function(data) {
                    //console.log(data)
                    ultimoId = data
                })
                .catch( err => {
                    console.error(err)
                });
                //console.log(ultimoId)
            }

            async function add_solicitud_ev_externo(){
                let data = new FormData(document.getElementById("form-modal"));
                await add_externo();
                //console.log(Object.fromEntries(data));
                data.append('id_externo', ultimoId);
                
                await fetch('/publicos/add_solicitud_ev_externo/', {
                    method: "POST",
                    body:data,
                })
                .then((resp) => resp.json())
                .then(function(data) {
                    alert("Su inscripcion ha sido recibida")
                })
                .catch( err => {
                    console.error(err)
                });
            }

        <?php endif;?>

        async function aDDadirPeticionGrupo(){   

            let data = new FormData(document.getElementById("form-modal"));
            
            

            <?php if (!is_null($datos["usuarioSesion"]->img)):?>
                data.append('existe_img','true');
                data.append('old_img', '<?php echo $datos["usuarioSesion"]->img;?>');
            <?php else: ?>
                data.append('existe_img','false');
            <?php endif;?>

            //console.log(Object.fromEntries(data));


            await fetch('/socios/aDDadirPeticionGrupo/', {
                method: "POST",
                body:data,
            })
            .then((resp) => resp.json())
            .then(function(data) {
                //console.log(data)
                if (data!=false){
                    document.getElementById("img").src = "/public/imagenes/fotos_usu/"+data;
                    document.getElementById("img").removeAttribute("hidden");
                    document.getElementById("text_before_img").innerHTML = "Imagen Actual:"

                    alert("Su inscripcion ha sido enviada"); /////MIRAR ESTOS MENSAJES
                }else{
                    //console.log(data);
                    alert("Podria haber habido un error o bien ya habia una inscipcion anterior");
                }
            })
            .catch( err => {
                console.error(err)
            });        
        }

        async function addPeticionEvento(){   

            let data = new FormData(document.getElementById("form-modal"));


            await fetch('/socios/addPeticionEvento/', {
                method: "POST",
                body:data,
            })
            .then((resp) => resp.json())
            .then(function(data) {
                //console.log(data)
                //rellenar_datos(document.getElementById("carrera")) 
            })
            .catch( err => {
                console.error(err)
            });        
        }
        
        <?php if (isset($datos['usuarioSesion'])):?>
            rellenar_datos(document.getElementById("grupo"))
        <?php else:?>
            rellenar_datos(document.getElementById("carrera"))
        <?php endif;?>       

</script>   
    

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>