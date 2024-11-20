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
}