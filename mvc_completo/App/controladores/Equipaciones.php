<?php

    class Equipaciones extends Controlador{

        public function __construct(){
            Sesion::iniciarSesion($this->datos);
            $this->datos['rolesPermitidos'] = [10];          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }

            $this->equipacionModelo = $this->modelo('Equipacion');            

            $this->datos['menuActivo'] = 1;         // Definimos el menu que sera destacado en la vista
            

        }


        public function index(){
        }

        public function reloadd($id){
            
            $eqqq=$this->equipacionModelo->obtenerEquipacionessId($id);
            $this->vistaApi($eqqq);
        }
        public function insertarEquipacion(){
            $equipo =$this->equipacionModelo->obtenerUltimaEquipacion();

            foreach ($equipo as $info){
                $datos["id_equipacion"] = $equipo->id_equipacion +1;
            }
            $datos['id_user'] = $this->datos['usuarioSesion']->id_user;


            $insertarEqupacion=$this->equipacionModelo->insertarEquipacion($datos);
            
            //print_r($insertarEqupacion);
            //if ($insertarEqupacion) {
               // $this->vistaApi(true);
            //} else {
               // $this->vistaApi(false);
            //}
            //$datos["cursos"] = $this->equipacionModelo->obtener_cursos();

            $this->vistaApi($_POST);
        }

        

    }