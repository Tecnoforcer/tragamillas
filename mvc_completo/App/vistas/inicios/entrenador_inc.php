<?php require_once RUTA_APP.'/vistas/inc/header.php';

?>
    <h1>hola Entrenador</h1>
    

    <div class="row">

        <div class="col-12">
            

            <a href="<?php echo RUTA_URL ?>/tests" style="font-size:4vh;"><i class="bi bi-layout-text-sidebar-reverse adminBTN"></i><p>tests</p></a>

        </div>
    </div>
    <div class="row">

            <div class="row">
                GRUPOS
            </div>
            <div class="row" id="grupos_entrenador">

            </div>
            



    </div>
    
 
   







<script>
    async function show_gru(id_usu) {
        /**
            <a href="<?php //echo RUTA_URL ?>/pruebas/1" style="font-size:4vh;">
                <i class="bi bi-layout-text-sidebar-reverse adminBTN"></i>
                <p>se supone que son varios grupos</p>
            </a>
         */


        var cont_gru=document.getElementById("grupos_entrenador")
        cont_gru.innerHTML="";
        var nomP="ponido"

        //aguait
        var enlace="<?php echo RUTA_URL?>/entrenadores/verGrupos"

        var data_env=new FormData();
        data_env.append("id_user",id_usu);

         console.log(data_env)
        await fetch(enlace,{
             method: "POST",
             body:data_env,
         })
        .then(response => response.json())
        .then(data => nomP = data)
        .catch( err => console.error(err));

        console.log(nomP)
         nomP.forEach(gru => {
             var cont=document.createElement("a")
             var hreff="<?php echo RUTA_URL ?>/pruebas/"+gru.id_grupo
             cont.setAttribute("href",hreff)
             cont.style="font-size:2vh;";
             cont.setAttribute("class","col-4")
             var ico=document.createElement("i")
             ico.setAttribute("class","bi bi-layout-text-sidebar-reverse adminBTN")
             var txt=document.createElement("p")
             var innerTXT=document.createTextNode(gru.nombre)

             txt.appendChild(innerTXT)

             cont.appendChild(ico)
             cont.appendChild(txt)

             cont_gru.appendChild(cont)
         });

        
    }
    show_gru(<?php echo $datos["usuarioSesion"]->id_user ?>)

</script>



<?php require_once RUTA_APP.'/vistas/inc/footer.php';?>