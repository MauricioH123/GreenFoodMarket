<?php
namespace App\Controllers;

use App\Models\Logica\ProductoService;
use App\Views\ProductoCrearView;


class PoductoCreaController{
    private $productoService;
    private $view;

    public function __construct(){
        $this -> productoService = new ProductoService();
        $this -> view = new ProductoCrearView();
    }

    public function mostrarFormulario(){
        $this -> view->render();
    }

    public function crearProducto($id_proveedor, $nombre_producto, $precio_venta){
        $creaP = $this-> productoService ->crearProducto($id_proveedor, $nombre_producto, $precio_venta);
        $this ->view ->render();
    }
}