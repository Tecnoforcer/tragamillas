<?php

    class Usuario {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }
        
        public function obtenerUsuarios(){
            $this->db->query("SELECT * FROM User");

            return $this->db->registros();
        }

        public function obtenerUsuariosPaginacion($limitt,$startt){
            $this->db->query("SELECT * FROM User WHERE activo=1 ORDER BY rol, apellido  LIMIT :startt, :limitt");

            $this->db->bind(':startt',$startt);  
            $this->db->bind(':limitt',$limitt); 

                       

            return $this->db->registros();//ffs: problem here
        }

        public function obtenerUsuariosActivos(){
            $this->db->query("SELECT * FROM User WHERE activo=1");

            return $this->db->registros();
        }

        public function obtenerRoles(){
            $this->db->query("SELECT * FROM Rol");

            return $this->db->registros();
        }

        public function obtenerUltimoId(){
            $this->db->query("SELECT max(id_user) as id_user FROM User");            
            return $this->db->registro();
        }


        public function agregarUsuario($datos){
            $this->db->query("INSERT INTO User (id_user, nombre, apellido, Dni, pass, email, CC, fecha_nac, telefono, rol) 
                                        VALUES (:id_user, :nombre, :apellido, :Dni, CONCAT('*', UPPER(SHA1(UNHEX(SHA1(:pass))))), :email, :CC, :fecha_nac, :telefono, :id_rol)");

            //vinculamos los valores
            $this->db->bind(':id_user',$datos['id_user']);
            $this->db->bind(':nombre',$datos['nombre']);
            
            if($datos['rol']==200){
                $this->db->bind(':apellido',NULL);
                $this->db->bind(':fecha_nac',NULL);   
                
            }else{
                $this->db->bind(':fecha_nac',$datos['fecha_nac']);
                $this->db->bind(':apellido',$datos['apellido']);
                
            }

            $this->db->bind(':Dni',$datos['Dni']);
            $this->db->bind(':pass',$datos['Dni']);
            $this->db->bind(':email',$datos['email']);
            $this->db->bind(':CC',$datos['CC']);
            
            $this->db->bind(':telefono',$datos['telefono']);
            $this->db->bind(':id_rol',$datos['rol']);

            //echo "llegamos";exit();

            //ejecutamos
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }


        public function obtenerUsuarioId($id){
            $this->db->query("SELECT * FROM User WHERE id_user = :id");
            $this->db->bind(':id',$id);

            return $this->db->registro();
        }

        public function obtenerSueldoEntrenador($id_entrenador){
            $this->db->query("SELECT sueldo FROM Entrenador WHERE id_entrenador = :id_entrenador");
            $this->db->bind(':id_entrenador',$id_entrenador);

            return $this->db->registro();
        }

        public function actualizarUsuario($datos){
            
            $this->db->query("UPDATE User SET nombre=:nombre, apellido=:apellido, Dni=:Dni, email=:email, CC=:CC, fecha_nac=:fecha_nac, telefono=:telefono
                                                WHERE id_user = :id");

            //vinculamos los valores
            $this->db->bind(':id',$datos['id_user']);
            $this->db->bind(':nombre',$datos['nombre']);
            
            if($datos['rol'] != 200){   
                $this->db->bind(':fecha_nac',$datos['fecha_nac']);
                $this->db->bind(':apellido',$datos['apellido']);
            }else{
                
                $this->db->bind(':apellido',NULL);
                $this->db->bind(':fecha_nac',NULL);
            }


            $this->db->bind(':Dni',$datos['Dni']);
            $this->db->bind(':email',$datos['email']);            
            $this->db->bind(':CC',$datos['CC']);
            
            $this->db->bind(':telefono',$datos['telefono']);

            //ejecutamos
            if($this->db->execute()){
                
                return true;
            } else {
                return false;
            }
        }

        public function obtener_entrenadores(){
            $this->db->query("SELECT u.id_user, u.nombre, u.apellido FROM User u, Entrenador e WHERE u.id_user=e.id_entrenador");

            return $this->db->registros();
        }

        public function actualizarEntrenador($datos){
            $this->db->query("UPDATE Entrenador SET sueldo=:sueldo WHERE id_entrenador = :id_entrenador");

            $this->db->bind(':id_entrenador',$datos['id_user']);
            $this->db->bind(':sueldo',$datos['sueldo']);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function actualizarTienda($datos){
            $this->db->query("UPDATE Otras_entidades SET nombre=:nombre, NIF=:NIF WHERE Id_entidad = :Id_entidad");

            $this->db->bind(':Id_entidad',$datos['id_user']);
            $this->db->bind(':nombre',$datos['nombre']);
            $this->db->bind(':NIF',$datos['Dni']);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function cambiar_pass($datos){
            echo $this->db->query("UPDATE User SET pass=CONCAT('*', UPPER(SHA1(UNHEX(SHA1(:pass))))) WHERE id_user = :id_user");

            //$sql="SELECT * FROM Usuario WHERE dni_usuario=\"$usuario\" and pass_usuario = CONCAT('*', UPPER(SHA1(UNHEX(SHA1('$clave')))))";

            $this->db->bind(':id_user',$datos['id_user']);
            $this->db->bind(':pass',$datos['pass']);
            
            
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function bajaUsuario($id){
            $this->db->query("UPDATE User SET activo=0 WHERE id_user = :id");
            $this->db->bind(':id',$id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }


        public function borrarUsuario($id){
            $this->db->query("DELETE FROM usuarios WHERE id_user = :id");
            $this->db->bind(':id',$id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function obtener_solicitudes_socios(){
            $this->db->query("SELECT * FROM solicitud_socio WHERE aceptada=0");

            return $this->db->registros();
        }

 
        public function obtener_solicitudes_grupos($id){
            $this->db->query("SELECT u.id_user, u.Dni, u.nombre, u.apellido, u.fecha_nac, u.email, u.telefono, spg.fecha as fecha_sol
            FROM User u, Socio s, socio_pertenece_grupo spg, Grupo g 
            WHERE (u.id_user=s.id_socio AND s.id_socio=spg.id_socio AND spg.id_grupo=g.id_grupo) AND spg.id_grupo=:id_grupo AND spg.aceptado=0 AND spg.activo=0");
            
            $this->db->bind(':id_grupo', $id);

            return $this->db->registros();
        }

        public function obtener_solicitudes_eventos_soc($id){
            $this->db->query("SELECT u.id_user, u.Dni, u.nombre, u.apellido, u.fecha_nac, u.email, u.telefono 
            FROM User u, Socio s, solicitud_socio_evento sse
            WHERE (u.id_user=s.id_socio AND s.id_socio=sse.id_socio) AND sse.id_evento=:id_evento
            AND sse.activo=0 AND sse.aceptado=0");

            $this->db->bind(':id_evento', $id);

            return $this->db->registros();
        }

        public function obtener_solicitudes_eventos_ext($id){
            $this->db->query("SELECT e.id_externo, e.dni as Dni, e.nombre, e.apellido, e.fecha_nac, e.email, e.telefono 
            FROM Externo e, solicitud_exter_evento see
            WHERE e.id_externo=see.id_externo AND see.id_evento=:id_evento AND see.activo=0 AND see.aceptado=0");

            $this->db->bind(':id_evento', $id);

            return $this->db->registros();
        }

        public function recuperarPass($to, $pass){
            $this->db->query("UPDATE User SET pass=CONCAT('*', UPPER(SHA1(UNHEX(SHA1(:pass))))) WHERE email = :email");

            $this->db->bind(':email', $to);
            $this->db->bind(':pass', $pass);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function obtener_datos_solicitud($id_solicitud_soc){
            $this->db->query("SELECT * FROM solicitud_socio WHERE id_solicitud_soc=:id_solicitud_soc");
            $this->db->bind(':id_solicitud_soc', $id_solicitud_soc);

            return $this->db->registro();
        }

        public function aceptar_solicitud_socio($id_solicitud_soc){
            $this->db->query("UPDATE solicitud_socio SET aceptada=1 WHERE id_solicitud_soc = :id_solicitud_soc");
            $this->db->bind(':id_solicitud_soc',$id_solicitud_soc);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function aceptar_solicitud_evento_socio($datos){
            //print_r($datos);
            $this->db->query("UPDATE solicitud_socio_evento SET activo=1, aceptado=1  
            WHERE id_socio = :id_socio AND id_evento=:id_evento AND id_solicitud_evento=:id_solicitud_evento");
            
            
            $this->db->bind(':id_socio', $datos["id_participante"]);
            $this->db->bind(':id_evento', $datos["id_solicitud"]);
            $this->db->bind(':id_solicitud_evento', $datos["id_solicitud"]);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function aceptar_solicitud_evento_externo($datos){
            //print_r($datos);
            $this->db->query("UPDATE solicitud_exter_evento SET activo=1, aceptado=1  
            WHERE id_externo = :id_externo AND id_evento=:id_evento AND id_solicitud_evento=:id_solicitud_evento");
            
            
            $this->db->bind(':id_externo', $datos["id_participante"]);
            $this->db->bind(':id_evento', $datos["id_solicitud"]);
            $this->db->bind(':id_solicitud_evento', $datos["id_solicitud"]);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function aceptar_solicitud_grupo($datos){
            //print_r($datos);exit;
            $this->db->query("UPDATE socio_pertenece_grupo SET activo=1, aceptado=1
            WHERE id_grupo=:id_grupo AND id_socio=:id_socio AND Fecha=:Fecha");

            $this->db->bind(':id_socio', $datos["id_participante"]);
            $this->db->bind(':id_grupo', $datos["id_solicitud"]);
            $this->db->bind(':Fecha', $datos["fecha_sol"]);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function rechazar_solicitud_evento_socio($datos){
            //print_r($datos);
            $this->db->query("DELETE FROM solicitud_socio_evento WHERE id_socio = :id_socio AND id_evento=:id_evento AND id_solicitud_evento=:id_solicitud_evento");
            
            
            $this->db->bind(':id_socio', $datos["id_participante"]);
            $this->db->bind(':id_evento', $datos["id_solicitud"]);
            $this->db->bind(':id_solicitud_evento', $datos["id_solicitud"]);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function rechazar_solicitud_evento_externo($datos){
            //print_r($datos);
            $this->db->query("DELETE FROM solicitud_exter_evento  
            WHERE id_externo = :id_externo");
            
            
            $this->db->bind(':id_externo', $datos["id_participante"]);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function rechazar_solicitud_grupo($datos){
            //print_r($datos);
            $this->db->query("DELETE FROM socio_pertenece_grupo  
            WHERE id_socio = :id_socio AND id_grupo=:id_grupo AND Fecha=:Fecha");


            $this->db->bind(':id_socio', $datos["id_participante"]);
            $this->db->bind(':id_grupo', $datos["id_solicitud"]);
            $this->db->bind(':Fecha', $datos["fecha_sol"]);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function agregar_socio($id_socio){
            $this->db->query("INSERT INTO Socio (id_socio) VALUES (:id_socio)");
            $this->db->bind(':id_socio',$id_socio);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function eliminar_solicitud_socio($id_solicitud_soc){
            $this->db->query("DELETE FROM solicitud_socio WHERE id_solicitud_soc = :id_solicitud_soc");
            $this->db->bind(':id_solicitud_soc',$id_solicitud_soc);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function agregar_entrenador($datos){
            $this->db->query("INSERT INTO Entrenador (id_entrenador, sueldo) VALUES (:id_entrenador, :sueldo)");
            
            $this->db->bind('id_entrenador',$datos["id_user"]);
            $this->db->bind('sueldo',$datos['sueldo']);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function agregar_otra_entidad($datos){
            $this->db->query("INSERT INTO Otras_entidades (Id_entidad, nombre, NIF) VALUES (:Id_entidad, :nombre, :NIF)");

            $this->db->bind(':Id_entidad',$datos["id_user"]);
            $this->db->bind(':nombre',$datos["nombre"]);
            $this->db->bind(':NIF', $datos["Dni"]);


            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        


        

///////////////////////////////////////////////// Sesion //////////////////////////////////////////////

        public function obtenerSesionesUsuario($id){
            $this->db->query("SELECT * FROM sesiones 
                                        WHERE id_user = :id
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
