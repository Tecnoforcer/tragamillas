<?php require_once RUTA_APP.'/vistas/inc/header.php';
//print_r($datos);
?>

<!-- div clas container eliminado -->
        <div class="row d-flex justify-content-center">
            <form action="" class="col-10 border border-primary d-flex flex-column justify-content-center pb-3">
                    <legend class="d-flex justify-content-center">Inscripcion Eventos</legend>
                <div class="d-flex justify-content-evenly">
                    <div>
                        <label for="grupo">Grupo</label>
                        <input type="radio" id="grupo" name="ev_curs" value="grupo" onchange="rellenar_datos(this)">
                    </div>                
                    <div>
                        <label for="carrera">Carrera</label>
                        <input type="radio" id="carrera" name="ev_curs" value="carrera" onchange="rellenar_datos(this)">
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
    


<script>
    let carreras = [];
    let cursos = [];
    let grupos = [];
    let entrenador = [];
    let ultimoId;

    async function obtener_eventos(){
        await fetch('/usuarios/obtener_eventos/')
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
                                    <form method="POST" action="controlar_solicitudes">
                                        <input type="hidden" name="id_sol" id="id_sol" value="`+carreras[i]["id_evento"]+`">
                                        <input type="hidden" name="tipo" id="tipo" value="carrera">
                                        <button type="submit" class="btn  btn-block btn-outline-primary me-1">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>
                                    </form>
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
                                    <form method="POST" action="controlar_solicitudes">
                                        <input type="hidden" name="id_sol" id="id_sol" value="`+grupos[i]["id_grupo"]+`">
                                        <input type="hidden" name="tipo" id="tipo" value="grupo">
                                        <button type="submit" class="btn  btn-block btn-outline-primary me-1">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>
                                    </form>
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
                                    <form method="POST" action="controlar_solicitudes">
                                        <input type="hidden" name="id_sol" id="id_sol" value="`+cursos[i]["id_evento"]+`">
                                        <input type="hidden" name="tipo" id="tipo" value="curso">
                                        <button type="submit" class="btn  btn-block btn-outline-primary me-1">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        `
            }
        }

        document.getElementById("datos").innerHTML = salida
        document.getElementById(dis.id).checked = true
    }

    rellenar_datos(document.getElementById("grupo"))
    
    
</script>

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ;?>