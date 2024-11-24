<?php
namespace App\Controllers;

use App\Models\Logica\ProveedorService;
use App\Views\ProveedorLista;
use App\Views\ProveedorListaView;

class ProveedorListarController{
    private $productoService;
    private $view;

    public function __construct(){
        $this ->productoService = new ProveedorService();
        $this ->view = new ProveedorListaView();
    }

    public function mostrarProveedor(){
        $clientes = $this ->productoService ->listaProveedore();
        $this -> view ->render($clientes);
    }
}