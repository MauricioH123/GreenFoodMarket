<?php
namespace App\Models\Persistence;

use App\Models\Entidades\Proveedor;
use App\Database\Database;

require_once "/laragon/www/greend-food/vendor/autoload.php";

class ProveedorDAO{
    private $conn;

    public function __construct(){
        $baseDeDato = new Database();
        $this -> conn = $baseDeDato ->abrir();
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
}

$p = new ProveedorDAO();
print_r( $p ->obtenerProveedor());