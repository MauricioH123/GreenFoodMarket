<?php

namespace App\Views;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EnviarFacturaCorreo extends BaseView{
    public function render($destinatario, $productos, $nombreCliente, $id_facturaMostrar)
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
            $mail->Subject = "Compra en Greend Food Market";
            $mail->isHTML(true); // Permitir HTML en el cuerpo del correo
            $mail->Body = $this ->detalle($productos, $nombreCliente, $id_facturaMostrar);

            $mail->send();
            // echo "Correo enviado correctamente.";
        }catch(Exception $e){
            // echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    }

    public function detalle ($productos, $nombreCliente, $id_facturaMostrar){
         // Calcular el total de la factura
         $totalFactura = 0;
         foreach ($productos as $producto) {
             $totalFactura += $producto['Total_factura'];
         }
 
         // Generar el HTML
         ob_start();
         ?>
         <!DOCTYPE html>
         <html>
         <head>
             <meta charset="UTF-8">
             <style>
                 body { font-family: Arial, sans-serif; }
                 h1, h3 { color: #333; }
                 table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                 table, th, td { border: 1px solid #ddd; }
                 th, td { padding: 8px; text-align: left; }
                 th { background-color: #f4f4f4; }
                 .text-end { text-align: right; }
                 .form-control { border: none; font-weight: bold; }
             </style>
         </head>
         <body>
             <h1>Factura #<?php echo $id_facturaMostrar; ?></h1>
             <h3>Cliente: <?php echo $nombreCliente; ?></h3>
             <table>
                 <thead>
                     <tr>
                         <th>Nombre del producto</th>
                         <th>Cantidad</th>
                         <th>Precio unitario</th>
                         <th>Total por producto</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php foreach ($productos as $producto): ?>
                         <tr>
                             <td><?php echo $producto['Nombre_producto']; ?></td>
                             <td><?php echo $producto['cantidad_facturada']; ?></td>
                             <td><?php echo '$' . number_format($producto['precio_unitario'], 2); ?></td>
                             <td><?php echo '$' . number_format($producto['Total_factura'], 2); ?></td>
                         </tr>
                     <?php endforeach; ?>
                 </tbody>
             </table>
             <div class="text-end">
                 <p><strong>Total de la factura:</strong> <?php echo '$' . number_format($totalFactura, 2); ?></p>
             </div>
         </body>
         </html>
         <?php
         return ob_get_clean();
    }
}