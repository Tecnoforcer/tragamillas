<?php

    class Publicos extends Controlador{

        public function __construct(){
            $this->publicoModelo = $this->modelo('Publico');

        }


        public function index(){
            $this->vista('inicio_no_logueado');

        }

        public function add_externo(){
            //echo "llegamos al controlador";
            $datos["id_evento"]=$_POST["id_evento"];
            $datos["nombre"]=$_POST["nombre_ext"];
            $datos["apellido"]=$_POST["apellido_ext"];
            $datos["dni"]=$_POST["Dni_ext"];
            $datos["email"]=$_POST["email_ext"];
            $datos["CC"]=$_POST["CC_ext"];
            $datos["fecha_nac"]=$_POST["fecha_nac_ext"];
            $datos["telefono"]=$_POST["telefono_ext"];
            $datos["fecha_ini"]=$_POST["Fecha_ini"];
            $datos["fecha_fin"]=$_POST["Fecha_fin"];

            $addExterno = $this->publicoModelo->add_externo($datos);
            //echo "devuelve algo";

            if ($addExterno) {
                $this->vistaApi($addExterno);
            } else {
                $this->vistaApi(false);
            } 
        }

        public function add_solicitud_ev_externo(){
            $datos["id_evento"]=$_POST["id_evento"];
            $datos["id_solicitud_evento"]=$_POST["id_evento"];
            $datos["id_externo"]=$_POST["id_externo"];
            
            $addSolicitudExternoEv = $this->publicoModelo->add_solicitud_ev_externo($datos); 

            if ($addSolicitudExternoEv) {
                $this->vistaApi(true);
            } else {
                $this->vistaApi(false);
            } 
        }

        public function obtener_eventos(){
            
            $datos["carreras"] =$this->publicoModelo->obtenerCarreras();
            $datos["cursos"] = $this->publicoModelo->obtenerCursos();
            $datos["entrenador"] = $this->publicoModelo->obtenerEntrenadores();

            $this->vistaApi($datos);
       }

        public function Solicitud_Socio(){
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                $datos['Dni']=$_POST["Dni"];
                $datos['nombre']=$_POST["nombre"];
                $datos['apellido']=$_POST["apellido"];
                $datos['CC']=$_POST["CC"];
                $datos['fecha_nac']=$_POST["fecha_nac"];
                $datos['email']=$_POST["email"];
                $datos['telefono']=$_POST["telefono"];
                
                //print_r($datos);

                if ($this->publicoModelo->Solicitud_Socio($datos)){
                    redireccionar('/');
                } else {
                    die('Algo ha fallado!!!');
                }
            }else{
                $this->vista('publicos/Solicitud_Socio');
            }
        }

        public function Inscripcion_eventos(){
            $this->vista('publicos/Inscripcion_eventos');
        }

    }