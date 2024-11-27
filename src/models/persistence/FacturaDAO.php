<?php
namespace App\Models\Persistence;

use App\Models\Entidades\Factura;
use App\Database\Database;

class FacturaDAO{
    private $conn;

    public function __construct(){
        $baseDeDatos = new Database();
        $this -> conn = $baseDeDatos ->abrir();
    }

    function sanitizeMysql($connection, $string){
        $string =$connection->real_escape_string($string);
        $string = strip_tags($string);
        $string = htmlentities($string);
        return $string;
    }

    public function crearFactura($id_clientes,$fecha){
        $id_clientes = $this ->sanitizeMysql($this -> conn, $id_clientes);
        $fecha = $this ->sanitizeMysql($this -> conn, $id_clientes);
        
        try{
            $query = 'CALL insertar_factura(?,?);';
            $stmt = $this -> conn ->prepare($query);
            $stmt ->bind_param('is', $id_clientes, $fecha);
            if($stmt ->execute()){
                $stmt ->close();
                return "Se creo la factura";
            }else{
                $stmt -> close();
                return "Fallo al crear la factura";
            }
        }catch(\mysqli_sql_exception $e){
            return "Error: " . $e->getMessage();
        }
    }

    public function 
}