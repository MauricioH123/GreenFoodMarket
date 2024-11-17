<?php

namespace App\Models\Persistence;
use App\Database\Database;
use App\Models\Entidades\Cliente;

class ClienteDAO{
    private $conn;

    public function __construct(){
        $basededatos = new Database();
        $this -> conn = $basededatos -> abrir();
    }

    function sanitizeMysql($connection, $string){
        $string =$connection->real_escape_string($string);
        $string = strip_tags($string);
        $string = htmlentities($string);
        return $string;
    }

    public function obtenerClientes(){
        $query = "SELECT * FROM clientes";
        $stmt = $this -> conn -> prepare($query);
        $stmt -> execute();
        $resultado = $stmt -> get_result();
        
        $clientes = array();
        while($row = $resultado -> fetch_assoc()){
            $clientes[] = new Cliente($row['id_cliente'], $row['nombre'],$row['numero_celular'], $row['correo'], $row['direccion']);
        }
        $stmt->close();
        return $clientes;
    }
}

