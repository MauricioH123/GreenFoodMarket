<?php

namespace App\Views;

require_once "/laragon/www/proyectos/GreenFoodMarket/vendor/autoload.php";

use App\Views\BaseView;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EnviarFacturaCorreo extends BaseView{
    public function render($destinatario, $asunto, $htmlFactura)
    {
        $mail = new PHPMailer(true);
//         $mail->SMTPDebug = 2; // Muestra detalles de depuración
// $mail->Debugoutput = 'html'; // Salida en formato HTML

        try{           
            $mail -> isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'p1032774@gmail.com'; // Tu correo
            $mail->Password = 'pldk ccoj oimw mfjg';       // Contraseña o App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('p1032774@gmail.com', 'Greend Food Market');
            $mail->addAddress($destinatario); // Destinatario
            $mail->Subject = $asunto;
            $mail->isHTML(true); // Permitir HTML en el cuerpo del correo
            $mail->Body = $htmlFactura;

            $mail->send();
            echo "Correo enviado correctamente.";
        }catch(Exception $e){
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    }
}

$correo = new EnviarFacturaCorreo();
$correo->render("mauricioto123@gmail.com", "Esto es una prueba", "<p>Este es un <b>mensaje</b> de prueba.</p>");