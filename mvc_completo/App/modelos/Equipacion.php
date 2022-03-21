<?php

    class Equipacion {
        
        private $db;

        public function __construct(){
            $this->db = new Base;
        }
        
        public function obtenerEquipacionId($id){
            $this->db->query("SELECT * FROM equipacion WHERE id_user = :id");
            $this->db->bind(':id',$id);

            return $this->db->registro();
        }
        
        public function obtenerEquipacionessId($id){
            $this->db->query("SELECT * FROM equipacion WHERE id_user = :id");
            $this->db->bind(':id',$id);

            return $this->db->registros();
        }

        public function equipacion_entregada($datos){
            $this->db->query("UPDATE equipacion SET recogido = 1, talla = :talla WHERE id_equipacion = :id_equipacion");

            $this->db->bind(":talla",$datos["talla"]);
            $this->db->bind(":id_equipacion",$datos["id_equipacion"]);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

//-----------------------------------------------------Teinda

    public function obtenerEquipacion(){
        $this->db->query("SELECT e.id_equipacion, u.nombre, u.apellido, u.Dni as dni, e.id_ingreso_cuota, e.id_gastos, e.talla, e.fecha_peticion, e.tipo FROM equipacion e, User u WHERE e.id_user=u.id_user AND recogido=0");
        
        return $this->db->registros();
    }

    public function obtenerUsu(){
        $this->db->query("SELECT * FROM User");
        return $this->db->registros();
    }


    public function gente_para_equipacion(){
        $this->db->query("SELECT id_user, Dni as dni, nombre, apellido, rol FROM User WHERE (rol=5 OR rol=10) AND activo=1 ORDER BY apellido");

        return $this->db->registros();
    }



//-----------------------------------------------------insertar Equipacion

        public function obtenerUltimaEquipacion(){
            $this->db->query("SELECT * FROM equipacion ORDER BY id_equipacion DESC LIMIT 1");

            return $this->db->registro();
        }


        public function add_pedido($datos){
            $this->db->query("INSERT INTO equipacion ( id_user, id_ingreso_cuota, id_gastos, talla, fecha_peticion, tipo) 
                                VALUES (:id_user,null,null,:talla,CURDATE(),:tipo)");

            
            $this->db->bind(':id_user',$datos['id_user']);
            $this->db->bind(':talla', $datos["talla"]);
            $this->db->bind(':tipo', $datos["tipo"]);


            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        
    }
        
