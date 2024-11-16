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

    function sanitizeMysql($connection, $string){
        $string =$connection->real_escape_string($string);
        $string = strip_tags($string);
        $string = htmlentities($string);
        return $string;
    }

    public function obtenerProductos(){
        $query = "SELECT * FROM productos_tienda";
        $stmt = $this -> conn -> prepare($query);
        $stmt -> execute();
        $resultado = $stmt -> get_result();
        
        $productos = array();
        while($row = $resultado -> fetch_assoc()){
            $productos[] = new Producto($row['id_producto'], $row['nombre_proveedor'],$row['Nombre_producto'], $row['precio_venta']);
        }
        $stmt->close();
        return $productos;
    }

    public function crearProductos($id_proveedor, $nombre_producto, $precio_venta){
        try{
            $id_proveedor = $this -> sanitizeMysql($this ->conn,$id_proveedor);
            $nombre_producto = $this -> sanitizeMysql($this ->conn,$nombre_producto);
            $precio_venta = $this -> sanitizeMysql($this ->conn,$precio_venta);
    
            $query = "CALL insertar_producto(?,?,?);";
            $stmt = $this -> conn -> prepare($query);
            $stmt -> bind_param("isi", $id_proveedor, $nombre_producto, $precio_venta);
    
            if($stmt -> execute()){
                $stmt->close();
                return "Producto creado exitosamente";
            }else{
                $stmt->close();
                return "Fallo al crear el producto";
            }
        }catch(\mysqli_sql_exception $e){
            return "Error: el Id del proveedor no existe.";
        }

    }

    public function eliminarProducto($id_producto){
        try{
            $query = "CALL eliminar_producto(?);";
            $stmt = $this -> conn -> prepare($query);
            $stmt -> bind_param("i", $id_producto);
            if ($stmt -> execute()) {
                $stmt -> close();
                return "Producto eliminado";
            }else{
                $stmt -> close();
                return "Fallo al eliminar el producto";
            }
        }catch(\mysqli_sql_exception $e){
            return "Error." . $e->getMessage();
        }


    }
}

// $p = new ProductoDAO();
// echo $p -> crearProductos(50, "sdjf", 500);