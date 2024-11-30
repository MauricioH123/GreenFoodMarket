<?php

namespace App\Controllers;

use App\Models\Logica\DetalleService;
use App\Views\DetalleFacturaView;
use App\Models\Logica\FacturaService;
use App\Models\Logica\ProductoService;
use App\Views\DetalleDefacturasCliente;
use App\Views\ImprimirDetalleDeFactura;
use App\Views\HomeView;

class DetalleFacturaCreaController
{
    private $detalleService;
    private $view;
    private $facturaService;
    private $productos;
    private $detalleFacturasClientes;
    private $imprimirDetalleDeFactura;
    private $homeView;

    public function __construct()
    {
        $this->detalleService = new DetalleService();
        $this->view = new DetalleFacturaView();
        $this->facturaService = new FacturaService();
        $this->productos = new ProductoService();
        $this->detalleFacturasClientes = new DetalleDefacturasCliente();
        $this->imprimirDetalleDeFactura = new ImprimirDetalleDeFactura();
        $this->homeView = new HomeView();
    }

    public function mostrarFormulario($mensaje = "")
    {
        $facturas = $this->facturaService->mostrarFactura();
        $productos = $this->productos->listadoProductos();
        $this->view->render($mensaje, $facturas, $productos);
    }

    public function crearDetalle($id_factura, $id_producto, $cantidad, $precio_unitario)
    {
        $crearD = $this->detalleService->crearFactura($id_factura, $id_producto, $cantidad, $precio_unitario);
        header("Location: index.php?action=facturaD");
    }

    public function mostrarDetalleFactua($id_factura, $nombre, $id_facturaMostrar)
    {
        $facturasDetalle = $this->detalleService->detallesFacturas($id_factura);
        $this->detalleFacturasClientes->render($facturasDetalle, $nombre, $id_facturaMostrar);
    }

    public function imprimirDetalle($id_factura, $nombre, $id_facturaMostrar)
    {
        $facturasDetalle = $this->detalleService->detallesFacturas($id_factura);
        $this->imprimirDetalleDeFactura->render($facturasDetalle, $nombre, $id_facturaMostrar);
    }

    public function mostrarVentasMensuales()
    {
        $ventasMensuales = $this->detalleService->ventasMensuales();
        $ventasChartkick = [];
        foreach ($ventasMensuales as $dato) {
            $ventasChartkick[$dato['fecha']] = $dato['ventas'];
        }
        $jsonVentas = json_encode($ventasChartkick);
        $this->homeView->render($jsonVentas);
    }
}
