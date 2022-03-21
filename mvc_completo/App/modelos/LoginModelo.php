<?php

    class LoginModelo {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }


        public function loginEmail($email,$pass){
            $this->db->query("SELECT * FROM User WHERE email = :email and pass = CONCAT('*', UPPER(SHA1(UNHEX(SHA1(:pass)))))");
            $this->db->bind(':email',$email);
            $this->db->bind(':pass',$pass);
            

            return $this->db->registro();
        }


        // public function registroSesion($id_usuario){
        //     $this->db->query("INSERT INTO sesiones (id_sesion, id_usuario, fecha_inicio) 
        //                                 VALUES (:id_sesion, :id_usuario, NOW())");

        //     $this->db->bind(':id_sesion',session_id());
        //     $this->db->bind(':id_usuario',$id_usuario);

        //     if($this->db->execute()){
        //         return true;
        //     } else {
        //         return false;
        //     }
        // }


        // public function registroFinSesion($id_usuario){
        //     $this->db->query("UPDATE sesiones SET fecha_fin = NOW()  
        //                             WHERE id_usuario = :id_usuario AND id_sesion = :id_sesion");

        //     $this->db->bind(':id_sesion',session_id());
        //     $this->db->bind(':id_usuario',$id_usuario);

        //     if($this->db->execute()){
        //         return true;
        //     } else {
        //         return false;
        //     }
        // }
    }
