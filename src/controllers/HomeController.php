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

    public function mostrarVentasDiarias()
    {
        $ventasMensuales = $this->detalleService->ventasDiarias();
        $ventasChartkick = [];
        foreach ($ventasMensuales as $dato) {
            $ventasChartkick[$dato['fecha']] = $dato['ventas'];
        }
        $jsonVentas = json_encode($ventasChartkick);
        $this->view->render($jsonVentas);
    }
}