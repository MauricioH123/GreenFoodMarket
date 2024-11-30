<?php
namespace App\Controllers;

use App\Models\Logica\FacturaService;
use App\Models\Logica\ClienteService;
use App\Views\FacturaCrearView;
use App\Views\FacturasListar;

class FacturaCrearController{
    private $FacturaService;
    private $view;
    private $clientes;
    private $facturasListar;

    public function __construct(){
        $this ->FacturaService = new FacturaService();
        $this ->view = new FacturaCrearView();
        $this ->clientes = new ClienteService();
        $this ->facturasListar = new FacturasListar();
    }

    public function mostrarFormulario($mensaje = ""){
        $clientes = $this ->clientes ->listarClientes();
        $ultimoIdF = $this ->FacturaService ->ultimaFactura();
        $this -> view->render($mensaje, $clientes,$ultimoIdF);
    }

    public function crearFactura($id_clientes,$fecha){
        $facturaC = $this ->FacturaService ->crearFactura($id_clientes,$fecha);
        $this ->mostrarFormulario($facturaC);
    }

    public function mostrarTotalfacturas(){
        $totalDeFactura = $this ->FacturaService ->mostrarTotalfacturas();
        $this -> facturasListar -> render($totalDeFactura);
    }
}