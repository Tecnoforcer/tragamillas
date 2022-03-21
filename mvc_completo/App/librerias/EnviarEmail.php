<?php

    include 'PHPMailer.php';
    include 'SMTP.php';
    //include 'Exception.php';

    final class EnviarEmail{

        private static $email = EmailEmisor;
        private static $emailPass = EmailPass;
        private static $emisor = Emisor;

        public function __construct(){
            
        }

        public static function sendEmail($to,$nombreTo,$asunto,$cuerpo,$from="makelelesinformatica@gmail.com",$nombreFrom="Club tragamillas")
        {
            
            $mail = new PHPMailer(true);
    
            try {
                //Server settings
    //            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();  
                //$mail->Mailer = "smtp";                                          // Send using SMTP;
               /* $mail->Host       = 'n3plcpnl0021.prod.ams3.secureserver.net';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = $from;                     // SMTP username
                $mail->Password   = 'contraseña';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;  */                                  // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    //            $mail->Username   = $from;                     // SMTP username
                $mail->Username   = self::$email;                     // SMTP username
                $mail->Password   = self::$emailPass;                               // SMTP password
    //            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //            $mail->Port       = 465; 
                $mail->Port       = 587;
    
                $mail->CharSet = 'UTF-8';
    
                //Recipients
    //            $mail->setFrom($from, $nombreFrom);
                $mail->setFrom(self::$email, self::$emisor);
                $mail->addAddress($to, $nombreTo);
    //            $mail->addReplyTo($from, $nombreFrom);
                $mail->addReplyTo(self::$email, self::$emisor);
                
    
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $asunto;
                $mail->Body    = $cuerpo;

                
                $mail->send();
    //            $respuesta = 'El Mensaje ha sido enviado correctamente';
                $respuesta = '1';
                
                // redireccionar('/');
                
            } catch (Exception $e) {
                $respuesta= $mail->ErrorInfo;
             }
             
            return $respuesta;
         }
    
    }