<?php require_once RUTA_APP.'/vistas/inc/header.php';?>
<?php //print_r($datos);?>

<div class="row">

    <h1><?php echo $datos['usuarioSesion']->nombre?> <?php echo $datos['usuarioSesion']->apellido?></h1>
        <div class="col-12 adminOPT " style="font-size: 3vh;">
        <table class="table" id="tabla_usuarios">
            <?php $equipacion = $datos['equipacionUsu'];?>
            <thead>  
                    <td>Talla</td>
                    <td>Fecha de Petición</td>
                    <td>Tipo</td>
                </thead>
            <tbody id="bodyiy">




            </tbody>
                
                

                
    
                
        </table>

        <button type="button" class="btn  btn-outline-success btn-lg"  onclick="insertarEquipacion(<?php echo $datos['usuarioSesion']->id_user ?>)">
            <i class="bi bi-bag-plus"></i>
        </button> 
        </div>
    </div>

    <script>

        async function reloadd() {
            var bod=document.getElementById("bodyiy")
            bod.innerHTML=""
            nomP="fail";

            await fetch('/equipaciones/reloadd/<?php echo $datos['usuarioSesion']->id_user ?>')
              .then((response) => response.json())
              .then(data => nomP=data)
              .catch( err => {
                console.error(err)
              });
              //console.log(nomP);

            nomP.forEach(eqq => {
                var trr=document.createElement("tr")
                var td_talla=document.createElement("td")
                var td_fcha=document.createElement("td")
                var td_tipo=document.createElement("td")

                if (eqq.talla==null) {
                    td_talla.appendChild(document.createTextNode("Equipacion aun sin elegir"))
                }else{
                    td_talla.appendChild(document.createTextNode(eqq.talla))
                }
                 
                td_fcha.appendChild(document.createTextNode(eqq.fecha_peticion))
                td_tipo.appendChild(document.createTextNode(eqq.tipo))

                trr.appendChild(td_talla)
                trr.appendChild(td_fcha)
                trr.appendChild(td_tipo)

                bod.appendChild(trr)
            });


        }
        reloadd();
    async function insertarEquipacion(id){

        let data = new FormData();
        await fetch('/equipaciones/insertarEquipacion/', {
                method: "POST",
                body:data,
            })
            .then((resp) => resp.text())
            .then(async function(data) {
                //console.log(data)
                reloadd()
            })
            .catch( err => {
                console.error(err)
            });
        }


    </script>

<?php require_once RUTA_APP.'/vistas/inc/footer.php';?>