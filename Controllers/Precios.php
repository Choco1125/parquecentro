<?php
    class Precios extends Controller{
        function __construct(){
            parent::__construct();
            $this->view->set_title('Precios');
            $this->view->set_active('precios');
            $this->load_model('Precios');

            if(session_status() == PHP_SESSION_NONE ){
                session_start();
            }
            
            if (!isset($_SESSION['rol']) || $_SESSION['rol']!='admin'){
                header('location: '.constant('URL'));
            }
        }

        function render(){
            $this->view->render('Admin/precios');
        }

        function update(){
            $campo = $_POST['campo'];
            $valor = $_POST['valor'];

            $respuesta = $this->model->update($campo,$valor);

            if($respuesta['estado']=='ok'){
                echo json_encode(200);
            }else{
                echo json_encode($respuesta['error']);
            }
        }

        function get_valores(){
            $respuesta = $this->model->get_all();

            if($respuesta['estado']=='ok'){
                echo json_encode($respuesta['data'][0]);
            }else{
                echo json_encode($respuesta['error']);

            }
        }
    }