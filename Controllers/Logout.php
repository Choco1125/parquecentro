<?php
    class Logout extends Controller{

        function __construct(){
            parent::__construct();
           

            if(session_status() == PHP_SESSION_NONE ){
                session_start();
            }
            session_destroy();
            header('location: '.constant('URL'));
           
        }

        function render(){
            
        }

          
        
        
    }