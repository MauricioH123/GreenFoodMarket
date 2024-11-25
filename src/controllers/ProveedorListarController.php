<?php
namespace App\Controllers;

use App\Models\Logica\ProveedorService;
use App\Views\ProveedorListaView;
use Respect\Validation\Validator as v;

class ProveedorListarController{
    private $proveedoreService;
    private $view;

    public function __construct(){
        $this ->proveedoreService = new ProveedorService();
        $this ->view = new ProveedorListaView();
    }

    public function mostrarProveedor(){
        $proveedores = $this ->proveedoreService ->listaProveedore();
        $this -> view ->render($proveedores);
    }

    public function eliminarProveedor($id_proveedor){
        $this -> proveedoreService ->borrarProveedor($id_proveedor);
    }

    public function editarProveedor($id_proveedor, $nombre_proveedor){
        $this -> proveedoreService ->actualizarProveedor($id_proveedor, $nombre_proveedor);    
    }
}