<?php
namespace App\Models\Entidades;

class DetalleFactura {
    public $id_detalle_factura;
    public $id_factura;
    public $id_producto;
    public $cantidad_facturada;
    public $precio_unitario;

    public function __construct($id_detalle_factura = null, $id_factura = null, $id_producto = null, $cantidad_facturada = null, $precio_unitario = null) {
        $this->id_detalle_factura = $id_detalle_factura;
        $this->id_factura = $id_factura;
        $this->id_producto = $id_producto;
        $this->cantidad_facturada = $cantidad_facturada;
        $this->precio_unitario = $precio_unitario;
    }
}
