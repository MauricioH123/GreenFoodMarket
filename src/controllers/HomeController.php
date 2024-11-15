<?php
namespace App\Controllers;

use App\Views\HomeView;

class HomeController{
    private $view;
    public function __construct(){
        $this -> view = new HomeView();
    }

    public function index(){
        $this -> view ->render();
    }
}