<?php
namespace App\Controllers;

use App\Models\Logica\ProductoService;
use App\Views\ProductoCrearView;
use App\Helpers\Validacion;


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
        
        if(!Validacion::validarProveedor($id_proveedor)){
            $this -> view -> render("Error: ID del proveedor invalido");
            return;
        }

        if(!Validacion::validarNombre($nombre_producto)){
            $this -> view -> render("Error: El nombre del producto es inválido");
            return;
        }

        if(!Validacion::validarPrecio($precio_venta)){
            $this -> view -> render("Error: El precio de venta no es válido");
            return;
        }

        $creaP = $this-> productoService ->crearProducto($id_proveedor, $nombre_producto, $precio_venta);
        $this ->view ->render("Producto creado exitosamente");
    }
}