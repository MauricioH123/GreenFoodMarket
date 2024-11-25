<?php
namespace App\Models\Logica;

use App\Models\Persistence\InventarioDAO;

class InventarioService{
    private $inventarioDAO;

    public function __construct(){
        $this ->inventarioDAO = new InventarioDAO();
    }

    public function mostrarInventario(){
        return $this -> inventarioDAO ->obtenerInventario();
    }

    public function actualizarInventario(){
        
    }
}