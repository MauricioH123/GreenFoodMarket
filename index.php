<?php
require_once './vendor/autoload.php';

use App\Controllers\ProductoController;
use App\Controllers\HomeController;
use App\Controllers\PoductoCreaController;

$action  = isset($_GET['action'])? $_GET['action']: 'Null';

switch($action){
    case 'producto':
        $controller = new ProductoController();
        $controller -> mostrarProductos();
        break;
    case 'Null':
        $controller = new HomeController();
        $controller ->index();
        break;
    case 'crearP':
        $controller = new PoductoCreaController();
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $id_proveedor = $_POST['id_proveedor'];
            $nombre_producto = $_POST['nombre_producto'];
            $precio_venta = $_POST['precio_venta'];
            $controller->crearProducto($id_proveedor, $nombre_producto, $precio_venta);
        }else{
            $controller->mostrarFormulario();
        }
        break;
}
