<?php

    class Pruebas extends Controlador{

        public function __construct(){
            Sesion::iniciarSesion($this->datos);
            $this->datos['rolesPermitidos'] = [0,5];

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }


            $this->pruebaModelo = $this->modelo('Prueba');
            $this->marcaModelo = $this->modelo('Marca');
            $this->usuarioModelo = $this->modelo('Usuario');
            $this->grupoModelo = $this->modelo('Grupo');

        }

        public function index($id_grupo){

            $this->datos['tests'] = $this->pruebaModelo->obtener_alumnos_grupo($id_grupo);
            $this->datos['grupo']= $this->grupoModelo->obtener_grupo_id($id_grupo);
            $this->datos['entrenador'] = $this->grupoModelo->obtener_entrenador_grupo($id_grupo);
            $this->vista('pruebas/inicio_prueba',$this->datos);
                
        }

        public function obtener_socios_test($id_user){
            $last_fecha_raw= $this->pruebaModelo->obtener_last_prueba($id_user);
            
            $datos[0] = $this->pruebaModelo->obtenerUsuarioPrueba($id_user);

           
            if ($last_fecha_raw != NULL) {
                $last_test_dig=$last_fecha_raw[0]->Fecha;
                $datos[1] = $this->pruebaModelo->TESTZONE1($id_user,$last_test_dig);
            }else{
                $datos[1]=[];
            }
            
            $this->vistaApi($datos);
        }

        public function prueba_nueva($id_user,$id_grupo){
            

            $this->datos['usuarioTest'] = $this->pruebaModelo->obtenerUsuarioPrueba($id_user);
            $this->datos['prueba_to_grupo']=$id_grupo;
            $this->vista('pruebas/prueba_nueva',$this->datos);
        }

        public function obtener_entrenadores(){
            
            $entrenadores = $this->usuarioModelo->obtener_entrenadores();

            $this->vistaApi($entrenadores);

        }

        public function mostrar_prueba($id_user){
            

            $this->datos['usuarioTest'] = $this->marcaModelo->obtenerMarcasId($id_user);
            $this->datos['Usuario'] =$this->usuarioModelo->obtenerUsuarioId($id_user);
            $this->datos['pruebas'] = $this->pruebaModelo->obtenerPruebas();
            $this->vista('pruebas/mostrar_prueba',$this->datos);
        }

        public function obtener_pruebas(){
            $pruebas = $this->pruebaModelo->obtenerPruebas();
            

            $this->vistaApi($pruebas);
        }

        public function obtener_tests(){
            $tests = $this->pruebaModelo->obtenerTestss();
            
            $this->vistaApi($tests);
        }

        public function modificar_entrenadores_grupo(){
            $datos = $_POST;

            $this->grupoModelo->desasignar_entrenadores_grupo($datos);

            $this->grupoModelo->asignar_entrenadores_grupo($datos);
            
        }

        public function vaciar_grupo(){
            $id_grupo = $_POST["id_grupo"];

            $this->grupoModelo->vaciar_grupo($id_grupo);
        }

        public function cambiar_nombre_grupo(){
            $nombre_grupo = $_POST["nombre_grupo"];
            $id_grupo =  $_POST["id_grupo"];

            $cambio = $this->grupoModelo->edit_grupo($id_grupo, $nombre_grupo);

            if ($cambio) {
                $this->vistaApi(true);
            }else{
                $this->vistaApi(false);
            }

        }

        public function guardar_pruebas(){
            $datos_pruebas=json_decode($_POST["datos"]);
            $user=$_POST["user"];
            $test_raw=$_POST["test"];
            $test_arr=explode("_",$test_raw);
            
            

            foreach ($datos_pruebas as $prueba) {
                if (isset($prueba)) {
                    if ($test_arr[0] == "nil") {
                        //echo $test_arr[0]."++".$prueba[0]."--".$prueba[1];
                         $this->pruebaModelo->insert_prueba($test_arr[1],$prueba[0],$prueba[1],$user);
                    }else{
                         $this->pruebaModelo->insert_prueba_test($test_arr[1],$prueba[0],$prueba[1],$user);
                    }
                     

                }
            }
            
            //$this->vistaApi($datos_response);
        }













    }