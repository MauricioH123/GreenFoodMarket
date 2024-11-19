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

    public function actualizarCliente($id_cliente, $nombre, $numero_celular, $correo, $direccion){
        return $this -> clienteDAO ->editarClientes($id_cliente, $nombre, $numero_celular, $correo, $direccion);
    }

    public function agregarNuevoCliente($nombre, $numero_celular, $correo, $direccion){
        return $this ->clienteDAO ->crearCliente($nombre, $numero_celular, $correo, $direccion);
    }
}