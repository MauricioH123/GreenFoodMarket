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

    public function eliminarClientes($id_cliente){
        try{
            $query = "CALL eliminar_cliente(?);";
            $stmt = $this -> conn -> prepare($query);
            $stmt -> bind_param("i", $id_cliente);
            if ($stmt -> execute()) {
                $stmt -> close();
                return "Cliente eliminado";
            }else{
                $stmt -> close();
                return "Fallo al eliminar el Cliente";
            }
        }catch(\mysqli_sql_exception $e){
            return "Error." . $e->getMessage();
        }
    }
}

