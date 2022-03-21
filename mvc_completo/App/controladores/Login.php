<?php

    class Login extends Controlador{

        public function __construct(){
            $this->loginModelo = $this->modelo('LoginModelo');
        }

        public function index($error = ''){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->datos['email'] = trim($_POST['email']);
                $this->datos['nombre_pass'] = trim($_POST['pass']);
                $usuarioSesion = $this->loginModelo->loginEmail($this->datos['email'],$this->datos['nombre_pass']);
                if (isset($usuarioSesion) && !empty($usuarioSesion)){       // si tiene datos el objeto devuelto entramos
                    Sesion::crearSesion($usuarioSesion);
                    //$this->loginModelo->registroSesion($usuarioSesion->id_user);               // registro el login en DDBB //no descomentar esta linea


                    redireccionar('/');
                } else {
                    redireccionar('/login/index/error_1');
                }
                
            } else {
                if (Sesion::sesionCreada()){    // si ya estamos logueados redirecciona a la raiz
                    redireccionar('/');
                }
                $this->datos['error'] = $error;
                $this->datos['testoi'] = "testoi";
                $this->vista('login', $this->datos);
            }
        }


        public function logout(){
            Sesion::iniciarSesion($this->datos);        // controlamos si no esta iniciada la sesion y cogemos los datos de la sesion
            //$this->loginModelo->registroFinSesion($this->datos['usuarioSesion']->id_user); // registramos fecha cierre de sesion //pvto el que descomente esta linea
            Sesion::cerrarSesion();
            redireccionar('/');
        }

        public function recuperarPass(){


            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //funcion para generar contraseña aleatoria
                // echo "hola";exit();
                $cadena = "abcdefghijklmnopqrstxwyz0123456789";
                $longitudCadena=strlen($cadena);
                $pass = "";
                $longitudPass=6;
    
                    for($i=1 ; $i<=$longitudPass ; $i++){
                        $pos=rand(0,$longitudCadena-1);
                        $pass .= substr($cadena,$pos,1);
                    }
    
                
    
                $to = $_POST['email'];
                //$email = "javierlegua14@gmail.com";
                //$to = "javierlegua14@gmail.com";
                $nombreTo = "Socio";
                $asunto = "Recuperación contraseña";
                $cuerpo = "Su contraseña temporal es: $pass";
                //echo "hola";exit();
                $respuesta = EnviarEmail::sendEmail($to,$nombreTo,$asunto,$cuerpo); //VOY POR AQUI

                if ($respuesta == '1') {
                    $this->usuarioModelo = $this->modelo('Usuario');
                    $this->usuarioModelo->recuperarPass($to, $pass);
                    $this->vistaApi(true);
                }else{
                    echo "No se ha podido enviar el mensaje. Error: $respuesta";
                }
    
            }else{
                 redireccionar('/');
            }
        }


    }
