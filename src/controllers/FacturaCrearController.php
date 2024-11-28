<?php
namespace App\Controllers;

use App\Models\Logica\FacturaService;
use App\Views\FacturaCrearView;

class FacturaCrearController{
    private $FacturaService;
    private $view;

    public function __construct(){
        $this ->FacturaService = new FacturaService();
        $this ->view = new FacturaCrearView();
    }

    public function mostrarFormulario($mensaje = ""){
        $this -> view->render($mensaje);
    }
}