<?php
namespace App\Controllers;

use App\Models\Logica\ProductoService;
use App\Views\ProductoCrearView;
use Respect\Validation\Validator as v;
use App\Models\Logica\ProveedorService;


class PoductoCreaController{
    private $productoService;
    private $view;
    private $proveedorService;

    public function __construct(){
        $this -> productoService = new ProductoService();
        $this -> view = new ProductoCrearView();
        $this -> proveedorService = new ProveedorService();
    }

    public function mostrarFormulario($mensaje = ""){
        $proveedores = $this -> proveedorService ->listaProveedore();
        $this -> view->render($mensaje, $proveedores);
    }

    public function crearProducto($id_proveedor, $nombre_producto, $precio_venta){
        
        if(!v::positive()->validate($id_proveedor)){
            $this -> mostrarFormulario("Error: ID del proveedor invalido");
            return;
        }

        if(!v::stringType()->notEmpty()->validate($nombre_producto)){
            $this -> mostrarFormulario("Error: El nombre del producto es inválido");
            return;
        }

        if(!v::positive()->validate($precio_venta)){
            $this -> mostrarFormulario("Error: El precio de venta no es válido");
            return;
        }

        $creaP = $this-> productoService ->crearProducto($id_proveedor, $nombre_producto, $precio_venta);
        $this -> mostrarFormulario($creaP);
    }
}