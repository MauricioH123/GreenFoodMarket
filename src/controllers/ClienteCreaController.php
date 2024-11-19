<?php
namespace App\Controllers;

use App\Models\Logica\ClienteService;
use App\Views\ProductoCrearView;
use App\Helpers\Validacion;

class ClienteCreaController{

    public $clienteServicio;
    public $view;

    public function __construct(){
        $this -> clienteServicio = new ClienteCreaController();
        $this -> view = new ProductoCrearView();
    }

    public function mostrarFormulario($mensaje = ""){
        $this -> view->render($mensaje);
    }

    public function crearCliente($nombre, $numero_celular, $correo, $direccion){
        if(!Validacion::validarNombre($nombre)){
            $this -> view ->render("Error: El nombre del producto es inválido");
        }

        if(!Validacion::validarNumero($numero_celular)){
            $this -> view ->render("Error: El numero de celular es invalido");
        }

        if(!Validacion::validarCorreo($correo)){
            $this -> view ->render("Error: El correo es invalido");
        }

        if(!Validacion::validarNumero($direccion)){
            $this -> view ->render("Error: La direccion es invalida");
        }

        $crearC = $this -> clienteServicio ->crearCliente($nombre, $numero_celular, $correo, $direccion);
        $this -> view ->render($crearC);
    }
}