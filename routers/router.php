<?php

function load(string $controller, string $action)
{
    
    try{
        //se controller existe
        $controllerNamespace = "app\\controllers\\{$controller}";
    
        if(!class_exists($controllerNamespace))
        {
            throw new Exception("O controller $controller não existe");
        }
    
        $controllerInstance = new $controllerNamespace();
    
        if(!method_exists($controllerInstance, $action))
        {
            throw new Exception("O metodo $action não existe no controller $controller");
        }

        $controllerInstance->$action((object) $_REQUEST, $_FILES);
        
    }catch(Exception $e)
    {
        echo $e->getMessage();
    }


}//end load

$router = [
    'GET' => [
        "/" => fn()=> load("HomeController", "index"),
        "/contact" => fn()=> load("ContactController", "index")
    ],
    'POST' => [
        "/contact" => fn()=> load("ContactController", "store"),
        "/upload" => fn()=> load("ContactController", "upload"),
    ],
];


