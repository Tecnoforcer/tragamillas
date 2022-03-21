<?php
//fuck

class Tests extends Controlador{

    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [5];


        $this->testModelo = $this->modelo('Test');
       
    }

    public function index(){

        //$this->datos['tests'] = $this->testModelo->obtenerTestss();
        //$this->datos['grupo']=$id_grupo;
        $this->vista('tests/inicio_tests',$this->datos);
            
    }
    public function obtenerTestss(){
        $tabl = $this->testModelo->obtenerTestss();

        $this->vistaApi($tabl);
    }

   public function guardar_tests(){
        $id=$this->testModelo->obtenerTestLast();
        $idd=$id[0]->id_test;
        $idd++;
        $name=$_POST["name"];
        $datee=$_POST["datee"];

        $this->testModelo->guardarTest($idd,$name,$datee);

   }

   public function editar_Test(){
    $name=$_POST["name"];
    $datee=$_POST["datee"];
    $id=$_POST["idd"];

    
    $this->testModelo->editarTest($id,$name,$datee);
        
   }


   public function obtener_test($test){

    $test=$this->testModelo->obtenerTestById($test);

    $this->vistaApi($test);

}













}