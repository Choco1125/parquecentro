<?php
    class Err extends Controller{

        function __construct(){
            parent::__construct();
            $this->view->set_title('Error');
        }

        function render(){
            $this->view->render('Err/index');
        }

    }