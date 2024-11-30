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
        $jsonVentasDiaria = json_encode($ventasD);
        $jsonVentasMensuales = json_encode($ventasChartkick);

        $this->view->render($jsonVentasDiaria, $jsonVentasMensuales);
    }
}