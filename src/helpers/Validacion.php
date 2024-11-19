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

    public static function validarCorreo($correo) {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return true; // El correo es válido
        } else {
            return false; // El correo no es válido
        }
    }
    
 }