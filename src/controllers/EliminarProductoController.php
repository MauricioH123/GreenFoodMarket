<?php
namespace App\Controllers;

use App\Models\Logica\ProductoService;
use App\Views\ProductosLista;

class EliminarProductoController{
    private $productoService;
    private $view;
    public function __construct(){
        $this -> productoService = new ProductoService();
        $this -> view = new ProductosLista();
    }

    public function eliminarPorductoC($id_producto){
        $eliminarP = $this -> productoService ->eliminarPorducto($id_producto);
    }
}