<?php
class Usuario extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->view->set_title('Parqueadero');
        $this->view->set_active('inicio');
        date_default_timezone_set('America/Bogota');
        $this->load_model('Usuario');

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'usuario') {
            header('location: ' . constant('URL'));
        }
        $this->update_morosos();
    }

    function render()
    {
        $this->view->render('Usuario/index');
    }

    function entrada()
    {
        $placa = strtoupper($_POST['placa']);
        $vehiculo = $_POST['vehiculo'];
        $precio = $_POST['precio'];
        $hora_entrada = date('H:i');
        $fecha = date('d-m-Y');
        if ($this->model->repetido($placa, $fecha) == true) {
            echo json_encode('El vehiculo se encuentra registrado');
        } else {

            $peticion = $this->model->registrar_entrada($placa, $vehiculo, $hora_entrada, $fecha, $precio);

            if ($peticion['estado'] == 'ok') {
                $respues = [
                    'estado' => 200,
                    'valor' => $this->model->get_valor($vehiculo)
                ];
                echo json_encode($respues);
            } else {
                echo json_encode([]);
            }
        }
    }

    function salida()
    {
        $placa = strtoupper($_POST['placa']);

        $peticion = $this->model->buscar_registro($placa, date('d-m-Y'));

        if ($peticion['estado'] == 'ok') {



            if (count($peticion['datos']) > 0) {
                $id = $peticion['datos'][0]['id'];
                $vehiculo = $peticion['datos'][0]['vehiculo'];
                $hora_entrada = new DateTime($peticion['datos'][0]['hora_entrada']);
                $precio = $peticion['datos'][0]['precio'];

                $hora_actual = new DateTime(date('H:i'));

                $horas = $hora_entrada->diff($hora_actual);

                $horas_total = $horas->h;
                $horas_total_real = $horas->h;
                $minutos = $horas->i;
                if ($horas->i > 10) {
                    $horas_total++;
                }
                if ($horas_total < 1) {
                    $horas_total = 1;
                }


                $prec = 0;
                $total = 0;

                if ($this->model->is_client($placa) == false) {
                    switch ($precio) {
                        case 'carro':
                        case 'moto':
                            $prec = $this->model->get_valor($precio);
                            $total = $horas_total * $prec;
                            break;
                        case 'noche_carro':
                        case 'noche_moto':
                        case 'dia_carro':
                        case 'dia_moto':
                            $total = $this->model->get_valor($precio);
                            $prec = $total;
                            break;
                        default:
                            $total = 0;
                            $prec = $total;
                            break;
                    }
                }

                $datos['id'] = $id;
                $datos['vehiculo'] = $vehiculo;
                $datos['horas'] = $horas_total_real . ' hora(s) ' . $minutos . 'minutos';
                $datos['total'] = $total;
                $datos['precio'] = $prec;
                $datos['fecha'] = date('d-m-Y');

                echo json_encode($datos);
            } else {
                echo json_encode('El vehiculo no se encuentra en el parqueadero');
            }
        } else {
            echo json_encode($peticion['error'][2]);
        }
    }

    function salir()
    {
        $id = $_POST['id'];
        $total = $_POST['total'];
        $hora_salida = date('H:i');
        $peticion = $this->model->registrar_salida($id, $hora_salida, $total);
        if ($peticion['estado'] == 'ok') {
            echo json_encode(200);
        } else {
            echo json_encode($peticion['error']);
        }
    }

    function get()
    {
        $peticion = $this->model->get_all(date('d-m-Y'));

        if ($peticion['estado'] == 'ok') {
            echo json_encode($peticion['datos']);
        } else {
            echo json_encode($peticion['error'][2]);
        }
    }
    function get_all()
    {
        $peticion = $this->model->get_all_admin(date('d-m-Y'));

        if ($peticion['estado'] == 'ok') {
            echo json_encode($peticion['datos']);
        } else {
            echo json_encode($peticion['error'][2]);
        }
    }

    function get_precio()
    {
        $precio = $_POST['precio'];
        echo json_encode($this->model->get_valor($precio));
    }

    function update_morosos()
    {
        $this->model->update_morosos(date('d-n-Y'));
    }
}
