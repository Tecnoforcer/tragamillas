<?php

    class Factura {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        public function getLastId(){
            $this->db->query("SELECT max(id_ingreso_cuota) as id_cuota FROM I_cuotas");            
            return $this->db->registro();
        }

        public function insertCuota($id_ingreso_cuota,$id_socio,$Fecha,$Concepto,$Importe,$Tipo){
            $this->db->query("INSERT INTO I_cuotas (id_ingreso_cuota, id_socio, Fecha, Concepto, Importe, Tipo) 
            VALUES (:id_ingreso_cuota, :id_socio, :Fecha, :Concepto, :Importe, :Tipo)");

            $this->db->bind(':id_ingreso_cuota',$id_ingreso_cuota);
            $this->db->bind(':id_socio',$id_socio);
            $this->db->bind(':Fecha',$Fecha);
            $this->db->bind(':Concepto',$Concepto);
            $this->db->bind(':Importe',$Importe);
            $this->db->bind(':Tipo',$Tipo);
            
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function obtener_socios_factura(){
            $this->db->query("SELECT u.id_user, u.Dni, u.nombre, u.apellido, u.CC, u.fecha_nac, u.email, u.rol, u.telefono, u.activo, s.familiar  FROM User u, Socio s WHERE u.id_user=s.id_socio AND u.activo=1");

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
