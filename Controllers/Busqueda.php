<?php
    class Busqueda extends Controller{
        function __construct(){
            parent::__construct();
            $this->view->set_title('Busqueda');
            date_default_timezone_set('America/Bogota');
            $this->view->set_active('busqueda');
            $this->load_model('Busqueda');
            // $this->load_model('Admin');

            if(session_status() == PHP_SESSION_NONE ){
                session_start();
            }
            
            if (!isset($_SESSION['rol'])){
                header('location: '.constant('URL'));
            }
        }

        function render(){
            $this->view->render('Admin/busqueda');
        }

        function get_all(){
            $peticion = $this->model->get_all();

            
            if($peticion['estado']=='ok'){
                echo json_encode($peticion['datos']);
            }else{
                echo json_encode($peticion['error']);
            }
        }

        function buscar(){
            $placa = strtoupper($_POST['placa']);
            $fecha = $_POST['fecha'];

            if($placa!="" && $fecha!=""){
                $sql = 'SELECT * FROM registro WHERE placa LIKE "%'.$placa.'%" AND fecha = "'.$fecha. '" ORDER BY fecha DESC';
              
            }else if($placa!=""){
                $sql = 'SELECT * FROM registro WHERE placa LIKE "%'.$placa.'%" ORDER BY fecha DESC';
                
            }else{
                $sql = 'SELECT * FROM registro WHERE fecha = "'.$fecha. '" ORDER BY fecha DESC';
            }
            $peticion = $this->model->buscar($sql);
            
            if($peticion['estado']=='ok'){
                echo json_encode($peticion['datos']);
            }else{
                echo json_encode($peticion['error']);
            }
        }
   
    }