<?php

    class Socio {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        public function obtenerUsuarios(){
            $this->db->query("SELECT * FROM User");

            return $this->db->registros();
        }
        public function obtenerUsuariosSocioss(){
            $this->db->query("SELECT id_user, nombre, apellido, CC, Dni, familiar  FROM User, Socio WHERE User.id_user=Socio.id_socio AND activo=1 ORDER BY apellido");

            return $this->db->registros();
        }
        public function obtenerEquipacionId($id){
            $this->db->query("SELECT * FROM equipacion WHERE id_user = :id");
            $this->db->bind(':id',$id);

            return $this->db->registro();
        }
        public function obtenerHorarioId($id){
            $this->db->query("SELECT horario.* 
                                FROM horario,horario_grupo,Grupo,socio_pertenece_grupo,Socio,User 
                                WHERE horario.id_horario=horario_grupo.id_horario 
                                    and horario_grupo.id_grupo=Grupo.id_grupo 
                                    and Grupo.id_grupo=socio_pertenece_grupo.id_grupo 
                                    and socio_pertenece_grupo.id_socio=Socio.id_socio 
                                    and Socio.id_socio=User.id_user 
                                    and User.id_user= :id
                                    and socio_pertenece_grupo.activo=1");

            $this->db->bind(':id',$id);

            return $this->db->registros();
        }

        public function vaciar_familiares($id_cabeza){
            $this->db->query("UPDATE Socio SET familiar = NULL WHERE familiar = :cabeza");
            
            $this->db->bind(':cabeza',$id_cabeza);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function asignar_familiares($ids, $id_cabeza){
           
            $this->db->query("UPDATE Socio SET familiar=:cabeza WHERE id_socio IN $ids");

            $this->db->bind(':cabeza',$id_cabeza);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function obtenerCarreras(){
            $this->db->query("SELECT * FROM Evento WHERE tipo='carrera'");

            return $this->db->registros();
        }
        
        public function obtenerCursos(){
            $this->db->query("SELECT ev.id_evento, ev.id_entrenador, ev.Nombre as nombre_evento, ev.Tipo, ev.Precio, ev.Descuento, ev.fecha_ini, ev.fecha_fin, u.nombre, u.apellido 
            FROM Evento ev, Entrenador e, User u 
            WHERE (ev.id_entrenador=e.id_entrenador AND e.id_entrenador=u.id_user) AND ev.Tipo='curso';");

            return $this->db->registros();
        }
        public function obtenerGrupos(){
            $this->db->query("SELECT g.id_grupo, g.nombre as nombre_grupo FROM Grupo g");

            return $this->db->registros();
        }
        
        public function obtenerEntrenadores(){
            $this->db->query("SELECT * FROM User WHERE rol=5 AND activo=1");
            
            return $this->db->registros();
        }

        public function anadirLinea($datos){
            //print_r($datos);
             $this->db->query("INSERT INTO socio_pertenece_grupo (id_grupo, id_socio, Fecha, aceptado, activo) 
                                    VALUES (:id_grupo, :id_socio, CURDATE(), 0, 0)");
            
            $this->db->bind(':id_grupo',$datos['id_grupo']);    
            $this->db->bind(':id_socio',$datos['id_socio']);


            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function subirFoto($ruta, $id){
            $this->db->query("UPDATE User SET img=:img WHERE id_user=:id_user");

            $this->db->bind(':img', $ruta);
            $this->db->bind(':id_user', $id);
            
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }

        }
        
        public function comprobarSolicitudExistente($datos){
            $this->db->query("SELECT * FROM socio_pertenece_grupo WHERE id_socio=:id_socio AND id_grupo=:id_grupo AND activo=0");


            $this->db->bind(':id_socio',$datos['id_socio']);
            $this->db->bind(':id_grupo',$datos['id_grupo']);    

            
            return $this->db->registro();
        }
        
        public function anadirLineaCarrera($datos){
            print_r ($datos);
             $this->db->query("INSERT INTO solicitud_socio_evento(id_socio, id_evento, id_solicitud_evento, fecha, activo, aceptado) 
                                        VALUES (:id_socio, :id_evento, :id_solicitud_evento, CURDATE(), 0, 0)");


            $this->db->bind(':id_socio',$datos['id_socio']);
            $this->db->bind(':id_evento',$datos['id_evento']);    
            $this->db->bind(':id_solicitud_evento',$datos['id_solicitud_evento']);


            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        



        //-----------------------------------------------------------------------------Fecha de inscripcion de un socio
        public function obtenerFecha($datos){
            $this->db->query("SELECT Fecha FROM socio_pertenece_grupo WHERE id_grupo = :id_grupo and id_socio= :id_socio ORDER BY id DESC LIMIT 1");
            $this->db->bind(':id_grupo',$datos['id_grupo']);
            $this->db->bind(':id_socio',$datos['id_socio']);
            return $this->db->registros();
        }

        
        public function infoEvento(){
            $this->db->query("SELECT * FROM solicitud_evento");
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