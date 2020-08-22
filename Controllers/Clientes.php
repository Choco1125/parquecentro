<?php
    class Clientes extends Controller{
        function __construct(){
            parent::__construct();
            $this->view->set_title('Clientes');
            $this->view->set_active('clientes');
            $this->load_model('Clientes');
            date_default_timezone_set('America/Bogota');

            if(session_status() == PHP_SESSION_NONE ){
                session_start();
            }
            
            if (!isset($_SESSION['rol']) || $_SESSION['rol']!='admin'){
                header('location: '.constant('URL'));
            }
        }

        function render(){
            $this->view->render('Admin/clientes');
        }

        function create(){
            $placa =  strtoupper($_POST['placa']);
            $nombre = ucfirst($_POST['nombre']);
            $telefono = $_POST['telefono'];
            $vehiculo = ucfirst($_POST['vehiculo']);
            $estado = $_POST['estado'];
            $mensualidad = $_POST['mensualidad'];
            $dia = date('d');
            $mes = date('n');
            $ano = date('Y');
            if($mes == "12"){
                $ano++;
            }
            if($mes == "12"){
                $mes="1";
            }else{
                $mes++;
            }
            $fecha_actalizacion = $dia."-".$mes."-".$ano;

            $respuesta = $this->model->create($placa,$nombre,$telefono,$vehiculo,$estado,$mensualidad,$fecha_actalizacion);
            
            if($respuesta['estado']=='ok'){
                echo json_encode(200);
            }else{
                switch($respuesta['error'][1]){
                    case '1062':
                        echo json_encode('Placa repetida');
                    break;
                    default:
                        echo json_encode($respuesta['error'][2]);
                    break;
                }
            }
        }

        function get_all(){
            $respuesta = $this->model->get_all();

            if($respuesta['estado']=='ok'){
                echo json_encode($respuesta['data']);
            }else{
                echo json_encode($respuesta['error']);
            }
        }

        function get(){
            $id = $_POST['id'];
            $respuesta = $this->model->get($id);
            if($respuesta['estado']=='ok'){
                echo json_encode($respuesta['data'][0]);
            }else{
                echo json_encode($respuesta['error']);
            }
        }

        function update(){
            $id = $_POST['id'];
            $placa = $_POST['placa'];
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $vehiculo = $_POST['vehiculo'];
            $estado = $_POST['estado'];
            $mensualidad = $_POST['mensualidad'];

            $respuesta = $this->model->update($id,$placa,$nombre,$telefono,$vehiculo,$estado,  $mensualidad);

            if($respuesta['estado']=='ok'){
                echo json_encode(200);
            }else{
                echo json_encode($respuesta['error']);
            }
        }

        function delete(){
            $id = $_POST['id'];
            $respuesta = $this->model->delete($id);

            if($respuesta['estado']=='ok'){
                echo json_encode(200);
            }else{
                echo json_encode($respuesta['error'][1]);
            }
        }
    }