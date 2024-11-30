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

    public function mostrarDetalle($id_factura)
    {
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
            if ($stmt->execute()) {
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

    public function ventasDiarias()
    {
        try {
            $query = "SELECT 
            t.fecha,
            SUM(t.total_factura) AS ventas
            FROM 
            total_facturas_clientes AS t
            GROUP BY
            t.fecha
            ORDER BY
            t.fecha;";
            $stmt = $this->conn->prepare($query);
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $ventas = array();
                while ($row = $resultado->fetch_assoc()) {
                    $ventas[] = [
                        'fecha' => $row['fecha'],
                        'ventas' => $row['ventas']
                    ];
                }
                $stmt->close();
                return $ventas;
            }
        } catch (\mysqli_sql_exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function ventasMensuales()
    {
        try {
            $query = "SELECT 
            YEAR(t.fecha) AS año,   -- Extraer el año
            MONTH(t.fecha) AS mes,  -- Extraer el mes
            SUM(t.total_factura) AS ventas
            FROM 
            total_facturas_clientes AS t
            GROUP BY
            YEAR(t.fecha), MONTH(t.fecha)  -- Agrupar por año y mes
            ORDER BY
            YEAR(t.fecha), MONTH(t.fecha);  -- Ordenar por año y mes
            ";
            $stmt = $this->conn->prepare($query);
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $ventas = array();
                while ($row = $resultado->fetch_assoc()) {
                    $ventas[] = [
                        'mes' => $row['mes'],
                        'ventas' => $row['ventas']
                    ];
                }
                $stmt->close();
                return $ventas;
            }
        } catch (\mysqli_sql_exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function comprasDiarias()
    {
        try {
            $query = "SELECT 
            e.fecha_entrada AS fecha,
            SUM(e.precio_entrada * e.cantidad_entrada) AS total
            FROM
            entradas AS e
            GROUP BY
            e.fecha_entrada
            ";
            $stmt = $this->conn->prepare($query);
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $compras = array();
                while ($row = $resultado->fetch_assoc()) {
                    $compras[] = [
                        'fecha' => $row['fecha'],
                        'total' => $row['total']
                    ];
                }
                $stmt->close();
                return $compras;
            }
        } catch (\mysqli_sql_exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function comprasMensuales()
    {
        try {
            $query = "SELECT 
    YEAR(e.fecha_entrada) AS año,   -- Extraer el año
    MONTH(e.fecha_entrada) AS mes,  -- Extraer el mes
    SUM(e.cantidad_entrada * e.precio_entrada) AS compra
FROM 
    entradas AS e
GROUP BY
    YEAR(e.fecha_entrada), MONTH(e.fecha_entrada)  -- Agrupar por año y mes
ORDER BY
    YEAR(e.fecha_entrada), MONTH(e.fecha_entrada);  -- Ordenar por año y mes
";
            $stmt = $this->conn->prepare($query);
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $compras = array();
                while ($row = $resultado->fetch_assoc()) {
                    $compras[] = [
                        'mes' => $row['mes'],
                        'compra' => $row['compra']
                    ];
                }
                $stmt->close();
                return $compras;
            }
        } catch (\mysqli_sql_exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}

// $d = new DetalleFacturaDAO();
// print_r(
// $d->ventasMensuales());
