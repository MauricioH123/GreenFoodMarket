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

    public function detallesFacturas($id_factura){
        return $this -> detalleFacturaDAO ->mostrarDetalle($id_factura);
    }

    public function ventasDiarias(){
        return $this ->detalleFacturaDAO ->ventasDiarias();
    }

    public function ventasMensuales(){
        return $this ->detalleFacturaDAO ->ventasMensuales();
    }

    public function comprasDiarias(){
        return $this ->detalleFacturaDAO ->comprasDiarias();
    }

    public function comprasMensuales(){
        return $this ->detalleFacturaDAO ->comprasMensuales();
    }
}