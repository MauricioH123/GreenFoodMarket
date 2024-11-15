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
            $productos[] = new Producto($row['id_producto'], $row['id_proveedor'],$row['Nombre_producto'], $row['precio_venta']);
        }
        $stmt->close();
        return $productos;
    }

    public function crearProductos($id_proveedor, $nombre_producto, $precio_venta){
        $query = "CALL insertar_producto(?,?,?);";
        $stmt = $this -> conn -> prepare($query);
        $stmt -> bind_param("isi", $id_proveedor, $nombre_producto, $precio_venta);
        if($stmt -> execute()){
            $stmt->close();
            return "Registro creado";
        }else{
            $stmt->close();
            return "Fallo el registro";
        }
    }
}