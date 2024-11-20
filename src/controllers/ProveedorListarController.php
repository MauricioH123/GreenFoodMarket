<?php
namespace App\Controllers;

use App\Models\Logica\ProveedorService;
use App\Views\ProductoCrearView;

class ProveedorListarController{
    private $productoService;
    private $view;

    public function __construct(){
        $this ->productoService = new ProveedorService();
        $this ->view = new ProductoCrearView();
    }

    public function mostrarProveedor(){
        $this ->productoService ->listaProveedore();
    }
}