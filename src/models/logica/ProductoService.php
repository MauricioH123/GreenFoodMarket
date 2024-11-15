<?php
namespace App\Models\Logica;

use App\models\persistence\ProductoDAO;

class ProductoService{
    private $productoDAO;

    public function __construct(){
        $this -> productoDAO = new ProductoDAO();
    }

    public function listadoProductos(){
        return $this -> productoDAO ->obtenerProductos();
    }

    public function crearProducto($id_proveedor, $nombre_producto, $precio_venta){
        return $this -> productoDAO ->crearProductos($id_proveedor, $nombre_producto, $precio_venta);
    }
}