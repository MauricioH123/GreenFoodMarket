<?php

namespace App\Models\Persistence;

use App\Models\Entidades\Factura;
use App\Database\Database;

// require_once "/laragon/www/proyectos/GreenFoodMarket/vendor/autoload.php";

class FacturaDAO
{
    private $conn;

    public function __construct()
    {
        $baseDeDatos = new Database();
        $this->conn = $baseDeDatos->abrir();
    }

    function sanitizeMysql($connection, $string)
    {
        $string = $connection->real_escape_string($string);
        $string = strip_tags($string);
        $string = htmlentities($string);
        return $string;
    }

    public function crearFactura($id_clientes, $fecha)
    {
        $id_clientes = $this->sanitizeMysql($this->conn, $id_clientes);
        $fecha = $this->sanitizeMysql($this->conn, $fecha);

        try {
            $query = 'CALL insertar_factura(?,?);';
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('is', $id_clientes, $fecha);
            if ($stmt->execute()) {
                $stmt->close();
                return "Se creo la factura";
            } else {
                $stmt->close();
                return "Fallo al crear la factura";
            }
        } catch (\mysqli_sql_exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function mostrarFacturas()
    {
        try {
            $query = "SELECT * FROM factura;";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $facturas = array();

            while ($row = $resultado->fetch_assoc()) {
                $facturas[] = new Factura(stripslashes($row['id_factura']), stripslashes($row['id_cliente']), stripslashes($row['fecha']));
            }
            $stmt->close();
            return $facturas;
        } catch (\mysqli_sql_exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function ultimoIdFactura()
    {
        try {
            $query = "SELECT id_factura FROM factura ORDER BY id_factura DESC LIMIT 1 ;";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $stmt->bind_result($id_factura);
            if ($stmt->fetch()) {
                $stmt->close();
                return $id_factura; // Retorna el último ID
            } else {
                $stmt->close();
                return 0; // No hay facturas, retorna 0
            }
        } catch (\mysqli_sql_exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function facturasTotales()
    {
        try {
            $query = "SELECT * FROM total_facturas_clientes;";
            $stmt = $this->conn->prepare($query);
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $productos = array();
                while ($row = $resultado->fetch_assoc()) {
                    $productos[] = [
                        'id_factura' => $row['id_factura'],
                        'nombre' => $row['nombre'],
                        'fecha' => $row['fecha'],
                        'total_factura' => $row['total_factura']
                    ];
                }
                $stmt->close();
                return $productos;
            }
        } catch (\mysqli_sql_exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function ventasDiarias(){
        try {
            $query = "SELECT 
            t.fecha,
            t.total_factura AS ventas
            FROM
            total_facturas_clientes AS t
            ORDER BY
            t.fecha;";
            $stmt = $this->conn->prepare($query);
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $productos = array();
                while ($row = $resultado->fetch_assoc()) {
                    $productos[] = [
                        "fecha" => $row["fecha"],
                        "ventas" => $row["ventas"]
                    ];
                }
                $stmt->close();
                return $productos;
            }
        }
        catch (\mysqli_sql_exception $e) {
            return "". $e->getMessage();
        }
    }
}

// $d = new FacturaDAO();
// print_r($d->ventasDiarias()) ;