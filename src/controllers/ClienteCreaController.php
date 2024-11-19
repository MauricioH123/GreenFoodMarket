<?php
namespace App\Controllers;

use App\Models\Logica\ClienteService;
use App\Helpers\Validacion;
use App\Views\ClienteCrearView;

class ClienteCreaController{

    public $clienteServicio;
    public $view;

    public function __construct(){
        $this -> clienteServicio = new ClienteService();
        $this -> view = new ClienteCrearView();
    }

    public function mostrarFormulario($mensaje = ""){
        $this -> view->render($mensaje);
    }

    public function crearCliente($nombre, $numero_celular, $correo, $direccion){
        if(!Validacion::validarNombre($nombre)){
            $this -> view ->render("Error: El nombre del cliente es inválido");
            return;
        }

        if(!Validacion::validarNumero($numero_celular)){
            $this -> view ->render("Error: El numero de celular es invalido");
            return;
        }

        if(!Validacion::validarCorreo($correo)){
            $this -> view ->render("Error: El correo es invalido");
            return;
        }

        if(!Validacion::validarNombre($direccion)){
            $this -> view ->render("Error: La direccion es invalida");
            return;
        }

        $crearC = $this -> clienteServicio ->agregarNuevoCliente($nombre, $numero_celular, $correo, $direccion);
        $this -> view ->render($crearC);
    }
}