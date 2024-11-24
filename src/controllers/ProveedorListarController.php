<?php
namespace App\Controllers;

use App\Models\Logica\ProveedorService;
use App\Views\ProveedorListaView;
use Respect\Validation\Validator as v;

class ProveedorListarController{
    private $productoService;
    private $view;

    public function __construct(){
        $this ->productoService = new ProveedorService();
        $this ->view = new ProveedorListaView();
    }

    public function mostrarProveedor(){
        $proveedores = $this ->productoService ->listaProveedore();
        $this -> view ->render($proveedores);
    }

    public function eliminarProveedor($id_proveedor){
        $this -> productoService ->borrarProveedor($id_proveedor);
    }

    public function editarProveedor($id_proveedor, $nombre_proveedor){
        $this -> productoService ->actualizarProveedor($id_proveedor, $nombre_proveedor);    
    }
}