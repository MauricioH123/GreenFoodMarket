<?php
namespace App\Models\Entidades;

class Cliente{
    public $id_cliente;
    public $nombre;
    public $numero_celular;
    public $correo;
    public $direccion;

    function __construct($cId, $cNombre, $cNumero_celular, $cCorreo,  $cDireccion){
        $this -> id_cliente = $cId;
        $this -> nombre = $cNombre;
        $this -> numero_celular = $cNumero_celular;
        $this -> correo = $cCorreo;
        $this -> direccion = $cDireccion;
    }
}
