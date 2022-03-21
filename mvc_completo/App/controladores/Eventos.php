<?php

    class Eventos extends Controlador{

        public function __construct(){
            Sesion::iniciarSesion($this->datos);
            $this->datos['rolesPermitidos'] = [0];          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }

            $this->eventoModelo = $this->modelo('Evento');            

            $this->datos['menuActivo'] = 1;         // Definimos el menu que sera destacado en la vista
            
        }


        public function index(){
            //Obtenemos los usuarios
            $this->datos["entrenadores"] = $this->eventoModelo->obtener_entrenadores();
            $this->vista('eventos/inicio',$this->datos);
            // $this->vista('usuarios/inicioVue',$this->datos);
        }

        public function obtener_eventos(){
            
            $datos["carreras"] =$this->eventoModelo->obtener_carreras();
            $datos["cursos"] = $this->eventoModelo->obtener_cursos();
    
            

            $this->vistaApi($datos);
        }

        public function obtener_ultimo_id(){
            $datos["ultimo"] = $this->eventoModelo->obtener_ultimo_id();
            $this->vistaApi($datos);
        }

        public function editar_carrera(){

            $datos['id_evento']=$_POST['id_evento'];
            $datos['Nombre']=$_POST['Nombre'];
            $datos['Precio']=$_POST['Precio'];
            $datos['descuento']=$_POST['descuento'];
            $datos['fecha_ini']=$_POST['fecha_ini'];
            $datos['fecha_fin']=$_POST['fecha_fin'];
            $datos['fecha_ini_ins']=$_POST['fecha_ini_ins'];
            $datos['fecha_fin_ins']=$_POST['fecha_fin_ins'];


            $actualizarCarrera=$this->eventoModelo->editar_carrera($datos);
            $actualizarFechaIns=$this->eventoModelo->editar_fecha_ins($datos);


            if ($actualizarCarrera && $actualizarFechaIns) {
                $this->vistaApi(true);
            } else {
                $this->vistaApi(false);
            } 
        }

        public function editar_curso(){

            $datos['id_evento']=$_POST['id_evento'];
            $datos['Nombre']=$_POST['Nombre'];
            $datos['Precio']=$_POST['Precio'];
            $datos['id_entrenador']=$_POST['id_evento'];
            $datos['descuento']=$_POST['descuento'];
            $datos['fecha_ini']=$_POST['fecha_ini'];
            $datos['fecha_fin']=$_POST['fecha_fin'];


            $actualizarCarrera=$this->eventoModelo->editar_carrera($datos);


            if ($actualizarCarrera) {
                $this->vistaApi(true);
            } else {
                $this->vistaApi(false);
            } 
        }

        public function add_evento(){
            $datos['id_evento']=$_POST['id_evento'];
            $datos['Nombre']=$_POST['Nombre'];
            $datos['Precio']=$_POST['Precio'];
            $datos['Tipo']=$_POST['Tipo'];
            $datos['descuento']=$_POST['descuento'];
            $datos['fecha_ini']=$_POST['fecha_ini'];
            $datos['fecha_fin']=$_POST['fecha_fin'];
            $datos['fecha_ini_ins']=$_POST['fecha_ini_ins'];
            $datos['fecha_fin_ins']=$_POST['fecha_fin_ins'];
            


            if($datos['Tipo']=="curso"){
                $datos['id_entrenador']=$_POST['id_entrenador'];
            }


            $agregarEvento=$this->eventoModelo->add_evento($datos);
            $agregarSolicitud=$this->eventoModelo->add_soli_evento($datos);
    
            if ($agregarEvento && $agregarSolicitud) {
                $this->vistaApi(true);
            } else {
                $this->vistaApi(false);
            } 
        }

        public function borrar_evento(){
            $id_evento = $_POST["id_evento"];

            $borrarEvento=$this->eventoModelo->borrar_evento($id_evento);
    
            if ($borrarEvento) {
                $this->vistaApi(true);
            } else {
                $this->vistaApi(false);
            } 
        }       
        
    }