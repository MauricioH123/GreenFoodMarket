<?php

namespace App\Models\Persistence;

use App\Database\Database;
use App\Models\Entidades\Inventario;

// require_once "/laragon/www/greend-food/vendor/autoload.php";

class InventarioDAO
{
    private $conn;

    public function __construct()
    {
        $basededatos = new Database();
        $this->conn = $basededatos->abrir();
    }

    function sanitizeMysql($connection, $string){
        $string =$connection->real_escape_string($string);
        $string = strip_tags($string);
        $string = htmlentities($string);
        return $string;
    }

    public function obtenerInventario()
    {
        try {
            $query = "SELECT i.id_producto,p.Nombre_producto,i.cantidad FROM inventario AS i JOIN  productos AS p ON i.id_producto = p.id_producto ORDER BY i.id_producto";
            $stmt = $this->conn->prepare($query);
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $productos = array();
                while ($row = $resultado->fetch_assoc()) {
                    $productos[] = new Inventario($row['id_producto'], $row['Nombre_producto'], $row['cantidad']);
                }
                $stmt->close();
                return $productos;
            }
        } catch (\mysqli_sql_exception $e) {
            return "Error." . $e->getMessage();
        }
    }

    public function editarInventario($id_producto, $cantidad) {
        $id_producto = $this -> sanitizeMysql($this ->conn,$id_producto);
        $cantidad = $this -> sanitizeMysql($this ->conn,$cantidad);
        try{
            $query = "UPDATE inventario SET cantidad =? WHERE id_producto= ?;";
            $stmt = $this->conn ->prepare($query);
            $stmt ->bind_param('ii',$cantidad,$id_producto);
            if($stmt -> execute()){
                $stmt -> close();
                return "Se actualizo el inventario";
            }else{
                $stmt -> close();
            }
        }catch(\mysqli_sql_exception $e){
            return "Error." . $e->getMessage();
        }
    }
}

// $d = new InventarioDAO();
// print_r($d->obtenerInventario());
