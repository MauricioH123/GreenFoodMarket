<?php
namespace App\Controllers;

use App\Models\Logica\EntradaService;
use App\Views\EntradaCrearView;
use Respect\Validation\Validator as v;

class EntradaCrearController{
    private $entradaSercie;
    private $view;

    public function __construct(){
        $this -> entradaSercie = new EntradaService();
        $this -> view = new EntradaCrearView();
    }

    public function mostrarFormulario($mensaje = ""){
        $this -> view->render($mensaje);
    }

    public function validarFormulario($id_producto, $cantidad_entrada, $precio_entrada, $fecha_entrada){

    }
}