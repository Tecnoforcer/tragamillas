<?php

    class Test {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        public function obtenerTestss(){
            $this->db->query("SELECT * FROM Test ORDER BY fecha desc");

            return $this->db->registros();
        }

        public function obtenerTestLast(){
            $this->db->query("SELECT id_test FROM Test ORDER BY id_test desc limit 1");

            return $this->db->registros();
        }

        public function guardarTest($id,$name,$datee){
            $this->db->query("INSERT INTO Test (id_test, Nombre, fecha) 
            VALUES (:idd, :namee, :datee)");

           
            $this->db->bind(':idd',$id);

            $this->db->bind(':namee',$name);
           
            $this->db->bind(':datee',$datee);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function editarTest($id,$name,$datee){
            $this->db->query("UPDATE Test SET Nombre=:namee, fecha=:datee
                                                WHERE id_test = :idd");

           
            $this->db->bind(':idd',$id);

            $this->db->bind(':namee',$name);
           
            $this->db->bind(':datee',$datee);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function obtenerTestById($id_test){
            $this->db->query("SELECT * FROM Test WHERE id_test=:test");

            $this->db->bind(':test',$id_test);

            return $this->db->registro();
        }
        

//random shet: si una funeraria entierra a los clientes que le hacen mala publicidad, estan solucionando el problema de la mala publicidad?

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