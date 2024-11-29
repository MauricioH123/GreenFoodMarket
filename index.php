<?php
require_once './vendor/autoload.php';

use App\Controllers\ClienteCreaController;
use App\Controllers\EntradaCrearController;
use App\Controllers\ProductoController;
use App\Controllers\HomeController;
use App\Controllers\PoductoCreaController;
use App\Controllers\ClienteListarController;
use App\Controllers\ProveedorListarController;
use App\Controllers\ProveedorController;
use App\Controllers\InventarioListarController;
use App\Controllers\FacturaCrearController;
use App\Controllers\DetalleFacturaCreaController;

$action  = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'producto':
        $controller = new ProductoController();
        $controller->mostrarProductos();
        break;
    case 'crearP':
        $controller = new PoductoCreaController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_proveedor = $_POST['id_proveedor'];
            $nombre_producto = $_POST['nombre_producto'];
            $precio_venta = $_POST['precio_venta'];
            $controller->crearProducto($id_proveedor, $nombre_producto, $precio_venta);
        } else {
            $controller->mostrarFormulario();
        }
        break;
    case 'eliminarP':
        $controller = new ProductoController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_producto = $_POST['deleteP'];
            $controller->eliminarPorductoC($id_producto);
        }
        header("Location: index.php?action=producto");
        exit;
    case 'clienteL':
        $controller = new ClienteListarController();
        $controller->mostrarClientes();
        break;
    case 'eliminarC':
        $controller = new ClienteListarController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_cliente = $_POST['deleteC'];
            $controller->eliminarClientes($id_cliente);
        }
        header("Location: index.php?action=clienteL");
        exit;
    case 'actualizarC':
        $controller = new ClienteListarController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_cliente = $_POST['id_cliente'];
            $nombre = $_POST['nombre'];
            $numero_celular = $_POST['numero_celular'];
            $correo = $_POST['correo'];
            $direccion = $_POST['direccion'];
            $controller->actualizarClientes($id_cliente, $nombre, $numero_celular, $correo, $direccion);
        }
        header("Location: index.php?action=clienteL");
        exit;
    case 'clienteC':
        $controller = new ClienteCreaController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $numero_celular = $_POST['numero_celular'];
            $correo = $_POST['correo'];
            $direccion = $_POST['direccion'];
            $controller->crearCliente($nombre, $numero_celular, $correo, $direccion);
        } else {
            $controller->mostrarFormulario();
        }
        break;
    case 'proveedorL':
        $controller = new ProveedorListarController();
        $controller->mostrarProveedor();
        break;
    case 'actualizarProve':
        $controller = new ProveedorListarController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_peoveedor = $_POST['id_proveedor'];
            $nombre = $_POST['nombre_proveedor'];
            $controller->editarProveedor($id_peoveedor, $nombre);
        }
        header("Location: index.php?action=proveedorL");
        exit;
    case 'eliminarProve':
        $controller = new ProveedorListarController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_proveedor = $_POST['id_proveedor'];
            $controller->eliminarProveedor($id_proveedor);
        }
        header("Location: index.php?action=proveedorL");
        exit;
    case 'proveedorC':
        $controller = new ProveedorController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre_proveedor = $_POST['nombre_proveedor'];
            $controller->crearProveedor($nombre_proveedor);
        } else {
            $controller->mostrarFormulario();
        }
        break;
    case 'inventarioL':
        $controller = new InventarioListarController();
        $controller->mostrarInventario();
        break;
    case 'actualizarInven':
        $controller = new InventarioListarController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_producto = $_POST['id_producto'];
            $cantidad = $_POST['cantidad_producto'];
            $controller->actualizarInventario($id_producto, $cantidad);
        }
        header("Location: index.php?action=inventarioL");
        exit;
    case 'entradaC':
        $controller = new EntradaCrearController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_producto = $_POST['id_producto'];
            $cantidad_entrada = $_POST['cantidad_entrada'];
            $precio_entrada = $_POST['precio_entrada'];
            $fecha_entrada = $_POST['fecha_entrada'];
            $controller->validarFormulario($id_producto, $cantidad_entrada,  $precio_entrada,  $fecha_entrada);
        } else {
            $controller->mostrarFormulario();
        }
        break;
    case 'facturaC':
        $controller = new FacturaCrearController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_clientes = $_POST['id_cliente'];
            $fecha = $_POST['fecha_factura'];
            $controller->crearFactura($id_clientes, $fecha);
        } else {
            $controller->mostrarFormulario();
        }
        break;

    case 'facturaD':
        $controller = new DetalleFacturaCreaController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_factura = $_POST['id_factura'];
            $productos = $_POST['productos'];
            foreach ($productos['id_producto'] as $index => $id_producto) {
                $cantidad = $productos['cantidad'][$index];
                $precio_unitario = $productos['precio'][$index];
            
                // Procesar cada producto
                $controller->crearDetalle($id_factura, $id_producto, $cantidad, $precio_unitario);
            }
            // $controller->crearDetalle($id_factura, $id_producto, $cantidad, $precio_unitario);
        } else {
            $controller->mostrarFormulario();
        }
        break;
    default:
        $controller = new HomeController();
        $controller->index();
        break;
}
