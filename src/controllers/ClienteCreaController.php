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

    public function crearCliente($nombre, $numero_celular, $correo, $direccion){
        
    }
}