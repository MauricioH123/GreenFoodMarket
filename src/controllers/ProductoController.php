<?php
namespace App\Controllers;

use App\Models\Logica\ProductoService;
use App\Views\ProductosLista;


class ProductoController{
    private $productoService;
    private $view;

    public function __construct(){
        $this -> productoService = new ProductoService();
        $this -> view = new ProductosLista();
    }

    public function mostrarProductos(){
        $productos = $this -> productoService ->listadoProductos();
        $this -> view -> render($productos);
    }
}