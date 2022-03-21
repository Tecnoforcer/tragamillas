<?php

    class Temporadas extends Controlador{

        public function __construct(){
            Sesion::iniciarSesion($this->datos);
            $this->datos['rolesPermitidos'] = [0,5,200];//edit this          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }

            //$this->usuarioModelo = $this->modelo('Usuario');
            //$this->equipacionModelo = $this->modelo('Equipacion');
            

            //$this->datos['menuActivo'] = 1;         // Definimos el menu que sera destacado en la vista
            
        }

        public function index(){
        
            //$this->datos['usuarios'] = $usuarios;
            
            $this->vista('temporadas/inicio',$this->datos);
            
        }



    }