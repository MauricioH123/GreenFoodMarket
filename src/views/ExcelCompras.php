<?php

namespace App\Views;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ExcelCompras extends BaseView
{
    public function render(array $compras)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Configurar encabezados
        $sheet->setCellValue('A1', 'Fecha');
        $sheet->setCellValue('B1', 'Cantidad comprada en pesos');

        $fila = 2;

        // Llenar datos
        foreach ($compras as $compra) {
            $sheet->setCellValue("A{$fila}", $compra["fecha_entrada"]); // Fecha
            $sheet->setCellValue("B{$fila}", $compra["compras"]);       // Cantidad

            // Formato numérico sin separadores de miles
            $sheet->getStyle("B{$fila}")
                ->getNumberFormat()
                ->setFormatCode('0.00'); // Dos decimales
            $fila++;
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
