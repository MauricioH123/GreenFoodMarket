<?php
namespace App\models\persistence;

use App\Database\Database;
use App\Models\Entidades\Producto;

class ProductoDAO{
    private $conn;
    
    public function __construct(){
        $baseDeDato = new Database();
        $this -> conn = $baseDeDato ->abrir();
    }

    public function obtenerProductos(){
        $query = "SELECT * FROM productos";
        $stmt = $this -> conn -> prepare($query);
        $stmt -> execute();
        $resultado = $stmt -> get_result();
        
        $productos = array();
        while($row = $resultado -> fetch_assoc()){
            $productos[] = new Producto($row["id"], $row["proveedor"],$row["nombre"], $row["precio"] );
        }
        return $productos;
    }
}