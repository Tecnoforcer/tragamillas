<?php

    class Grupos extends Controlador{

        public function __construct(){
            Sesion::iniciarSesion($this->datos);
            $this->datos['rolesPermitidos'] = [0,5];

            $this->grupoModelo = $this->modelo('Grupo');
            
        }

        public function index(){

            $this->datos['rolesPermitidos'] = [0];

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }else{
            $this->vista('grupos/inicio_grupos',true);
            }  
        }

        public function add_grupo(){
            $namee=$_POST["namee"];
            
            $id_last=$this->grupoModelo->obtener_last_id();
            $id_new=$id_last->last_id +1;

            
            if ($this->grupoModelo->insert_grupo($id_new,$namee)) {
                
                $this->vistaApi(TRUE);
            } else {
                $this->vistaApi(FALSE);
            }
        }

        public function edit_grupo(){
            $namee=$_POST["namee"];
            $idd=$_POST["idd"];
            
            

            
            if ($this->grupoModelo->edit_grupo($idd,$namee)) {
                

                $this->vistaApi(TRUE);
            } else {
                $this->vistaApi(FALSE);
            }
        }

        public function obtener_gruposs(){
            
            $datosGrupo=$this->grupoModelo->obtenerGrupos();
            

            $this->vistaApi($datosGrupo);
            
        }


        public function vaciar_grupos(){
            $id_gru=$_POST["id_grupo"];

            if ($this->grupoModelo->vacia_grupo_id($id_gru)) {
                

                $this->vistaApi(TRUE);
            } else {
                $this->vistaApi(FALSE);
            }
        }

        

        
        
    }