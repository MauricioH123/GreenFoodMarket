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
            echo "Correo enviado correctamente.";
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
            body { 
                font-family: Arial, sans-serif; 
                margin: 0; 
                padding: 0; 
                background-color: #f9fdf9; 
                color: #333; 
            }
            .container {
                width: 90%; 
                margin: 20px auto; 
                background: #fff; 
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
                border-radius: 8px; 
                overflow: hidden; 
            }
            header {
                background-color: #4caf50; 
                color: #fff; 
                text-align: center; 
                padding: 15px 0; 
                font-size: 24px; 
                font-weight: bold;
            }
            h1, h3 {
                margin: 20px; 
                color: #4caf50;
            }
            table {
                width: 90%; 
                margin: 20px auto; 
                border-collapse: collapse;
            }
            table, th, td {
                border: 1px solid #ddd; 
            }
            th {
                background-color: #4caf50; 
                color: #fff; 
                padding: 10px;
                text-align: left;
            }
            td {
                padding: 10px; 
                text-align: left; 
                color: #333;
            }
            .text-end {
                text-align: right; 
                margin: 20px; 
                font-size: 16px;
            }
            .text-end p {
                color: #4caf50; 
                font-weight: bold;
            }
            footer {
                text-align: center; 
                padding: 15px; 
                background-color: #4caf50; 
                color: #fff; 
                font-size: 14px;
                margin-top: 20px;
            }
            footer span {
                font-size: 18px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <header>GREEN FOOD MARKET</header>
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
                <p>Total de la factura: <?php echo '$' . number_format($totalFactura, 2); ?></p>
            </div>
            <footer>
                Gracias por comprar con nosotros 🌿🌱🌳 <br>
                <span>¡Esperamos verte pronto! 🍀🌾</span>
            </footer>
        </div>
    </body>
    </html>
    <?php
    return ob_get_clean();
    }
}