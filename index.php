<?php
require_once './vendor/autoload.php';

use App\Controllers\ProductoController;
use App\Controllers\HomeController;
use App\Controllers\PoductoCreaController;
use App\Controllers\ClienteListarController;

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
    case 'eliminarP':
        $controller = new ProductoController();
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $id_producto = $_POST['deleteP'];
            $controller->eliminarPorductoC($id_producto) ;
        }
        header("Location: index.php?action=producto");
        exit;
    case 'clienteL':
        $controller = new ClienteListarController();
        $controller -> mostrarClientes();
        break;
    case 'eliminarC':
        $controller = new ClienteListarController();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id_cliente = $_POST['deleteC'];
            $controller -> eliminarClientes($id_cliente);
        }
        header("Location: index.php?action=clienteL");
        exit;
}
