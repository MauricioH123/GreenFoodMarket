<?php
namespace App\Models\Logica;

use App\Models\Persistence\DetalleFacturaDAO;

class DetalleService{
    private $detalleFacturaDAO;

    public function __construct(){
        $this ->detalleFacturaDAO =new DetalleFacturaDAO();
    }

    public function crearFactura($id_factura, $id_producto, $cantidad, $precio_unitario){
        return $this ->detalleFacturaDAO->insertarDetalleFactura($id_factura, $id_producto, $cantidad, $precio_unitario);
    }
}