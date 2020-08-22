<?php
class Usuarios extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->set_title('Usuarios');
        $this->view->set_active('usuarios');
        $this->load_model('Usuarios');
        date_default_timezone_set('America/Bogota');
        if(session_status() == PHP_SESSION_NONE ){
            session_start();
        }
        
        if (!isset($_SESSION['rol']) || $_SESSION['rol']!='admin'){
            header('location: '.constant('URL'));
        }

    }

    function render()
    {
        $this->view->render('Admin/usuarios');
    }


    function create()
    {
        $ususario = $_POST['usuario'];
        $contrasena = password_hash($_POST['usuario'], PASSWORD_DEFAULT);
        $rol = $_POST['rol'];
        $estado = $_POST['estado'];

        $respuesta = $this->model->create($ususario, $contrasena, $rol, $estado,date('d'));

        if ($respuesta['estado'] == 'ok') {
            echo json_encode(200);
        } else {
            switch ($respuesta['error']) {
                case '1048':
                    echo json_encode('Columnas vacías');
                    break;
                case '1406':
                    echo json_encode('Nombre demasiado largo');
                    break;
                case '1062':
                    echo json_encode('El usuario ya existe');
                    break;
                default:
                    echo json_encode('Error: ' . $respuesta['error']);
                    break;
            }
        }
    }

    function get_users()
    {
        $user_list = $this->model->get_all();

        if ($user_list['estado'] == 'ok') {
            echo json_encode($user_list['data']);
        } else {
            echo json_encode('Error: ' . $user_list['error']);
        }
    }

    function get_user()
    {

        $id = $_POST['id'];

        $user = $this->model->get_by_id($id);

        if ($user['estado'] == 'ok') {
            echo json_encode($user['data']);
        } else {
            echo json_encode('Error: ' . $user['error']);
        }
    }

    function update()
    {
        $id = $_POST['id'];
        $ususario = $_POST['usuario'];
        $rol = $_POST['rol'];
        $estado = $_POST['estado'];

        $respuesta = $this->model->update($id,$ususario, $rol, $estado);

        if ($respuesta['estado'] == 'ok') {
            echo json_encode(200);
        } else {
            switch ($respuesta['error']) {
                case '1048':
                    echo json_encode('Columnas vacías');
                    break;
                case '1406':
                    echo json_encode('Nombre demasiado largo');
                    break;
                case '1062':
                    echo json_encode('El usuario ya existe');
                    break;
                default:
                    echo json_encode('Error: ' . $respuesta['error']);
                    break;
            }
        }
    }

    function delete()
    {

        $id = $_POST['id'];

        $user = $this->model->delete($id);

        if ($user['estado'] == 'ok') {
            echo json_encode(200);
        } else {
            echo json_encode('Error: ' . $user['error']);
        }
    }

}
