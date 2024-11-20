<?php
namespace App\Controllers;

use App\Models\Logica\ProductoService;
use App\Views\ProductoCrearView;
use Respect\Validation\Validator as v;


class PoductoCreaController{
    private $productoService;
    private $view;

    public function __construct(){
        $this -> productoService = new ProductoService();
        $this -> view = new ProductoCrearView();
    }

    public function mostrarFormulario($mensaje = ""){
        $this -> view->render($mensaje);
    }

    public function crearProducto($id_proveedor, $nombre_producto, $precio_venta){
        
        if(!v::positive()->validate($id_proveedor)){
            $this -> view -> render("Error: ID del proveedor invalido");
            return;
        }

        if(!v::stringType()->notEmpty()->validate($nombre_producto)){
            $this -> view -> render("Error: El nombre del producto es inválido");
            return;
        }

        if(!v::positive()->validate($precio_venta)){
            $this -> view -> render("Error: El precio de venta no es válido");
            return;
        }

        $creaP = $this-> productoService ->crearProducto($id_proveedor, $nombre_producto, $precio_venta);
        $this ->view ->render($creaP);
    }
}