<?php
require_once './vendor/autoload.php';

use App\Controllers\ProductoController;
use App\Controllers\HomeController;

$action  = isset($_GET['action'])? $_GET['action']: 'Null';

switch($action){
    case 'producto':
        $controller = new ProductoController();
        $controller -> mostrarProductos();
        break;
    case 'Null':
        $controller = new HomeController();
        $controller ->index();
}
