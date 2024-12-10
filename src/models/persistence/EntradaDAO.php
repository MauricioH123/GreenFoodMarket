<?php
namespace App\Models\Persistence;
// require_once "/laragon/www/proyectos/GreenFoodMarket/vendor/autoload.php";

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

    public function mostrarDetalle(){
        try{
            $query="SELECT
            e.fecha_entrada,
            SUM(e.precio_entrada * e.cantidad_entrada) AS compras
            FROM
            entradas AS e
            GROUP BY
            e.fecha_entrada;";
            $stmt = $this -> conn -> prepare($query);
            if($stmt->execute()){
                $resultado = $stmt -> get_result();
                $entradas = array();
                while($row = $resultado->fetch_assoc()){
                    $entradas[] = [
                        "fecha_entrada"=> $row["fecha_entrada"],
                        "compras"=> $row["compras"],
                    ];
            }
            $stmt->close();
            return $entradas;
        }

        }catch(\mysqli_sql_exception $e){
            return "Error: ". $e -> getMessage();
        }
    }
}

// $d = new EntradaDAO();
// print_r(
// $d->mostrarDetalle());