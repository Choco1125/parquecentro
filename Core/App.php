<?php
class App{
    function __construct(){
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        if(empty($url[0])){
            require 'Controllers/Main.php';
            $this->controller = new Main();
            $this->controller->render();
            return false;
        }

        $url[0] = ucfirst($url[0]);
        $archivo = 'Controllers/'.$url[0].'.php';
        if(file_exists($archivo)){
            require $archivo;
            $controller =  new $url[0];

            $parameters_number = sizeof($url);
            if($parameters_number>1){
                if($parameters_number>2){
                    $parameters = [];

                    for($i=2; $i<$parameters_number;$i++){
                        array_push($parameters,$url[$i]);
                    }

                    $controller->{$url[1]}($parameters);
                }else{
                    $controller->{$url[1]}();
                }
            }else{
                $controller->render();
            }
        }else{
            require 'Controllers/Err.php';
            $err = new Err();
            $err->render();
        }

    }
}
