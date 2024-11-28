<?php
namespace App\Controllers;

use App\Models\Logica\DetalleService;
use App\Views\DetalleFacturaView;

class DetalleFacturaCreaController{
    private $detalleService;
    private $view;

    public function __construct(){
        $this ->detalleService = new DetalleService();
        $this ->view = new DetalleFacturaView();
    }

    public function mostrarFormulario($mensaje = ""){
        $this -> view->render($mensaje);
    }

    public function crearDetalle($id_factura, $id_producto, $cantidad, $precio_unitario){
        $this ->detalleService ->crearFactura($id_factura, $id_producto, $cantidad, $precio_unitario);
    }

}