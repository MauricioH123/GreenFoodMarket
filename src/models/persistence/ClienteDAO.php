<?php

namespace App\Models\Persistence;
use App\Database\Database;
use App\Models\Entidades\Cliente;

require_once "/laragon/www/greend-food/vendor/autoload.php";

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
            $clientes[] = new Cliente(stripslashes($row['id_cliente']), stripslashes($row['nombre']),stripslashes($row['numero_celular']), stripslashes($row['correo']), stripslashes($row['direccion']));
        }
        $stmt->close();
        return $clientes;
    }

    public function eliminarClientes($id_cliente){
        $id_cliente = $this -> sanitizeMysql($this ->conn,$id_cliente);
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

    public function editarClientes($id_cliente, $nombre, $numero_celular, $correo, $direccion){
        $id_cliente = ucwords($this -> sanitizeMysql($this ->conn,$id_cliente));
        $nombre = ucwords($this -> sanitizeMysql($this ->conn,$nombre));
        $numero_celular = ucwords($this -> sanitizeMysql($this ->conn,$numero_celular));
        $correo = strtolower($this -> sanitizeMysql($this ->conn,$correo));
        $direccion = ucwords($this -> sanitizeMysql($this ->conn,$direccion));
        try{
            $query = 'CALL actualizarClientes(?,?,?,?,?);';
            $stmt = $this ->conn ->prepare($query);
            $stmt -> bind_param('issss', $id_cliente, $nombre, $numero_celular, $correo, $direccion);
            if($stmt -> execute()){
                $stmt -> close();
                return "Se actualizo el clientes";
            }else{
                $stmt -> close();
                return "Fallo al actualizar el clientes";
            }
        }catch(\mysqli_sql_exception $e){
            return "Error: ". $e -> getMessage();
        }
    }

    public function crearCliente($nombre, $numero_celular, $correo, $direccion){
        $nombre = ucwords($this -> sanitizeMysql($this ->conn,$nombre));
        $numero_celular = ucwords($this -> sanitizeMysql($this ->conn,$numero_celular));
        $correo = strtolower($this -> sanitizeMysql($this ->conn,$correo));
        $direccion = ucwords($this -> sanitizeMysql($this ->conn,$direccion));

        
        try{
            $query = 'CALL insertar_clientes(?,?,?,?);';
            $stmt = $this -> conn -> prepare($query);
            $stmt ->bind_param('ssss', $nombre, $numero_celular, $correo, $direccion);
            if($stmt -> execute()){
                $stmt -> close();
                return "Se agrego el nuevo cliente";
            }else{
                $stmt -> close();
                return "Fallo al agregar el cliente";
            }
        }catch(\mysqli_sql_exception $e){
            return "Error: ". $e ->getMessage();
        }
    }
}

// $dd = new ClienteDAO();
// echo $dd ->editarClientes(4, 'Lusmila', '0', 'lusmilaejemplo@gmail.com', 'calle 15 # 58-85');

