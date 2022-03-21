<?php

    class Evento {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }


        public function obtener_carreras(){
            $this->db->query("SELECT e.id_evento, e.Nombre, e.Tipo, e.Precio, e.descuento, e.fecha_ini, e.fecha_fin, s.fecha_ini as fecha_ini_ins, s.fecha_fin as fecha_fin_ins
            FROM Evento e, solicitud_evento s 
            WHERE e.tipo='carrera' AND e.id_evento=s.id_solicitud_evento");

            return $this->db->registros();
        }

        public function obtener_cursos(){
            $this->db->query("SELECT e.id_evento, e.id_entrenador, e.Nombre, e.Tipo, e.Precio, e.descuento, e.fecha_ini, e.fecha_fin, s.fecha_ini as fecha_ini_ins, s.fecha_fin as fecha_fin_ins
            FROM Evento e, solicitud_evento s 
            WHERE e.tipo='curso' AND e.id_evento=s.id_solicitud_evento");

            return $this->db->registros();
        }

        public function obtener_entrenadores(){
            $this->db->query("SELECT * FROM User WHERE rol=5 AND activo=1");
            
            return $this->db->registros();
        }

        public function obtener_ultimo_id(){
            $this->db->query("SELECT max(id_evento) as id_evento FROM Evento");            
            return $this->db->registro();
        }

        public function editar_fecha_ins($datos){
            $this->db->query("UPDATE solicitud_evento SET fecha_ini=:fecha_ini, fecha_fin=:fecha_fin
            WHERE id_solicitud_evento = :id_solicitud_evento");

            $this->db->bind(':id_solicitud_evento',$datos['id_evento']);
            $this->db->bind(':fecha_ini',$datos['fecha_ini_ins']);            
            $this->db->bind(':fecha_fin',$datos['fecha_fin_ins']);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function editar_carrera($datos){
            $this->db->query("UPDATE Evento SET Nombre=:Nombre, Precio=:Precio, descuento=:descuento, fecha_ini=:fecha_ini, fecha_fin=:fecha_fin
                                                WHERE id_evento = :id_evento");

            //vinculamos los valores
            $this->db->bind(':id_evento',$datos['id_evento']);
            $this->db->bind(':Nombre',$datos['Nombre']);
            $this->db->bind(':Precio',$datos['Precio']);
            $this->db->bind(':descuento',$datos['descuento']);
            $this->db->bind(':fecha_ini',$datos['fecha_ini']);            
            $this->db->bind(':fecha_fin',$datos['fecha_fin']);
            
            
            //ejecutamos
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function editar_curso($datos){
            
            $this->db->query("UPDATE Evento SET Nombre=:Nombre, id_entrenador = :id_entrenador Precio=:Precio, descuento=:descuento, fecha_ini=:fecha_ini, fecha_fin=:fecha_fin
                                                WHERE id_evento = :id_evento");

            //vinculamos los valores
            $this->db->bind(':id_evento',$datos['id_evento']);
            $this->db->bind(':id_entrenador',$datos['id_entrenador']);
            $this->db->bind(':Nombre',$datos['Nombre']);
            $this->db->bind(':Precio',$datos['Precio']);
            $this->db->bind(':descuento',$datos['descuento']);
            $this->db->bind(':fecha_ini',$datos['fecha_ini']);            
            $this->db->bind(':fecha_fin',$datos['fecha_fin']);
            
            
            //ejecutamos
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function add_evento($datos){
            $this->db->query("INSERT INTO Evento (id_evento, id_entrenador, Nombre, Tipo, Precio, descuento, fecha_ini, fecha_fin) 
                                VALUES (:id_evento, :id_entrenador, :Nombre, :Tipo, :Precio, :descuento, :fecha_ini, :fecha_fin)");

            $this->db->bind(':id_evento',$datos['id_evento']);    
            $this->db->bind(':Nombre',$datos['Nombre']);
            $this->db->bind(':Precio',$datos['Precio']);
            $this->db->bind(':Tipo',$datos['Tipo']);
            $this->db->bind(':descuento',$datos['descuento']);
            $this->db->bind(':fecha_ini',$datos['fecha_ini']);            
            $this->db->bind(':fecha_fin',$datos['fecha_fin']);
            if ($datos["Tipo"]=="carrera") {
                $this->db->bind(':id_entrenador',NULL);
            }else{
                $this->db->bind(':id_entrenador',$datos["id_entrenador"]);
            }
            
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }


        }

         public function add_soli_evento($datos){

            $this->db->query("INSERT INTO solicitud_evento(id_solicitud_evento, fecha_ini, fecha_fin) 
                                VALUES (:id_evento,:fecha_ini_ins,:fecha_fin_ins)");
            $this->db->bind(':id_evento',$datos['id_evento']);    
            $this->db->bind(':fecha_ini_ins',$datos['fecha_ini_ins']);            
            $this->db->bind(':fecha_fin_ins',$datos['fecha_fin_ins']);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }

         }

        

        public function borrar_evento($id_evento){
            $this->db->query("DELETE FROM Evento WHERE id_evento = :id_evento");
            $this->db->bind(':id_evento',$id_evento);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
       

    }