<?php
namespace App\Views;

use TCPDF;

class ImprimirDetalleDeFactura extends BaseView{
    public function render($productos, $nombreCliente, $id_facturaMostrar){
        // Calcular el total de la factura
        $totalFactura = 0;
        foreach ($productos as $producto) {
            $totalFactura += $producto['Total_factura'];
        }

        // Crear una nueva instancia de TCPDF
        $pdf = new TCPDF();
        
        // Configuración del PDF
        $pdf->SetAutoPageBreak(TRUE, 15); // Activar el salto automático de página
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);

        // Nombre de la empresa en la parte superior
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'Green Food Market', 0, 1, 'C'); // Nombre de la empresa
        $pdf->Ln(5); // Salto de línea

        // Título de la factura
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'Factura #'.$id_facturaMostrar, 0, 1, 'C');
        
        // Nombre del cliente
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, 'Cliente: ' . $nombreCliente, 0, 1, 'L');

        // Salto de línea
        $pdf->Ln(5);

        // Tabla de productos
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(60, 10, 'Nombre del producto', 1);
        $pdf->Cell(30, 10, 'Cantidad', 1);
        $pdf->Cell(40, 10, 'Precio unitario', 1);
        $pdf->Cell(40, 10, 'Total por producto', 1);
        $pdf->Ln();

        // Mostrar los productos en la tabla
        foreach ($productos as $producto) {
            $pdf->Cell(60, 10, $producto['Nombre_producto'], 1);
            $pdf->Cell(30, 10, $producto['cantidad_facturada'], 1);
            $pdf->Cell(40, 10, '$' . number_format($producto['precio_unitario'], 2), 1);
            $pdf->Cell(40, 10, '$' . number_format($producto['Total_factura'], 2), 1);
            $pdf->Ln();
        }

        // Salto de línea para el total
        $pdf->Ln(5);

        // Total de la factura
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 10, 'Total de la factura: $' . number_format($totalFactura, 2), 0, 1, 'R');

        // Salida del PDF
        $pdf->Output('factura_cliente_'.$id_facturaMostrar.'.pdf', 'I'); // 'I' para mostrar en el navegador
    }
}
?>
