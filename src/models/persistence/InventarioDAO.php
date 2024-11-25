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

    public function editarInventario() {}
}

// $d = new InventarioDAO();
// print_r($d->obtenerInventario());
