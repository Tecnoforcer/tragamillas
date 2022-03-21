<?php

    class Grupo {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        public function obtenerGrupos(){
            $this->db->query("SELECT * FROM Grupo");

            return $this->db->registros();
        }
        
        public function obtener_last_id(){
            $this->db->query("SELECT max(id_grupo) as last_id FROM Grupo");

            return $this->db->registro();
        }

        public function insert_grupo($id_gru,$nom_gru){
            $this->db->query("INSERT INTO Grupo (id_grupo, nombre) 
                                        VALUES (:id_gru,:nom_gru)");

            $this->db->bind(':id_gru',$id_gru);
            $this->db->bind(':nom_gru',$nom_gru);


            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
            

        }

        public function edit_grupo($id_gru,$nom_gru){
            $this->db->query("UPDATE Grupo SET nombre=:nom_gru WHERE id_grupo = :id_gru");

            $this->db->bind(':id_gru',$id_gru);
            $this->db->bind(':nom_gru',$nom_gru);


            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
            

        }

        public function obtenerAlumnosGrupo($id_gru){
           
            $this->db->query("SELECT * from Grupo,socio_pertenece_grupo,Socio, User 
                                WHERE Grupo.id_grupo=socio_pertenece_grupo.id_grupo 
                                AND socio_pertenece_grupo.id_socio=Socio.id_socio 
                                and Socio.id_socio=User.id_user and Grupo.id_grupo=:id_gru");//alumnos del grupo
            $this->db->bind(':id_gru',$id_gru);

            return $this->db->registros();
        }

        public function obtenerAlumno($id_user){
           
            $this->db->query("SELECT * from User
                                WHERE User.id_user =:id_user");//alumno seleccionado
            $this->db->bind(':id_user',$id_user);

            return $this->db->registros();
        }



        public function vacia_grupo_id($id_gru){
            $this->db->query("DELETE FROM socio_pertenece_grupo where id_grupo=:id_gru");

            $this->db->bind(':id_gru',$id_gru);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
            

        }


        public function obtener_grupo_id($id){
            $this->db->query("SELECT * from Grupo WHERE id_grupo =:id_grupo");

            $this->db->bind(':id_grupo',$id);

            if ($this->db->execute()) {
                return $this->db->registro();
            } else {
                return false;
            }
        }
       
        public function obtener_entrenador_grupo($id_grupo){
            $this->db->query("SELECT u.id_user, u.nombre, u.apellido FROM User u, Entrenador e, entrenador_grupo eg WHERE (u.id_user=e.id_entrenador AND e.id_entrenador=eg.id_entrenador) AND eg.id_grupo=:id_grupo");

            $this->db->bind(':id_grupo',$id_grupo);

            if ($this->db->execute()) {
                return $this->db->registros();
            } else {
                return false;
            }
        }


        public function desasignar_entrenadores_grupo($datos){
            $this->db->query("DELETE FROM entrenador_grupo WHERE id_grupo=:id_grupo");

            $this->db->bind(":id_grupo", $datos["id_grupo"]);

            $this->db->execute();
        }

        public function asignar_entrenadores_grupo($datos){
            
            $cadena = "";
            $ids = explode(",", $datos["ids_entrenadores"]);
            $id_grupo = $datos["id_grupo"];
            

            for ($i=0; $i < count($ids); $i++) { 
                $cadena.="(".$id_grupo.", ".$ids[$i].", CURDATE()), ";
            }
            
            $cadena = substr($cadena, 0, -2);

            $this->db->query("INSERT INTO entrenador_grupo VALUES ".$cadena);

            $this->db->execute();

        }

        public function vaciar_grupo($id_grupo){
            $this->db->query("DELETE FROM socio_pertenece_grupo WHERE id_grupo=:id_grupo");

            $this->db->bind(":id_grupo", $id_grupo);

            $this->db->execute();
        }







///////////////////////////////////////////////// Sesion //////////////////////////////////////////////

        // public function obtenerSesionesUsuario($id){
        //     $this->db->query("SELECT * FROM sesiones 
        //                                 WHERE id_usuario = :id
        //                                 ORDER BY fecha_inicio");
        //     $this->db->bind(':id',$id);

        //     return $this->db->registros();
        // }


        // public function cerrarSesion($id_sesion){
        //     $this->db->query("UPDATE sesiones SET fecha_fin = NOW()  
        //                             WHERE id_sesion = :id_sesion");

        //     $this->db->bind(':id_sesion',$id_sesion);

        //     if($this->db->execute()){
        //         return true;
        //     } else {
        //         return false;
        //     }
        // }
    }
