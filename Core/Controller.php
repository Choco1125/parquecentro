<?php

    class Controller{

        public $view;
        public $model;

        function __construct(){
            $this->view = new View();
        }

        function load_model($name){
            $file_model = 'Models/'.$name.'.php';
            if(file_exists($file_model)){
                $model_name = $name.'Model';
                require $file_model;
                $this->model = new $model_name();
            }
        }

    }