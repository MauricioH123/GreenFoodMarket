<?php
namespace App\Controllers;

use App\Models\Logica\EntradaService;
use App\Views\EntradaCrearView;
use Respect\Validation\Validator as v;

class EntradaCrearController{
    private $entradaService;
    private $view;

    public function __construct(){
        $this -> entradaService = new EntradaService();
        $this -> view = new EntradaCrearView();
    }

    public function mostrarFormulario($mensaje = ""){
        $this -> view->render($mensaje);
    }

    public function validarFormulario($id_producto, $cantidad_entrada, $precio_entrada, $fecha_entrada){
        if(!v::positive()->validate($id_producto)){
            return "El id del producto es invalido";
        }

        if(!v::positive()->validate($cantidad_entrada)){
            return "La cantidad unitaria del producto es invalido";
        }

        if(!v::positive()->validate($precio_entrada)){
            return "El precio del producto es invalido";
        }

        if(!v::date('Y-m-d')->validate($fecha_entrada)){
            return "La fecha de ingreso  del producto es invalido";
        }

        $crearE = $this -> entradaService ->creacionDEntarda($id_producto, $cantidad_entrada, $precio_entrada, $fecha_entrada);
        $this -> view ->render($crearE);
    }
}