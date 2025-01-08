<?php 

namespace app\core;

class Controller 
{
    public function view(string $view, array $params = null)
    {
        if($params != null) extract($params);
        require_once __DIR__ ."/../views/$view.php";
    }
}