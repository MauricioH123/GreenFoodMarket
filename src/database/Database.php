<?php
namespace App\Database;

use mysqli;
class Database {
    private $host = 'localhost';
    private $nombrebd = 'greend';
    private $usuario = 'root';
    private $contraseña = '';
    private $conn;

    function abrir(){
        $this -> conn = new mysqli($this -> host, $this->usuario, $this->contraseña, $this ->nombrebd);

        if($this->conn ->connect_error){
            die("Error en la conexion: ". $this-> conn -> connect_error);
        }

        return $this ->conn;
    }
}

// $b = new Database();
// $b -> abrir();