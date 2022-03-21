<?php

    class Inicio extends Controlador{

        public function __construct(){

        }

        public function index(){
            if (Sesion::sesionCreada($this->datos)){

                if ($this->datos['usuarioSesion']->rol==0) {
                    $this->vista('/inicios/admin_inc',$this->datos);

                } elseif ($this->datos['usuarioSesion']->rol==5) {
                    $this->vista('/inicios/entrenador_inc',$this->datos);

                }elseif ($this->datos['usuarioSesion']->rol==10) {
                    //$this->vista('/socios/inicio',$this->datos);
                    redireccionar('/socios');

                }elseif ($this->datos['usuarioSesion']->rol==200){
                    $this->vista('/inicios/tienda_inc',$this->datos);
                }

            } else {
                redireccionar('/Publicos');
            }
        }

    }
