<?php
namespace App\Models\Entidades;

class Proveedor{
    public $id_proveedor;
    public $nombre_proveedor;

    function __construct($pId, $pNombre){
        $this -> id_proveedor = $pId;
        $this -> nombre_proveedor = $pNombre;
    }
}
