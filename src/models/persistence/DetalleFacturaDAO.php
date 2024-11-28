<?php
namespace App\Models\Persistence;

use PDO;

class DetalleFacturaDAO {
    private $db;

    public function __construct($db) {
        $this->db = $db; // Conexión a la base de datos
    }

    /**
     * Inserta un detalle de factura en la tabla `detalle_facturas`.
     * @param int $id_factura
     * @param int $id_producto
     * @param int $cantidad
     * @param float $precio_unitario
     */
    public function insertarDetalleFactura($id_factura, $id_producto, $cantidad, $precio_unitario) {
        $sql = "INSERT INTO detalle_facturas (id_factura, id_producto, cantidad_facturada, precio_unitario) 
                VALUES (:id_factura, :id_producto, :cantidad, :precio_unitario)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_factura', $id_factura, PDO::PARAM_INT);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':precio_unitario', $precio_unitario, PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * Recupera los detalles de una factura por el ID de factura.
     * @param int $id_factura
     * @return array Lista de detalles de la factura
     */
    public function obtenerDetallesPorFactura($id_factura) {
        $sql = "SELECT * FROM detalle_facturas WHERE id_factura = :id_factura";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_factura', $id_factura, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
