<?php

    class Facturas extends Controlador{

        public function __construct(){
            Sesion::iniciarSesion($this->datos);
            $this->datos['rolesPermitidos'] = [0];          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }

            $this->facturaModelo = $this->modelo('Factura');
            $this->SocioModelo = $this->modelo('Socio');
        }

        public function index(){
           

            $this->datos['facturas'] = $facturas;
            
            $this->vista('facturas/inicio_facturacion',$this->datos);
                
        }

        public function obtener_socios_factura(){
            $usuarios = $this->facturaModelo->obtener_socios_factura();
            
            if (count($usuarios) > 0) {
                $this->vistaApi($usuarios);
            }else{
                $this->vistaApi("nil");
            }
            
            
        }

        public function genereateCSV(){
            $user_x_importe=json_decode($_POST["usuarios_x_importe"]);
            $formatttt=["codigo"=>"Codigo","nombre"=>"Nombre Deudor","CC"=>"IBAN","Importe"=>"importe","nif_cif"=>"NIF-CIF","concepto"=>"Linea 1 (70 caracteres)","concepto_aux"=>"Linea 2  (70 caracteres)","t_adeudo"=>"T.Adeudo","F_firma"=>"F.Firma","titular_opt"=>"Titular de la cuenta cuando sea distinto del recibo -Opcional-","domicilio"=>"Domicilio  -Opcional -","cod_postal"=>"Cód.Postal","poblacion"=>"Poblacion","provincia"=>"Provincia"];
            $delimiter=";";
            $filename = "export_cuota_socio.csv";
            
            if (file_exists($filename)) {
                unlink($filename);
                //return false;
            }
            //header('Content-Type: application/csv');
            //header('Content-Disposition: attachment; filename="'.$filename.'";');
            $f = fopen($filename, 'w');

    
            //$users="aaa";
            $users=$this->SocioModelo->obtenerUsuariosSocioss();


            $importe=100;
            $concepto1="CUOTA SOCIO TRAGAMILLAS";
            $t_adeudo="RCUR";
            $f_firma=date("Y-m-d");

            $csv_ARR[0]=$formatttt;
            $cont=1;
            foreach ($users as $usu) {
                for ($i=0; $i < count($user_x_importe); $i++) { 
                    if ($usu->Dni == $user_x_importe[$i][0]){
                        $importe=intval($user_x_importe[$i][1]);
                    }
                }
                $nom_deudor=$usu->apellido.", ".$usu->nombre;
                $nom_deudor=strtoupper($nom_deudor);

                $last_I_cuota_id_raw=$this->facturaModelo->getLastId();
                $last_I_cuota_id=$last_I_cuota_id_raw->id_cuota;
                $last_I_cuota_id++;
                
                $this->facturaModelo->insertCuota($last_I_cuota_id,$usu->id_user,$f_firma,$concepto1,$importe,$t_adeudo);
                //$id_cuota,$id_user,$fechaa,$concepto,$importe,$tipo

                $formated_usu_for_CSV=["codigo"=>$last_I_cuota_id,"nombre"=>$nom_deudor,"CC"=>$usu->CC,"Importe"=>$importe,
                "nif_cif"=>"NIF-CIF","concepto"=>$concepto1,"concepto_aux"=>"","t_adeudo"=>$t_adeudo,
                "F_firma"=>$f_firma,"titular_opt"=>"",
                "domicilio"=>"","cod_postal"=>"","poblacion"=>"","provincia"=>""];
                $csv_ARR[$cont]=$formated_usu_for_CSV;
                $cont++;
            }



            foreach ($csv_ARR as $line) {
                fputcsv($f, $line, $delimiter);
            }
            
        }

        //obtener datos usu aktiv, create CSV, insert data into I_cuotas

    }