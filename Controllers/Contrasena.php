<?php   
    class Contrasena extends Controller{
        function __construct(){
            parent::__construct();
            $this->view->set_title('Cambiar constraseña');
            $this->view->set_active('contrasena');

            if(session_status() == PHP_SESSION_NONE ){
                session_start();
            }
            
            if (!isset($_SESSION['rol'])){
                header('location: '.constant('URL'));
            }

            $this->load_model('Contrasena');
        }

        function render(){
            $this->view->render('Admin/contrasena');
        }

        function actualizar(){
            $vieja =  $_POST['vieja'];
            $nueva =  $_POST['nueva'];
            $id = $_SESSION['id'];
            $peticion = $this->model->get_password($id);

            if($peticion['estado']=='ok'){

                if(password_verify($vieja,$peticion['datos'])){
                    $actualizacion = $this->model->update($id,password_hash($nueva,PASSWORD_DEFAULT));
                    if($actualizacion['estado']=='ok'){
                        echo json_encode(200);

                    }else{
                    echo json_encode($peticion['error']);

                    }
                }else{
                    echo json_encode(100);
                }

            }else{
                echo json_encode($peticion['error']);

            }
        }
    }