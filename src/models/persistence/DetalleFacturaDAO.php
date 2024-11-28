<?php

namespace App\Models\Persistence;

use App\Database\Database;

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
}
