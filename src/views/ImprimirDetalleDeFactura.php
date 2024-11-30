<?php
namespace App\Views;

use TCPDF;

class ImprimirDetalleDeFactura extends BaseView {
    public function render($productos, $nombreCliente, $id_facturaMostrar) {
        // Calcular el total de la factura
        $totalFactura = 0;
        foreach ($productos as $producto) {
            $totalFactura += $producto['Total_factura'];
        }

        // Crear una nueva instancia de TCPDF
        $pdf = new TCPDF();

        // Configuración general del PDF
        $pdf->SetAutoPageBreak(TRUE, 15); // Salto automático de página
        $pdf->SetMargins(15, 20, 15); // Márgenes (izquierda, arriba, derecha)
        $pdf->AddPage();

        // Colores personalizados
        $verdeOscuro = [0, 128, 0]; // Verde oscuro
        $verdeClaro = [144, 238, 144]; // Verde claro (opcional para otros elementos)

        // Insertar logotipo (si tienes uno)
        $logoPath = __DIR__ . '/../../assets/img/LOGO.png'; // Ajusta la ruta según tu proyecto
        if (file_exists($logoPath)) {
            $pdf->Image($logoPath, 15, 10, 30); // Posición (x, y) y tamaño (ancho)
        }

        // Nombre de la empresa
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->SetTextColor($verdeOscuro[0], $verdeOscuro[1], $verdeOscuro[2]); // Color verde
        $pdf->Cell(0, 15, 'Green Food Market', 0, 1, 'C'); // Título centrado
        $pdf->Ln(5); // Salto de línea

        // Título de la factura
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'Factura #'.$id_facturaMostrar, 0, 1, 'C');

        // Nombre del cliente
        $pdf->SetFont('helvetica', '', 12);
        $pdf->SetTextColor(0, 0, 0); // Texto negro
        $pdf->Ln(5);
        $pdf->Cell(0, 10, 'Cliente: ' . $nombreCliente, 0, 1, 'L');

        // Tabla de productos
        $pdf->Ln(10); // Espacio antes de la tabla
        $pdf->SetFont('helvetica', '', 10);

        // Cabecera de la tabla con fondo verde
        $pdf->SetFillColor($verdeOscuro[0], $verdeOscuro[1], $verdeOscuro[2]); // Fondo verde oscuro
        $pdf->SetTextColor(255, 255, 255); // Texto blanco
        $pdf->Cell(60, 8, 'Nombre del producto', 1, 0, 'C', true);
        $pdf->Cell(30, 8, 'Cantidad', 1, 0, 'C', true);
        $pdf->Cell(40, 8, 'Precio unitario', 1, 0, 'C', true);
        $pdf->Cell(40, 8, 'Total por producto', 1, 1, 'C', true);

        // Filas de productos
        $pdf->SetTextColor(0, 0, 0); // Texto negro
        foreach ($productos as $producto) {
            $pdf->Cell(60, 8, $producto['Nombre_producto'], 1);
            $pdf->Cell(30, 8, $producto['cantidad_facturada'], 1, 0, 'C');
            $pdf->Cell(40, 8, '$' . number_format($producto['precio_unitario'], 2), 1, 0, 'R');
            $pdf->Cell(40, 8, '$' . number_format($producto['Total_factura'], 2), 1, 1, 'R');
        }

        // Total de la factura
        $pdf->Ln(5); // Espacio antes del total
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->SetTextColor($verdeOscuro[0], $verdeOscuro[1], $verdeOscuro[2]); // Verde oscuro
        $pdf->Cell(0, 10, 'Total de la factura: $' . number_format($totalFactura, 2), 0, 1, 'R');

        // Pie de página
        $pdf->Ln(10);
        $pdf->SetFont('helvetica', 'I', 10);
        $pdf->SetTextColor(0, 0, 0); // Negro para el pie de página
        $pdf->Cell(0, 10, 'Gracias por su compra en Green Food Market', 0, 1, 'C');

        // Salida del PDF
        $pdf->Output('factura_cliente_'.$id_facturaMostrar.'.pdf', 'I'); // Mostrar en el navegador
    }
}
?>
