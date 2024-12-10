<?php

namespace App\Views;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelCompras extends BaseView
{
    public function render(array $compras)
    {

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        $sheet->setCellValue('A1', 'Fecha');
        $sheet->setCellValue('B1', 'Cantidad de comprada en pesos');

        $fila = 2;
        $datos = array();
        foreach ($compras as $compra) {
            $sheet ->setCellValue("A{$fila}",$compra["fecha_entrada"]);
            $sheet ->setCellValue("A{$fila}",number_format($compra["compras"],5));
            $fila++;
        }

        $writer = new Xlsx($spreadsheet);
        $nombreArchivo = 'comprasDiarias.xlsx';
        $writer->save($nombreArchivo);
    }
}
