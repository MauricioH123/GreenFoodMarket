<?php
namespace App\Controllers;

use App\Models\Logica\DetalleService;
use App\Views\DetalleFacturaView;
use App\Models\Logica\FacturaService;

class DetalleFacturaCreaController{
    private $detalleService;
    private $view;
    private $facturaService;

    public function __construct(){
        $this ->detalleService = new DetalleService();
        $this ->view = new DetalleFacturaView();
        $this -> facturaService = new FacturaService();
    }

    public function mostrarFormulario($mensaje = ""){
        $facturas = $this->facturaService ->mostrarFactura();
        $this -> view->render($mensaje, $facturas);
    }

    public function crearDetalle($id_factura, $id_producto, $cantidad, $precio_unitario){
        $this ->detalleService ->crearFactura($id_factura, $id_producto, $cantidad, $precio_unitario);
    }

}