<?php

namespace App\Models\Persistence;

use App\Database\Database;

// require_once "/laragon/www/greend-food/vendor/autoload.php";

class DetalleFacturaDAO
{
    private $conn;

    public function __construct()
    {
        $baseDeDato = new Database();
        $this->conn = $baseDeDato->abrir();
    }

    public function insertarDetalleFactura($id_factura, $id_producto, $cantidad, $precio_unitario)
    {
        try {
            $query = "CALL insertar_detalle_factura(?,?,?,?);";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("iiid", $id_factura, $id_producto, $cantidad, $precio_unitario);
            if ($stmt->execute()) {
                $stmt->close();
                return "Entrada creada exitosamente";
            } else {
                $stmt->close();
                return "Fallo al crear la entrada";
            }
        } catch (\mysqli_sql_exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function mostrarDetalle($id_factura){
        try {
            $query = "SELECT
            pr.Nombre_producto,
            de.cantidad_facturada,
            de.precio_unitario,
            (de.cantidad_facturada*de.precio_unitario) AS Total_factura
            FROM
            clientes AS c
            JOIN 
            factura AS f ON c.id_cliente = f.id_cliente
            JOIN
            detalle_factura AS de ON f.id_factura = de.id_factura
            JOIN
            productos AS pr ON de.id_producto = pr.id_producto
            WHERE f.id_factura = ?
            ;";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $id_factura);
            if($stmt->execute()){
                $resultado = $stmt->get_result();
                $productos = array();
                while ($row = $resultado->fetch_assoc()) {
                    $productos[] = [
                        'Nombre_producto' => $row['Nombre_producto'],
                        'cantidad_facturada' => $row['cantidad_facturada'],
                        'precio_unitario' => $row['precio_unitario'],
                        'Total_factura' => $row['Total_factura']
                    ];
                }
                $stmt->close();
                return $productos;
            }
        } catch (\mysqli_sql_exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}

// $d = new DetalleFacturaDAO();
// print_r(
// $d->mostrarDetalle(3));
