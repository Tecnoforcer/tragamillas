<?php

    class Usuarios extends Controlador{

        
        public function __construct(){
 
            Sesion::iniciarSesion($this->datos);
            $this->datos['rolesPermitidos'] = [0,5,200];          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }

            $this->usuarioModelo = $this->modelo('Usuario');
            $this->equipacionModelo = $this->modelo('Equipacion');
            $this->socioModelo = $this->modelo('Socio');
            

            $this->datos['menuActivo'] = 1;         // Definimos el menu que sera destacado en la vista
        }

        public function index(){
            
            $this->datos['rolesPermitidos'] = [0];

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }else{
            $usuarios = $this->usuarioModelo->obtenerUsuariosActivos();

            $this->datos['usuarios'] = $usuarios;
            $this->datos['listaRoles'] = $this->usuarioModelo->obtenerRoles();//solusion  copipastear esta linea aki
            $this->vista('usuarios/inicio',$this->datos);
            }
            
        }

        public function gestionar_familia(){
            $this->datos['rolesPermitidos'] = [0];

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }else{
                
                $this->datos["id_socio"] = $_POST["id_socio"];
                $this->vista('usuarios/gestionar_familia',$this->datos);
            } 
   
        }

        public function obtener_socios(){
            $this->datos['rolesPermitidos'] = [0];

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }else{

                $usuarios = $this->socioModelo->obtenerUsuariosSocioss();
                $this->vistaApi($usuarios);
            } 
        }

        public function asignar_familiares(){
            $ids = $_POST["ids"];
            $id_cabeza = $_POST["id_cabeza"];

            $vaciar = $this->socioModelo->vaciar_familiares($id_cabeza);

            if ($vaciar) {
                $asignar = $this->socioModelo->asignar_familiares($ids,$id_cabeza);

                if ($asignar) {
                    $this->vistaApi(true);
                }else{
                    $this->vistaApi(false);
                }
            }else{
                $this->vistaApi(false);
            }
           
        }

        public function deshacer_familia(){
            $id_cabeza = $_POST["id_cabeza"];

            $vaciar = $this->socioModelo->vaciar_familiares($id_cabeza);

            
            if ($vaciar) {
                $this->vistaApi($this->socioModelo->obtenerUsuariosSocioss());
            }else{
                $this->vistaApi(false);
            }
        }

        public function obtenerUsuariosPaginacion(){
            $limitt=intval($_POST["limitt"]);
            $p_actual=$_POST["p_actual"];

            $startt=($p_actual-1)*$limitt;

            
            $usuarios=$this->usuarioModelo->obtenerUsuariosPaginacion($limitt,$startt);
            
            $this->vistaApi($usuarios);
        }

        public function reloadPaginationBTN(){
            $limitt=$_POST["limitt"];
            $usuarios=$this->usuarioModelo->obtenerUsuariosActivos();

            $num_usuarios=count($usuarios);

            $pmax=ceil($num_usuarios/$limitt);

            $this->vistaApi($pmax);
        }

        

        public function solicitudes_grupos_eventos(){
            $this->datos['rolesPermitidos'] = [0]; 
             if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                 redireccionar('/');
             }else{
                 $this->vista('usuarios/solicitudes_grupos_eventos', $this->datos);
             }            
         
        }

        public function controlar_solicitudes(){
            
            $this->datos['rolesPermitidos'] = [0]; 

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }else{
                $solicitudes=[];
                $id=$_POST["id_sol"];
                $tipo=$_POST["tipo"];
                if ($tipo=='grupo') {
                    
                    $solicitudes = $this->usuarioModelo->obtener_solicitudes_grupos($id);
                }else{
                    $solicitudes_soc = $this->usuarioModelo->obtener_solicitudes_eventos_soc($id);
                    $solicitudes_ext = $this->usuarioModelo->obtener_solicitudes_eventos_ext($id);

                    $solicitudes = array_merge($solicitudes_soc,$solicitudes_ext);
                }

                //print_r($solicitudes);
                
                $this->datos["solicitudes"]=$solicitudes;
                $this->datos["id_solicitud"]=$id;
                $this->datos["tipo"]=$tipo;

                $this->vista('usuarios/controlar_solicitudes',$this->datos);
                
            }
        }

        public function get_active_users(){
            //Obtenemos los usuarios
            $usuarios = $this->usuarioModelo->obtenerUsuariosActivos();

            $this->vistaApi($usuarios);
        }
        
        public function aceptar_solicitud_evento_socio(){

            $datos=$_POST;

            $aceptar_solicitud_evento_socio=$this->usuarioModelo->aceptar_solicitud_evento_socio($datos);

            if($aceptar_solicitud_evento_socio){
                
                $solicitudes_soc = $this->usuarioModelo->obtener_solicitudes_eventos_soc($datos["id_solicitud"]);
                $solicitudes_ext = $this->usuarioModelo->obtener_solicitudes_eventos_ext($datos["id_solicitud"]);

                $solicitudes = array_merge($solicitudes_soc,$solicitudes_ext);

                $this->vistaApi($solicitudes);
            }else{
                $this->vistaApi(false);
            }

        }

        public function aceptar_solicitud_evento_externo(){
            $datos=$_POST;
            //print_r($datos);

            $aceptar_solicitud_evento_externo=$this->usuarioModelo->aceptar_solicitud_evento_externo($datos);

            if($aceptar_solicitud_evento_externo){
                
                $solicitudes_soc = $this->usuarioModelo->obtener_solicitudes_eventos_soc($datos["id_solicitud"]);
                $solicitudes_ext = $this->usuarioModelo->obtener_solicitudes_eventos_ext($datos["id_solicitud"]);

                $solicitudes = array_merge($solicitudes_soc,$solicitudes_ext);

                $this->vistaApi($solicitudes);
            }else{
                $this->vistaApi(false);
            }
        }

        public function aceptar_solicitud_grupo(){
            $datos=$_POST;
            //print_r($_POST);
            
            $aceptar_solicitud_grupo=$this->usuarioModelo->aceptar_solicitud_grupo($datos);
            

            if($aceptar_solicitud_grupo){
                
                $solicitudes = $this->usuarioModelo->obtener_solicitudes_grupos($datos["id_solicitud"]);
                $this->vistaApi($solicitudes);
            }else{
                $this->vistaApi(false);
            }
        }

        public function rechazar_solicitud_evento_socio(){
            $datos=$_POST;
            //print_r($datos);

            $rechazar_solicitud_evento_socio=$this->usuarioModelo->rechazar_solicitud_evento_socio($datos);

            if($rechazar_solicitud_evento_socio){
                
                $solicitudes_soc = $this->usuarioModelo->obtener_solicitudes_eventos_soc($datos["id_solicitud"]);
                $solicitudes_ext = $this->usuarioModelo->obtener_solicitudes_eventos_ext($datos["id_solicitud"]);

                $solicitudes = array_merge($solicitudes_soc,$solicitudes_ext);

                $this->vistaApi($solicitudes);
            }else{
                $this->vistaApi(false);
            }
        }

        public function rechazar_solicitud_evento_externo(){
            $datos=$_POST;
            
            $rechazar_solicitud_evento_externo=$this->usuarioModelo->rechazar_solicitud_evento_externo($datos);
            $this->publicoModelo=$this->modelo('Publico');

            if($rechazar_solicitud_evento_externo){
                $borrarExterno = $this->publicoModelo->borrar_externo($datos["id_participante"]);

                if ($borrarExterno) {
                    $solicitudes_soc = $this->usuarioModelo->obtener_solicitudes_eventos_soc($datos["id_solicitud"]);
                    $solicitudes_ext = $this->usuarioModelo->obtener_solicitudes_eventos_ext($datos["id_solicitud"]);

                    $solicitudes = array_merge($solicitudes_soc,$solicitudes_ext);

                    $this->vistaApi($solicitudes);
                }
            }else{
                $this->vistaApi(false);
            }
        }

        public function rechazar_solicitud_grupo(){
            $datos=$_POST;
            //print_r($datos);

            $rechazar_solicitud_grupo=$this->usuarioModelo->rechazar_solicitud_grupo($datos);

            if($rechazar_solicitud_grupo){
                
                $solicitudes = $this->usuarioModelo->obtener_solicitudes_grupos($datos["id_solicitud"]);
                $this->vistaApi($solicitudes);
            }else{
                $this->vistaApi(false);
            }
        }


        public function obtener_eventos(){

            $this->socioModelo = $this->modelo('Socio');
            
            $eventos["carreras"] =$this->socioModelo->obtenerCarreras();
            $eventos["cursos"] = $this->socioModelo->obtenerCursos();
            $eventos["grupos"] = $this->socioModelo->obtenerGrupos();
            
            $eventos["entrenador"] = $this->socioModelo->obtenerEntrenadores();

            $this->vistaApi($eventos);
        }

        public function obtener_usu_actual($id_usuario){
            
            $datosUsuario = $this->usuarioModelo->obtenerUsuarioId($id_usuario);
            $datos['datos_usu'] = $datosUsuario;


            if ($datos['datos_usu']->rol==5) {
                $sueldo_raw = $this->usuarioModelo->obtenerSueldoEntrenador($id_usuario);
                $datos['datos_usu']->sueldo=$sueldo_raw->sueldo;
                
               
            }

            $this->vistaApi($datos);
        }



        public function editar_usuario(){//$id_user,$nombre,$apel,$emai,$dni,$cc,$tall
            

            $datos['id_user']=$_POST["id_user"];
            $datos['nombre']=$_POST["nombre"];
            $datos['apellido']=$_POST["apellido"];
            $datos['Dni']=$_POST["Dni"];
            $datos['email']=$_POST["email"];
            $datos['CC']=$_POST["CC"];
            $datos['rol']=$_POST["rol"];
            $datos['fecha_nac']=$_POST["fecha_nac"];
            $datos['telefono']=$_POST["telefono"];
            $datos['sueldo']=$_POST["sueldo"];

            //print_r($datos);

            $actualizarUsuario=$this->usuarioModelo->actualizarUsuario($datos);
 
            if ($datos['sueldo'] == "nil") {
                
                $actualizarTienda=$this->usuarioModelo->actualizarTienda($datos);
               
            }elseif ($datos['sueldo'] != null) {
                
                $actualizarEntrenador=$this->usuarioModelo->actualizarEntrenador($datos);
                
            }

           //exit;     
            if ($actualizarUsuario) {
                $usuarios=$this->usuarioModelo->obtenerUsuariosActivos();
                $this->vistaApi($usuarios);
            } else {
                $this->vistaApi(false);
            } 
        }

        

        public function cambiar_pass(){
            
            $datos['id_user']=$_POST["id_user"];
            $datos['pass']=$_POST["pass"];

            $cambiarPass = $this->usuarioModelo->cambiar_pass($datos);

            if ($cambiarPass) {
                $this->vistaApi(true);
            } else {
                $this->vistaApi(false);
            }

        }

        public function agregar_usuario(){
            $datos['nombre']=$_POST["nombre_Agregar"];     
            $datos['Dni']=$_POST["dni_Agregar"];
            $datos['email']=$_POST["email_Agregar"];
            $datos['CC']=$_POST["cc_Agregar"];
            $datos['telefono']=$_POST["telefono_Agregar"];
            $datos['rol']=$_POST["rol_Agregar"];

           
            
            $ultimo_usuario=$this->usuarioModelo->obtenerUltimoId();
            $datos['id_user']=$ultimo_usuario->id_user+1;
            
            $agregarUsuario=false;
            $agregarEntrenador=false;
            $agregarEntidad=false;

            //$this->vista('usuarios/editar_usuario',$actualizarUsuario);(nombre, apellido, Dni, email, CC, fecha_nac, telefono, rol)
            if ($datos['rol'] == 5) {
                $datos['apellido']=$_POST["apellido_Agregar"];
                $datos['fecha_nac']=$_POST["fnac_Agregar"];
                $datos['sueldo']=$_POST["sueldo_Agregar"];

                $agregarUsuario=$this->usuarioModelo->agregarUsuario($datos);
                $agregarEntrenador = $this->usuarioModelo->agregar_entrenador($datos);
                
            }

            if ($datos['rol'] == 200) {
                $datos['apellido']=NULL;
                $datos['fecha_nac']=NULL;


                $agregarUsuario=$this->usuarioModelo->agregarUsuario($datos);
                $agregarEntidad = $this->usuarioModelo->agregar_otra_entidad($datos);
            }

     
            if ($agregarUsuario && ($agregarEntrenador || $agregarEntidad)) {
                $usuarios=$this->usuarioModelo->obtenerUsuariosActivos();
                $this->vistaApi($usuarios);
            } else {
                $this->vistaApi(false);
            } 
        }


        public function baja_usuario(){
            
            
            $id=$_POST["id"];

            
            //$this->vistaApi($datos['id_user']);
            $bajaUsuario=$this->usuarioModelo->bajaUsuario($id);
            
            //$this->vista('usuarios/editar_usuario',$actualizarUsuario);(nombre, apellido, Dni, email, CC, fecha_nac, telefono, rol)
     
            if ($bajaUsuario) {
                $usuarios=$this->usuarioModelo->obtenerUsuariosActivos();
                $this->vistaApi($usuarios);
            } else {
                $this->vistaApi(false);
            } 
        }

        public function solicitudes_socio(){
            $this->datos['rolesPermitidos'] = [0]; 

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                $id_solicitud_soc=$_POST["id_solicitud_soc"];
                $action=$_POST["action"];
                

                if ($action=="Aceptar") {
                    $ultimo_usuario=$this->usuarioModelo->obtenerUltimoId();
                    
                    $id_user = $ultimo_usuario->id_user; //pasamos el ultimo Id de objeto a una variable
                    $id_user +=1;

                    $solicitud = $this->usuarioModelo->obtener_datos_solicitud($id_solicitud_soc); //obtenemos datos de la solicitud
                    
                    
                    $datos['id_user']=$id_user;
                    $datos['nombre']=$solicitud->nombre;
                    $datos['apellido']=$solicitud->apellido;
                    $datos['Dni']=$solicitud->Dni;
                    $datos['email']=$solicitud->email;                  //rellenamos un array con los datos para introducirlos en usuario
                    $datos['CC']=$solicitud->CC;
                    $datos['fecha_nac']=$solicitud->fecha_nac;
                    $datos['telefono']=$solicitud->telefono;
                    $datos['rol']=10;                    
                    
                    //print_r($datos);exit;

                    if($this->usuarioModelo->agregarUsuario($datos)){//Agregamos el socio a la tabla usuarios
                        $this->usuarioModelo->aceptar_solicitud_socio($id_solicitud_soc);//marcamos la solicitud como aceptada
                        $this->usuarioModelo->agregar_socio($id_user);

                        $solicitudes = $this->usuarioModelo->obtener_solicitudes_socios();
                        $this->vistaApi($solicitudes);
                    }else {
                        $this->vistaApi(false);
                    }

                }elseif ($action=="Denegar"){

                    if($this->usuarioModelo->eliminar_solicitud_socio($id_solicitud_soc)){
                        $solicitudes = $this->usuarioModelo->obtener_solicitudes_socios();
                        $this->vistaApi($solicitudes);
                    }else {
                        $this->vistaApi(false);
                    }
                }
                
            }else{
                $this->datos['solicitudes'] = $this->usuarioModelo->obtener_solicitudes_socios();
                $this->vista('usuarios/solicitudes_socio', $this->datos);
            }

        }


