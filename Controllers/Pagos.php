<?php   
    class Pagos extends Controller{
        function __construct(){
            parent::__construct();
            $this->view->set_title('Pagos');
            $this->view->set_active('pagos');
            $this->load_model('Pagos');
            date_default_timezone_set('America/Bogota');

            if(session_status() == PHP_SESSION_NONE ){
                session_start();
            }
            
            if (!isset($_SESSION['rol'])){
                header('location: '.constant('URL'));
            }
        }

        function render(){
            $this->view->render('Admin/pagos');
        }

        function add(){
            $placa = strtoupper($_POST['placa']);
            $valor = strtoupper($_POST['valor']);
            $fecha_pago = date('d-m-Y');
            $fecha_fin = $_POST['fecha_fin'];

            $respuesta = $this->model->add($placa,$valor,$fecha_pago,$fecha_fin);
            
            if($respuesta['estado']=='ok'){
                echo json_encode(200);
            }else{
                echo json_encode($respuesta['error']);
            }
        }

        function get_all(){
            echo json_encode($this->model->get_all());
        }

        function pagar(){
            $placa = strtoupper($_POST['placa']);
            $monto = $_POST['monto'];
            $this->get_valor_mes($placa);

            if($this->mes == -1){
                echo json_encode('Error al procesar la peticion');
            }else{
                if($monto<$this->mes){
                    echo json_encode('El valor es menor al precio establecido');
                }else{
                    $respuesta = $this->model->pagar($placa);
                    if($respuesta['estado']=='ok'){
                        echo json_encode(200);
                    }else{
                        echo json_encode($respuesta['error']);
                    }
                }
            }
        }

        function get_valor_mes($placa){
            $peticion = $this->model->get_valor_mes($placa);
            if($peticion['estado']=='ok'){
                $this->mes = $peticion['datos'][0]; 
            }else{
                $this->mes =-1;
            }
        }

    }