<?php
namespace App\Models\Logica;

use App\Models\Persistence\EntradaDAO;

class EntradaService{
    private $entradaDAO;

    public function __construct(){
        $this -> entradaDAO = new EntradaDAO();
    }

    public function creacionDEntarda($id_producto, $cantidad_entrada, $precio_entrada, $fecha_entrada){
        return $this -> entradaDAO ->crearEntrada($id_producto, $cantidad_entrada, $precio_entrada, $fecha_entrada);
    }
}