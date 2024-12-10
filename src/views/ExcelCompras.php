<?php

namespace App\Views;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelCompras extends BaseView
{
    public function render(array $compras, array $ventas)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Configurar encabezados
        $sheet->setCellValue('A1', 'Fecha');
        $sheet->setCellValue('B1', 'Compras diarias en pesos');

        $sheet->setCellValue('D1', 'Fecha');
        $sheet->setCellValue('E1', 'Ventas diarias en pesos');

        $fila1 = 2;

        // Llenar datos
        foreach ($compras as $compra) {
            $sheet->setCellValue("A{$fila1}", $compra["fecha_entrada"]); // Fecha
            $sheet->setCellValue("B{$fila1}", $compra["compras"]);       // Cantidad
            // Formato numérico sin separadores de miles
            $sheet->getStyle("B{$fila1}")
                ->getNumberFormat()
                ->setFormatCode('0.00'); // Dos decimales
            $fila1++;
        }

        $fila2 = 2;

        foreach ($ventas as $venta) {
            $sheet->setCellValue("D{$fila2}", $venta["fecha"]); // Fecha
            $sheet->setCellValue("E{$fila2}", $venta["ventas"]);       // Cantidad
            // Formato numérico sin separadores de miles
            $sheet->getStyle("E{$fila2}")
                ->getNumberFormat()
                ->setFormatCode('0.00'); // Dos decimales
            $fila2++;
        }

        // Limpia cualquier salida previa
        if (ob_get_contents()) {
            ob_end_clean();
        }

        // Enviar cabeceras HTTP para la descarga
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="compras.xlsx"');
        header('Cache-Control: max-age=0');

        // Crear archivo Excel y enviarlo al navegador
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit; // Detener la ejecución para evitar salida adicional
    }
}
