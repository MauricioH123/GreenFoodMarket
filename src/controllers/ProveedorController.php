<?php
namespace App\Controllers;
use App\Models\Logica\ProveedorService;
use App\Views\ProveedorCrearView;
use Respect\Validation\Validator as v;

class ProveedorController{
    private $proveedoreService;
    private $view;

    public function __construct(){
        $this -> proveedoreService = new ProveedorService();
        $this -> view = new ProveedorCrearView();
    }

    public function mostrarFormulario($mensaje = ""){
        $this -> view->render($mensaje);
        
    }

    public function crearProveedor($nombre_proveedor){
        if(!v::stringType()->notEmpty()->validate($nombre_proveedor)){
            $this -> view ->render("Error: El nombre del proveedor es inválido");
            return;
        }
        $crearP = $this -> proveedoreService -> crearProveedor($nombre_proveedor);
        $this -> view ->render($crearP);
    }
}