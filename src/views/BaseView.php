<?php
namespace App\Views;

class BaseView{
    protected function renderTemplate($content){
        require_once(__DIR__ . '/../includes/header.php');
        echo $content;
    }
}