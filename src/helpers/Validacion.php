<?php
namespace App\Helpers;
 class Validacion{

    public static function validarPrecio($precio){
        return is_numeric($precio) && $precio > 0;
    }

    public static function validarNombre($nombre){
        return !empty($nombre) && strlen($nombre) <= 150;
    }

    public static function validarProveedor($provedorId){
        return is_numeric($provedorId) && $provedorId >0;
    }
 }