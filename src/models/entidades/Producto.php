<?php
namespace App\Models\Entidades;

class Producto{
    public $id;
    public $proveedor;
    public $nombre;
    public $precio;

    function __construct($pId, $pProveedor, $pNombre, $pPrecio ){
        $this -> id = $pId;
        $this -> proveedor = $pProveedor;
        $this -> nombre = $pNombre;
        $this -> precio = $pPrecio;
    }
}
