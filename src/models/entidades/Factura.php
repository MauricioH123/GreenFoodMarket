<?php
namespace App\Models\Entidades;

class Factura{
    public $id_factura;
    public $id_clientes;
    public $fecha;

    public function __construct($id_factura,$id_clientes,$fecha ){
        $this -> id_factura = $id_factura;
        $this -> id_clientes = $id_clientes;
        $this -> fecha = $fecha;
    }
}