<?php
namespace App\Models\Persistence;

use App\Models\Entidades\Proveedor;
use App\Database\Database;

// require_once "/laragon/www/greend-food/vendor/autoload.php";

class ProveedorDAO{
    private $conn;

    public function __construct(){
        $baseDeDato = new Database();
        $this -> conn = $baseDeDato ->abrir();
    }

    function sanitizeMysql($connection, $string){
        $string =$connection->real_escape_string($string);
        $string = strip_tags($string);
        $string = htmlentities($string);
        return $string;
    }

    public function obtenerProveedor(){
        $query = "SELECT * FROM proveedores;";
        $stmt = $this -> conn ->prepare($query);
        $stmt ->execute();
        $resultado = $stmt -> get_result();
        
        $proveedores = array();
        while($row = $resultado -> fetch_assoc()){
            $proveedores[] = new Proveedor($row['id_proveedor'], $row['nombre_proveedor']);
        }
        $stmt ->close();
        
        return $proveedores;
    }

    public function eliminarProveedor($id_proveedor){
        try{
            $query = "CALL eliminar_proveedor(?);";
            $stmt = $this ->conn->prepare($query);
            $stmt ->bind_param("i", $id_proveedor);
            if($stmt -> execute()){
                $stmt->close();
                return "Proveedor eliminado exitosamente";
            }else{
                $stmt->close();
                return "Fallo al eliminacion del proveedor";
            }
        }catch(\mysqli_sql_exception $e){
            return "Error: " . $e->getMessage();
        }

    }

    public function editarProveedor($id_proveedor, $nombre_proveedor){
        $id_proveedor = ucwords($this -> sanitizeMysql($this ->conn,$id_proveedor));
        $nombre_proveedor = ucwords($this -> sanitizeMysql($this ->conn,$nombre_proveedor));

        try{
            $query = "CALL actualizarProveedor(?,?)";
            $stmt = $this -> conn ->prepare($query);
            $stmt ->bind_param('is',$id_proveedor, $nombre_proveedor);
            if($stmt -> execute()){
                $stmt -> close();
                return "Se actualizo el proveedor";
            }else{
                $stmt -> close();
                return "Fallo al actualizar el proveedor";
            }
        }catch(\mysqli_sql_exception $e){
            return "Error: " . $e->getMessage();
        }
    }

    public function crearProveedor($nombre_proveedorr){
        $nombre_proveedor =ucwords($this -> sanitizeMysql($this ->conn,$nombre_proveedorr));
        try{
            $query = "CALL insertar_proveedor(?);";
            $stmt = $this -> conn -> prepare($query);
            $stmt -> bind_param("s", $nombre_proveedor);
            if($stmt ->execute()){
                $stmt -> close();
                return "Se creo el proveedor con exito";
            }
        }catch(\mysqli_sql_exception $e){
            return "Error: " . $e->getMessage();
        }
    }
}

// $p = new ProveedorDAO();
// echo 
// $p ->crearProveedor("Mauriciodf sdjkfs dskjf");