<?php
    class Admin extends Controller{
        function __construct(){
            parent::__construct();
            $this->view->set_title('Panel de control');
            date_default_timezone_set('America/Bogota');
            $this->view->set_active('inicio');
            $this->load_model('Admin');

            if(session_status() == PHP_SESSION_NONE ){
                session_start();
            }
            
            if (!isset($_SESSION['rol']) || $_SESSION['rol']!='admin'){
                header('location: '.constant('URL'));
            }
        }

        function render(){
            $this->view->render('Admin/index');
        }

        function get_all(){
            $peticion = $this->model->get_all_admin(date('d-m-Y'));

            
            if($peticion['estado']=='ok'){
                echo json_encode($peticion['datos']);
            }else{
                echo json_encode($peticion['error']);
            }
        }

        function total(){
            $valor = $this->model->total_dia(date('d-m-Y'));

            if($valor['estado']=='ok'){
                echo json_encode($valor['datos']);
            }else{
                echo json_encode(0);
            }

        }
    }