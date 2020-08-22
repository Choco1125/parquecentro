<?php
    class Main extends Controller{

        function __construct(){
            parent::__construct();
            $this->view->set_title("Inicio");
            $this->load_model('Main');
            date_default_timezone_set('America/Bogota');


            if(session_status() == PHP_SESSION_NONE ){
                session_start();
            }
            
            if (isset($_SESSION['rol'])){
                if($_SESSION['rol']=='admin'){
                    header('location: '.constant('URL').'admin');
                }else{
                    header('location: '.constant('URL').'usuario');
                }
            }
        }

        function render(){
            $this->view->render('Main/index');
        }

        function loggear(){
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];

            $peticion = $this->model->logear($usuario);

            if($peticion['estado']=='ok'){

                if(count($peticion['datos'])>0){
                    $id = $peticion['datos']['id'];
                    $rol = $peticion['datos']['rol'];
                    $contrasena = $peticion['datos']['contrasena'];
                    $estado = $peticion['datos']['estado'];
                    
                    if($estado!=1){
                        echo json_encode('El usuario se encuentra inactivo');
                    }else{
                        if(password_verify($password,$contrasena)){
                            $_SESSION['rol']=$rol;
                            $_SESSION['id']=$id;
                            echo json_encode(200);
                        }else{
                            echo json_encode(100);
                        }
                    }
                }else{
                    echo json_encode('El usuario no existe');
                }
            }else{
                echo json_encode($peticion['error'][2]);
            }
        }
      
    }