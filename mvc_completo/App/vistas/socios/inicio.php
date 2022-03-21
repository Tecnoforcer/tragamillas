<?php require_once RUTA_APP.'/vistas/inc/header.php';?>

<?php //print_r($datos['horarioSocio'])?>
    <div class="row">
        <div class="col-12 col-lg-6 adminOPT " style="font-size: 3vh;">
        <table class="table table-hover" id="tabla_usuarios">
            <?php $uruario = $datos['usuarioSesion'];?>
                <thead>  
                    <td><?php echo $uruario->nombre?></td>
                    <td><?php echo $uruario->apellido?></td>
                </thead>
                <tr class="puebasUsu">
                    <td>Prueba</td>
                    <td>Marca</td>
                    <td>Fecha</td>
                </tr>

            <?php foreach($datos['marcasSocio'] as $prueba): ?>
                <tr class="puebasUsu">

                    <?php foreach($datos['pruebasSocio'] as $prueba_nombre):?>

                        <?php if ($prueba_nombre->Id_prueba==$prueba->Id_prueba) {?>
                            <td><?php print_r($prueba_nombre->nombre) ?></td>
                        <?php } ?>

                    <?php endforeach; ?>

                    <td><?php print_r($prueba->marca) ?></td>
                    <td><?php print_r($prueba->Fecha)?></td>
                <tr style="font-size: 3vh;">
            <?php endforeach; ?>
    
                </tr>
        </table>
        </div>


        <div class="col-4 col-lg-2 adminOPT ">
            <a href="<?php echo RUTA_URL ?>/socios/inicioLicencias" ><i class="bi bi-person-video adminBTN"></i>
            <p class="enlaUsu">Licencias</p> </a>
        </div>
        <div class="col-4 col-lg-2 adminOPT ">
            <a href="<?php echo RUTA_URL ?>/socios/Inscripcion_eventos" ><i class="bi bi-pencil-fill adminBTN"></i>
            <p class="enlaUsu">Inscripción Grupo/Evento</p></a>
        </div>


        <div class="col-4 col-lg-2 adminOPT">
            <a data-bs-toggle="modal" data-bs-target="#Modal_Pass" onclick="cambiarPass(<?php echo $datos['usuarioSesion']->id_user?>,'<?php echo $datos['usuarioSesion']->email?>')">
                <i class="bi bi-shield-lock-fill adminBTN">
                    <p class="enlaUsu">Cambiar Contraseña</p>
                </i>
            </a>
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



    <div class="row">
        <div class="col-12 col-lg-6 adminOPT" style="font-size: 3vh;">
            <br>
            <h1>Horario</h1>
            <div class="table-responsive">

            <table class="table table-responsive-sm" id="tabla_usuarios">

                <thead class="horario">
                    <td>Lunes</td>
                    <td>Martes</td>
                    <td>Miercoles</td>
                    <td>Jueves</td>
                    <td>Viernes</td>
                    <td>Sabado</td>
                    <td>Domingo</td>
                </thead>

                <?php
                    $horarioSemana = ['---','---','---','---','---','---','---'];
                ?>

                <tr class="horario">
                    <?php 
                    
                    foreach($datos['horarioSocio'] as $hora_socios):
                        if ($hora_socios->dia_sem == 'Lunes'){
                            $horarioSemana[0] = $hora_socios->hora_ini.'/'.$hora_socios->hora_fin;
                        }
                        if ($hora_socios->dia_sem == 'Martes') {
                            $horarioSemana[1] = $hora_socios->hora_ini.'/'.$hora_socios->hora_fin;
                        }
                        if ($hora_socios->dia_sem == 'Miercoles') {
                            $horarioSemana[2] = $hora_socios->hora_ini.'/'.$hora_socios->hora_fin;
                        }
                        if ($hora_socios->dia_sem == 'Jueves'){
                            $horarioSemana[3] = $hora_socios->hora_ini.'/'.$hora_socios->hora_fin;
                        }
                        if ($hora_socios->dia_sem == 'Viernes') {
                            $horarioSemana[4] = $hora_socios->hora_ini.'/'.$hora_socios->hora_fin;
                        }
                        if ($hora_socios->dia_sem == 'Sabado') {
                            $horarioSemana[5] = $hora_socios->hora_ini.'/'.$hora_socios->hora_fin;
                        }
                        if ($hora_socios->dia_sem == 'Domingo') {
                            $horarioSemana[6] = $hora_socios->hora_ini.'/'.$hora_socios->hora_fin;
                        }
                    endforeach;?>
                    
                    <td> <?php echo $horarioSemana[0]?></td>
                    <td> <?php echo $horarioSemana[1]?></td>
                    <td> <?php echo $horarioSemana[2]?></td>
                    <td> <?php echo $horarioSemana[3]?></td>
                    <td> <?php echo $horarioSemana[4]?></td>
                    <td> <?php echo $horarioSemana[5]?></td>
                    <td> <?php echo $horarioSemana[6]?></td>

                </tr>
            </table>

            </div>
        </div>

        
        <div class="col-12 col-lg-6 adminOPT" style="font-size: 3vh;">
            <h1>Calendario</h1>

            <?php
            # definimos los valores iniciales para nuestro calendario
            $month=date("n");
            $year=date("Y");
            $diaActual=date("j");

            # Obtenemos el dia de la semana del primer dia
            # Devuelve 0 para domingo, 6 para sabado
            $diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
           
            # Obtenemos el ultimo dia del mes
            $ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));
            
            $meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
            "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            ?>
            

            <table id="calendar">
            <caption><?php echo $meses[$month]." ".$year?></caption>
            <tr style="font-size: 2vh;">
                <th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
                <th>Vie</th><th>Sab</th><th>Dom</th>
            </tr>
            <tr style="font-size: 2vh;">
                <?php
                $last_cell=$diaSemana+$ultimoDiaMes;
                // hacemos un bucle hasta 42, que es el máximo de valores que puede
                // haber... 6 columnas de 7 dias
                for($i=1;$i<=42;$i++){
                    if($i==$diaSemana){
                        // determinamos en que dia empieza
                        $day=1;
                    }
                    if($i<$diaSemana || $i>=$last_cell){
                        // celca vacia
                        
                        echo "<td>---</td>";
                    }else{
                        if($day==$diaActual)
                                echo "<td class='hoy'>$day</td>";
                            else
                                echo "<td>$day</td>";
                        
                        
                        $day++;
                    }
                    // cuando llega al final de la semana, iniciamos una columna nueva
                    if($i%7==0)
                    {
                        echo "</tr><tr>\n";
                    }
                }
            ?>
            </tr>
        </table>
        <br>
        </div>
    </div>
      
    <script>
        function cambiarPass(id_user, email){
            document.getElementById("id_user_Pass").value = id_user
            document.getElementById("email_Pass").value = email
        }

        async function cambiar_pass(){
            let id_user= document.getElementById("id_user_Pass").value
            let pass = document.getElementById("pass_Pass").value
            let confirm = document.getElementById("confirmar_Pass").value

            if (pass == confirm){
                const data = new FormData()
                data.append("id_user", id_user)
                data.append("pass",pass)
                
                await fetch('/socios/cambiar_pass/', {
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

    </script>

<?php require_once RUTA_APP.'/vistas/inc/footer.php';?>