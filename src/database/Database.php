<?php
namespace src\Database;

use mysqli;
class Database {
    private $host = 'localhost';
    private $nombrebd = 'greend';
    private $usuario = 'root';
    private $contraseña = '';
    private $resultado ;
    private $conn;

    function abrir(){
        $this -> conn = new mysqli($this -> host, $this->usuario, $this->contraseña, $this ->nombrebd);

        if($this->conn ->connect_error){
            die("Error en la conexion: ". $this-> conn -> connect_error);
        }else{
            echo "Conexion exitosa a la base de datos.<br>";
        }
    }

    function ejecutar($sentencia){
        $this -> resultado = $this -> conn -> query($sentencia);
    }

    function cerrar(){
        $this -> conn -> close();
    }
}

// $b = new Database();
// $b -> abrir();