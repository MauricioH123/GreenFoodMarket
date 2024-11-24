<?php
namespace App\Models\Logica;

use App\Models\Persistence\ProveedorDAO;

class ProveedorService{

    private $proveerdorDAO;

    public function __construct(){
        $this ->proveerdorDAO = new ProveedorDAO();
    }

    public function listaProveedore(){
        return $this -> proveerdorDAO ->obtenerProveedor();
    }

    public function borrarProveedor($id_proveedor){
        return $this -> proveerdorDAO ->eliminarProveedor($id_proveedor);
    }

    public function actualizarProveedor($id_proveedor, $nombre_proveedor){
        return $this -> proveerdorDAO ->editarProveedor($id_proveedor, $nombre_proveedor);
    }
}