<?php
namespace App\Controllers;

use App\Models\Logica\DetalleService;
use App\Views\DetalleFacturaView;
use App\Models\Logica\FacturaService;
use App\Models\Logica\ProductoService;

class DetalleFacturaCreaController{
    private $detalleService;
    private $view;
    private $facturaService;
    private $productos;

    public function __construct(){
        $this ->detalleService = new DetalleService();
        $this ->view = new DetalleFacturaView();
        $this -> facturaService = new FacturaService();
        $this -> productos = new ProductoService();
    }

    public function mostrarFormulario($mensaje = ""){
        $facturas = $this->facturaService ->mostrarFactura();
        $productos = $this -> productos->listadoProductos();
        $this -> view->render($mensaje, $facturas, $productos);
    }

    public function crearDetalle($id_factura, $id_producto, $cantidad, $precio_unitario){
        $crearD = $this ->detalleService ->crearFactura($id_factura, $id_producto, $cantidad, $precio_unitario);
        header("Location: index.php?action=facturaD");
    }

    public function mostrarDetalleFactua($id_factura){
        $facturasDetalle = $this ->detalleService->detallesFacturas($id_factura);
    }

}