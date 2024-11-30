<?php
namespace App\Controllers;

use App\Views\HomeView;
use App\Models\Logica\DetalleService;


class HomeController{
    private $view;
    private $detalleService;
    public function __construct(){
        $this -> view = new HomeView();
        $this->detalleService = new DetalleService();
    }

    public function mostrarVentas()
    {
        $ventasDiarias = $this->detalleService->ventasDiarias();
        $ventasD = [];
        foreach ($ventasDiarias as $dato) {
            $ventasD[$dato['fecha']] = $dato['ventas'];
        }
        
        $ventasMensuales = $this->detalleService->ventasMensuales();
        $ventasChartkick = [];
        foreach ($ventasMensuales as $dato) {
            $ventasChartkick[$dato['mes']] = $dato['ventas'];
        }

        $comprasDiarias = $this->detalleService->comprasDiarias();
        $comprasD = [];
        foreach ($comprasDiarias as $dato) {
            $comprasD[$dato['fecha']] = $dato['total'];
        }

        $comprasMensuales = $this->detalleService->comprasMensuales();
        $comprasM = [];
        foreach ($comprasMensuales as $dato) {
            $comprasM[$dato['mes']] = $dato['compra'];
        }
        
        $jsonVentasDiaria = json_encode($ventasD);
        $jsonComprasDiaria = json_encode($comprasD);
        $jsonVentasMensuales = json_encode($ventasChartkick);
        $jsonComprasMensuales = json_encode($comprasM);

        $this->view->render($jsonVentasDiaria, $jsonVentasMensuales, $jsonComprasDiaria,$jsonComprasMensuales);
    }
}