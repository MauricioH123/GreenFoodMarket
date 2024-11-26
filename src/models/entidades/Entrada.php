<?php

namespace App\Models\Entidades;

class Entrada{
    public $id_producto;
    public $cantidad_entrada;
    public $precio_entrada;
    public $fecha_entrada;

    public function __construct($id_producto, $cantidad_entrada, $precio_entrada, $fecha_entrada){
        $this -> id_producto = $id_producto;
        $this -> cantidad_entrada = $cantidad_entrada;
        $this -> precio_entrada = $precio_entrada;
        $this -> fecha_entrada = $fecha_entrada;
    }
}