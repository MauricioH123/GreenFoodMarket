<?php
namespace App\Controllers;

use App\Models\Logica\EntradaService;
use App\Views\EntradaCrearView;
use Respect\Validation\Validator as v;
use App\Models\Logica\ProductoService;

class EntradaCrearController{
    private $entradaService;
    private $view;
    private $productoService;

    public function __construct(){
        $this -> entradaService = new EntradaService();
        $this -> view = new EntradaCrearView();
        $this -> productoService = new ProductoService();
    }

    public function mostrarFormulario($mensaje = ""){
        $productos = $this -> productoService ->listadoProductos();
        $this -> view->render($mensaje, $productos);
    }

    public function validarFormulario($id_producto, $cantidad_entrada, $precio_entrada, $fecha_entrada){
        if(!v::positive()->validate($id_producto)){
            $this -> mostrarFormulario("Error: El id del producto es invalido");
            return;
        }

        if(!v::positive()->validate($cantidad_entrada)){
            $this -> mostrarFormulario("Error: La cantidad unitaria del producto es invalido");
            return;
        }

        if(!v::positive()->validate($precio_entrada)){
            $this -> mostrarFormulario("Error: El precio del producto es invalido");
            return;
        }

        if(!v::date('Y-m-d')->validate($fecha_entrada)){
            $this -> mostrarFormulario("Error: La fecha de ingreso del producto es invalido");
            return;
        }

        $crearE = $this -> entradaService ->creacionDEntarda($id_producto, $cantidad_entrada, $precio_entrada, $fecha_entrada);
        $this -> mostrarFormulario($crearE);
    }

    public function excelEntradas(){
        $entradas = $this ->entradaService ->mostrarEntradas();
    }
}