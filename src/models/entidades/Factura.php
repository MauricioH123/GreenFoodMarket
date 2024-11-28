<?php
namespace App\Models\Entidades;

class Factura {
    public $id_factura;
    public $id_cliente;
    public $fecha;

    public function __construct($id_factura = null, $id_cliente = null, $fecha = null) {
        $this->id_factura = $id_factura;
        $this->id_cliente = $id_cliente;
        $this->fecha = $fecha;
    }
}
