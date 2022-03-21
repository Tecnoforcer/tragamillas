<?php

    class Publico {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }


        public function Solicitud_Socio($datos){
            
            $this->db->query("INSERT INTO solicitud_socio ( Dni, nombre, apellido, CC, fecha_nac, email,  telefono) 
                                VALUES (  :Dni, :nombre, :apellido, :CC, :fecha_nac, :email, :telefono)");

            //vinculamos los valores
            $this->db->bind(':Dni',$datos['Dni']);
            $this->db->bind(':nombre',$datos['nombre']);
            $this->db->bind(':apellido',$datos['apellido']);
            $this->db->bind(':CC',$datos['CC']);
            $this->db->bind(':fecha_nac',$datos['fecha_nac']);
            $this->db->bind(':email',$datos['email']);
            $this->db->bind(':telefono',$datos['telefono']);
            
            //ejecutamos
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function add_externo($datos){
            //print_r($datos);exit;
            $this->db->query("INSERT INTO Externo (id_evento, nombre, apellido, dni, fecha_nac, telefono, email, CC, fecha_ini, fecha_fin) 
            VALUES (:id_evento, :nombre, :apellido, :dni, :fecha_nac, :telefono, :email, :CC, :fecha_ini, :fecha_fin)");

            //FALTAN DORSAL, MARCA   PROBLEMA AQUI
            $this->db->bind(':id_evento' ,$datos["id_evento"]);
            $this->db->bind(':nombre',$datos["nombre"]);
            $this->db->bind(':apellido',$datos["apellido"]);
            $this->db->bind(':dni',$datos["dni"]);
            $this->db->bind(':fecha_nac',$datos["fecha_nac"]);
            $this->db->bind(':telefono',$datos["telefono"]);
            $this->db->bind(':email',$datos["email"]);
            $this->db->bind(':CC',$datos["CC"]);
            $this->db->bind(':fecha_ini',$datos["fecha_ini"]);
            $this->db->bind(':fecha_fin',$datos["fecha_fin"]);

            //echo "llegamos al modelo";
            
            if($this->db->execute()){
                return $this->db->ultimoId();
            } else {
                return false;
            }
            
        }

        public function borrar_externo($id){
            $this->db->query("DELETE FROM Externo WHERE id_externo=:id_externo");

            $this->db->bind(':id_externo' ,$id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function add_solicitud_ev_externo($datos){
            $this->db->query("INSERT INTO solicitud_exter_evento (id_externo, id_evento, id_solicitud_evento, fecha) 
            VALUES (:id_externo, :id_evento, :id_solicitud_evento, CURDATE())");

            $this->db->bind(':id_externo',$datos['id_externo']);
            $this->db->bind(':id_evento',$datos['id_evento']);
            $this->db->bind(':id_solicitud_evento',$datos['id_solicitud_evento']);


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

        public function obtenerEntrenadores(){
            $this->db->query("SELECT * FROM User WHERE rol=5 AND activo=1");
            
            return $this->db->registros();
        }

    }