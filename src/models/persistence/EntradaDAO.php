<?php
namespace App\Models\Persistence;

use App\Models\Entidades\Entrada;
use App\Database\Database;

class EntradaDAO{
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

    public function crearEntrada($id_producto, $cantidad_entrada, $precio_entrada, $fecha_entrada){
        $id_producto = $this -> sanitizeMysql($this -> conn,$id_producto);
        $cantidad_entrada = $this -> sanitizeMysql($this -> conn,$cantidad_entrada);
        $precio_entrada = floatval($this -> sanitizeMysql($this -> conn,$precio_entrada));
        $fecha_entrada = $this -> sanitizeMysql($this -> conn,$fecha_entrada);

        try{
            $query = "CALL insertar_entradas(?,?,?,?);";
            $stmt = $this -> conn ->prepare($query);
            $stmt ->bind_param('iids', $id_producto, $cantidad_entrada, $precio_entrada, $fecha_entrada);
            if($stmt -> execute()){
                $stmt -> close();
                return "Entrada creada exitosamente";
            }else{
                $stmt -> close();
                return "Fallo al crear la entrada";
            }
        }catch(\mysqli_sql_exception $e){
            return "Error: ". $e -> getMessage();
        }
    }
}