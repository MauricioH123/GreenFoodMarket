<?php
require_once './vendor/autoload.php';

use App\Controllers\ClienteCreaController;
use App\Controllers\ProductoController;
use App\Controllers\HomeController;
use App\Controllers\PoductoCreaController;
use App\Controllers\ClienteListarController;
use App\Controllers\ProveedorListarController;

$action  = isset($_GET['action'])? $_GET['action']: '';

switch($action){
    case 'producto':
        $controller = new ProductoController();
        $controller -> mostrarProductos();
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
    case 'actualizarC':
        $controller = new ClienteListarController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id_cliente = $_POST['id_cliente'];
            $nombre = $_POST['nombre'];
            $numero_celular = $_POST['numero_celular'];
            $correo = $_POST['correo'];
            $direccion = $_POST['direccion'];
            $controller ->actualizarClientes($id_cliente,$nombre,$numero_celular,$correo,$direccion);
        }
        header("Location: index.php?action=clienteL");
        exit;
    case 'clienteC':
        $controller = new ClienteCreaController();
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $nombre = $_POST['nombre'];
            $numero_celular = $_POST['numero_celular'];
            $correo = $_POST['correo'];
            $direccion = $_POST['direccion'];
            $controller ->crearCliente($nombre,$numero_celular,$correo,$direccion);
        }else{
            $controller ->mostrarFormulario();
        }
        break;
    case 'proveedorL':
        $controller = new ProveedorListarController(); 
        $controller -> mostrarProveedor();
        break;
    default:
        $controller = new HomeController();
        $controller ->index();
        break;
}
