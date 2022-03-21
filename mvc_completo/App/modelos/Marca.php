<?php

    class Marca {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        public function obtenerMarcasId($id){
            $this->db->query("SELECT * FROM prueba_socio where id_socio=:id ORDER BY Id_prueba DESC LIMIT 5");
            $this->db->bind(':id',$id);
            return $this->db->registros();
        }
        

///////////////////////////////////////////////// Sesion //////////////////////////////////////////////

        public function obtenerSesionesUsuario($id){
            $this->db->query("SELECT * FROM sesiones 
                                        WHERE id_usuario = :id
                                        ORDER BY fecha_inicio");
            $this->db->bind(':id',$id);

            return $this->db->registros();
        }


        public function cerrarSesion($id_sesion){
            $this->db->query("UPDATE sesiones SET fecha_fin = NOW()  
                                    WHERE id_sesion = :id_sesion");

            $this->db->bind(':id_sesion',$id_sesion);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
    }