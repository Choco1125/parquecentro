<?php
    
    class View{

        public $title;
        public $active;

        function render($view){
            require 'Views/'.$view.'.php';
        }

        function set_title($title){
            $this->title = $title;
        }

        function set_active($value){
            $this->active=$value;
        }
    }