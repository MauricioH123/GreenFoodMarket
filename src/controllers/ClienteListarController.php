<?php
namespace App\Controllers;

use App\Models\Logica\ClienteService;
use App\Views\ClientesListaView;

class ClienteListarController{
    private $clienteServicio;
    private $view;

    public function __construct(){
        $this -> clienteServicio = new ClienteService();
        $this -> view = new ClientesListaView();
    }

    public function mostrarClientes(){
        $clientes = $this -> clienteServicio ->listarClientes();
        $this -> view ->render($clientes);
    }
}