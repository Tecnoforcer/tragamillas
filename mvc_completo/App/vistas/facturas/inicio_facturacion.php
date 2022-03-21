<?php require_once RUTA_APP.'/vistas/inc/header.php'; ?>

<div class="row justify-content-center my-4 ">
    <div class="col-8 col-lg-3 me-5">
        <input type="text" name="busqueda" id="busqueda" class="form-control" placeholder="BUSCAR" oninput="comprobarBusqueda()">
    </div>       
</div>


<div class="row justify-content-around">
    <div class="col-4">
        <button class="btn btn-primary" onclick="generateCSVjs()">Generar Cuotas Socios</button>
    </div>
    
</div>


<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>  
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>  
                <th>importe</th>
                <th>Tipo de cuota</th>
            </tr>
        </thead>
        <tbody id="tbodyy">
                
            
        </tbody>
    </table>
</div> 



<script>
    valor_importe_base=80
    valor_importe_cabeza_familia=135
    valor_importe_familiar=0

    let usuarios = [];
    let usuarios_x_importe=[];
    let usuarios_usar = [];
    


    async function generateCSVjs() {
        var enlace="/facturas/genereateCSV";
    
        var nomP="epic failure";
        
        usu_env=JSON.stringify(usuarios_x_importe)
        //console.log(usu_env);

        const data_env=new FormData()
        data_env.append("usuarios_x_importe",usu_env)
       

        await fetch(enlace,{
            method:"POST",
            body:data_env
        })
            .then(response => response.text())
            .then(data => nomP = data)
            .catch( err => console.error(err));

        //console.log(nomP);
        download()
    }
   // generateCSVjs()
   function download() {
       fileUrl="export_cuota_socio.csv"
       fileName="Cuota_Socios.csv"
        var a = document.createElement("a");
        a.href = fileUrl;
        a.setAttribute("download", fileName);
        a.click();
    }

 
    async function obtener_socios_cuota(){
        await fetch('/facturas/obtener_socios_factura')
        .then((resp) => resp.json())
        .then(function(data) {
            //console.log("data");
            ////console.log(data);
            usuarios=data;
            usuarios_usar=data;
                  
        })
        .catch( err => {
            console.error(err)            
        });
        rellenarTabla(usuarios_usar)

    }
    obtener_socios_cuota()
    

    

    function rellenarTabla(usuarioss){
        var importe_is_set=false
        if (usuarios_x_importe.length != 0) {
            importe_is_set=true
        }


        tbody = document.getElementById("tbodyy");
        tbody.innerHTML=""
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
            td_rol = document.createElement("td");
            td_talla = document.createElement("td");
            td_tipo = document.createElement("td");
            td_entregar = document.createElement("td");

            id_user.appendChild(document.createTextNode(usuarioss[i].id_user));
            id_user.setAttribute("hidden",true);

            td_dni.appendChild(document.createTextNode(usuarioss[i].Dni));

            td_nombre.appendChild(document.createTextNode(usuarioss[i].nombre));
            td_apellido.appendChild(document.createTextNode(usuarioss[i].apellido));

           

            tipo = document.createElement("input")
            tipo.setAttribute('type', 'number')
            tipo.setAttribute('step', '1')
            tipo.classList.add("form-control", "text-dark")
            tipo.id = "tipo_"+usuarioss[i].id_user
            tipo.setAttribute('placeholder',"insertar importe")
            tipo.setAttribute('oninput',"change_importe_usu(this)")

            var cabeza_famlia=false
            var familiar=false

           
            if ((usuarioss[i].familiar != undefined) && (usuarioss[i].familiar != null) ) {
                if (usuarioss[i].familiar == usuarioss[i].id_user) {
                    
                    cabeza_famlia=true
                    
                }else{
                    familiar=true
                }
            }

         
            if(cabeza_famlia){
                if (importe_is_set) {
                    for (let j = 0; j < usuarios_x_importe.length; j++) {
                        if (usuarioss[i].Dni == usuarios_x_importe[j][0]) {
                            tipo.value=usuarios_x_importe[j][1]
                        }
                        
                    }
                }else{
                    var usu_importe=[]
                    usu_importe[0]=usuarioss[i].Dni
                    usu_importe[1]=valor_importe_cabeza_familia
                    usuarios_x_importe[i]=usu_importe
                    tipo.value=valor_importe_cabeza_familia;
                }
                
                td_entregar.appendChild(document.createTextNode("Cabeza de familia"))

            }else if (familiar){
                if (importe_is_set) {
                    for (let j = 0; j < usuarios_x_importe.length; j++) {
                        if (usuarioss[i].Dni == usuarios_x_importe[j][0]) {
                            tipo.value=usuarios_x_importe[j][1]
                        }
                        
                    }
                }else{
                    var usu_importe=[]
                    usu_importe[0]=usuarioss[i].Dni
                    usu_importe[1]=valor_importe_familiar
                    usuarios_x_importe[i]=usu_importe
                    tipo.value=valor_importe_familiar;
                }
                
                td_entregar.appendChild(document.createTextNode("Familiar"))

            }else{
                if (importe_is_set) {
                    for (let j = 0; j < usuarios_x_importe.length; j++) {
                        if (usuarioss[i].Dni == usuarios_x_importe[j][0]) {
                            tipo.value=usuarios_x_importe[j][1]
                        }
                        
                    }
                }else{
                    var usu_importe=[]
                    usu_importe[0]=usuarioss[i].Dni
                    usu_importe[1]=valor_importe_base
                    usuarios_x_importe[i]=usu_importe
                    tipo.value=valor_importe_base; 
                }
                
                td_entregar.appendChild(document.createTextNode("Estandar"))
                
            }
        
            td_tipo.appendChild(tipo)
            
            tr.appendChild(id_user)
            tr.appendChild(td_dni)
            tr.appendChild(td_nombre)
            tr.appendChild(td_apellido)
            //tr.appendChild(td_rol)
            tr.appendChild(td_tipo)
           // tr.appendChild(td_talla)            
            tr.appendChild(td_entregar)
            tbody.appendChild(tr);
        }
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

   function change_importe_usu(dis) {
       var importe_nuevo=dis.value
       var parent=dis.parentNode.parentNode
       var user_dni=parent.childNodes[1].innerHTML

       
       for (let i = 0; i < usuarios_x_importe.length; i++) {
           
               if (usuarios_x_importe[i][0] == user_dni) {
                   
                   usuarios_x_importe[i][1]=importe_nuevo
               }
               
           
           
       }
   }
    
   


</script>
<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>