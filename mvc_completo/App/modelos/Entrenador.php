<?php

    class Entrenador {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        public function obtenerGruposEntrendor($id_usu){
            $this->db->query("SELECT Grupo.id_grupo, Grupo.nombre FROM Entrenador, entrenador_grupo, Grupo WHERE Grupo.id_grupo=entrenador_grupo.id_grupo and entrenador_grupo.id_entrenador=Entrenador.id_entrenador and Entrenador.id_entrenador=:id_usu");
            
            $this->db->bind(':id_usu',$id_usu);

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