//---------------------------------------------------------Tienda

        public function inicio_usu_tienda(){   
            
            $this->datos['rolesPermitidos'] = [0,200]; 

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }
            
            $usuarios = $this->usuarioModelo->obtenerUsuariosActivos();
            
            $this->datos['usuarios'] = $usuarios;
            $this->datos['listaRoles'] = $this->usuarioModelo->obtenerRoles();
            $this->vista('usuarios/inicio_usu_tienda',$this->datos);

        }

        public function obtener_usuarios_equipacion(){
            $this->equipacionModelo = $this->modelo('Equipacion');

            $usuarios = $this->equipacionModelo->gente_para_equipacion();

            $this->vistaApi($usuarios);
        }

        public function gente_para_equipacion(){
            $this->datos['rolesPermitidos'] = [0,200]; 

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }

            $this->vista('usuarios/gente_para_equipacion', $this->datos);
        }
        
        public function equipacion(){

            //$this->socioModelo = $this->modelo('Socio');
            //$this->equipacionModelo = $this->modelo('Equipacion');
            
            $equipaciones = $this->equipacionModelo->obtenerEquipacion();

            $this->vistaApi($equipaciones);
        }

        public function equipacion_entregada(){
            $datos = $_POST;

            //$this->equipacionModelo = $this->modelo('Equipacion');

            $equipacion_entregada = $this->equipacionModelo->equipacion_entregada($datos);

            if ($equipacion_entregada) {                
                $this->vistaApi($this->equipacionModelo->obtenerEquipacion());
            }else{
                $this->vistaApi(false);
            }

        }

        public function add_pedido(){
            $datos = $_POST;

            //$this->equipacionModelo = $this->modelo('Equipacion');

            $add_pedido = $this->equipacionModelo->add_pedido($datos);

            if ($add_pedido) {               
                $this->vistaApi($this->equipacionModelo->gente_para_equipacion());
            }else{
                $this->vistaApi(false);
            }
        }

















        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        public function sesiones($id_usuario){
            $this->datos['rolesPermitidos'] = [0];          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                exit();
            }

            // En __construct() verificamos que se haya iniciado la sesion
            $sesiones = $this->usuarioModelo->obtenerSesionesUsuario($id_usuario);
            $usuario = $this->usuarioModelo->obtenerUsuarioId($id_usuario);

            // utilizamos $datos en lugar de $this->datos ya que no necesitamos los datos del usuario de sesion
            $datos['sesiones'] = $sesiones;
            $datos['usuario'] = $usuario;

            $this->vistaApi($datos);
        }


        public function cerrarSesion(){
            $this->datos['rolesPermitidos'] = [0];          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                exit();
            }
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id_sesion = $_POST['id_sesion'];
                
                $resultado = $this->usuarioModelo->cerrarSesion($id_sesion);

                unlink(session_save_path().'\\sess_'.$id_sesion);
                $this->vistaApi($resultado);
            }
        }


        
    }
