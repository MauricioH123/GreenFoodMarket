<?php
namespace App\Models\Logica;
use App\Models\Persistence\FacturaDAO;

class FacturaService{

    private $facturaDAO;

    public function __construct(){
        $this ->facturaDAO = new FacturaDAO();
    }

    public function crearFactura($id_clientes,$fecha){
        return $this ->facturaDAO ->crearFactura($id_clientes,$fecha);
    }

    public function mostrarFactura(){
        return $this ->facturaDAO ->mostrarFacturas();
    }

    public function ultimaFactura(){
        return $this ->facturaDAO-> ultimoIdFactura();
    }
}