<?php
namespace App\Models\Entidades;

class Inventario{
    public $id_inventario;
    public $id_producto;
    public $cantidad;

    public function __construct($id_inventario, $id_producto,$cantidad){
        $this -> id_inventario = $id_inventario;
        $this -> id_producto = $id_producto;
        $this -> cantidad = $cantidad;
    }

}