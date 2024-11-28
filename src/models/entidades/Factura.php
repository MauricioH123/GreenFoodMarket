<?php
namespace App\Models\Entidades;

class Factura {
    public $id_factura;
    public $id_cliente;
    public $fecha;
    public $detalles; // Array de objetos DetalleFactura

    public function __construct($id_factura = null, $id_cliente = null, $fecha = null) {
        $this->id_factura = $id_factura;
        $this->id_cliente = $id_cliente;
        $this->fecha = $fecha;
        $this->detalles = [];
    }

    // Método para agregar detalles
    public function agregarDetalle(DetalleFactura $detalle) {
        $detalle->id_factura = $this->id_factura; // Asigna el ID de factura al detalle
        $this->detalles[] = $detalle;
    }
}

