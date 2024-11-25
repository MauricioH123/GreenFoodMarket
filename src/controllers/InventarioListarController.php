<?php

namespace App\Controllers;

use App\Models\Logica\InventarioService;
use App\Views\InventarioListarView;

class InventarioListarController{
    private $inventarioService;
    private $view;

    public function __construct(){
        $this ->inventarioService = new InventarioService();
        $this ->view = new InventarioListarView();
    }

    public function mostrarInventario(){
        $inventario = $this ->inventarioService -> mostrarInventario();
        $this -> view ->render($inventario);
    }

    public function actualizarInventario($id_producto, $cantidad){
        $this ->inventarioService ->actualizarInventario($id_producto, $cantidad);
    }

}