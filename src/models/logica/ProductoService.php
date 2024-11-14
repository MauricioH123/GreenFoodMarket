<?php
namespace App\Models\Logica;

use App\models\persistence\ProductoDAO;

class ProductoService{
    private $productoDAO;

    public function __construct(){
        $this -> productoDAO = new productoDAO();
    }

    public function listadoProductos(){
        return $this -> productoDAO ->obtenerProductos();
    }
}