<?php
namespace App\Controllers;

use App\Models\Logica\ClienteService;
use App\Views\ClienteCrearView;
use Respect\Validation\Validator as v;

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
        if(!v::stringType()->notEmpty()->validate($nombre)){
            $this -> view ->render("Error: El nombre del cliente es inválido");
            return;
        }

        if(!v::positive()->validate($numero_celular)){
            $this -> view ->render("Error: El numero de celular es invalido");
            return;
        }

        if(!v::email()->validate($correo)){
            $this -> view ->render("Error: El correo es invalido");
            return;
        }

        if(!v::positive()->validate($direccion)){
            $this -> view ->render("Error: La direccion es invalida");
            return;
        }

        $crearC = $this -> clienteServicio ->agregarNuevoCliente($nombre, $numero_celular, $correo, $direccion);
        $this -> view ->render($crearC);
    }
}