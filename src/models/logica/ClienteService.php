<?php
namespace App\Models\Logica;

use App\models\persistence\ClienteDAO;

class ClienteService{
    private $clienteDAO;

    public function __construct(){
        $this->clienteDAO = new ClienteDAO();
    }

    public function listarClientes(){
        return $this -> clienteDAO ->obtenerClientes();
    }

    public function eliminarProducto($id_cliente){
        return $this ->clienteDAO ->eliminarClientes($id_cliente);
    }
}