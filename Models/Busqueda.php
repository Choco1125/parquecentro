<?php
class BusquedaModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }


    function get_all()
    {
        try {

            $vehiculos = [];

            $query = $this->db->connect()->query('SELECT * FROM registro ORDER BY fecha DESC');


            while ($row = $query->fetch()) {
                $vehiculo['placa'] = $row['placa'];
                $vehiculo['vehiculo'] = $row['vehiculo'];
                $vehiculo['hora_entrada'] = $row['hora_entrada'];
                $vehiculo['hora_salida'] = $row['hora_salida'];
                $vehiculo['valor'] = $row['valor'];
                $vehiculo['fecha_entrada'] = $row['fecha'];

                array_push($vehiculos, $vehiculo);
            }

            return ['estado' => 'ok', 'datos' => $vehiculos];
        } catch (PDOException $ex) {
            return ['estado' => 'error', 'error' => $ex->errorInfo];
        }
    }

    function buscar($sql)
    {
        try {

            $vehiculos = [];

            $query = $this->db->connect()->query($sql);

            while ($row = $query->fetch()) {
                $vehiculo['placa'] = $row['placa'];
                $vehiculo['vehiculo'] = $row['vehiculo'];
                $vehiculo['hora_entrada'] = $row['hora_entrada'];
                $vehiculo['hora_salida'] = $row['hora_salida'];
                $vehiculo['valor'] = $row['valor'];
                $vehiculo['fecha_entrada'] = $row['fecha'];
                array_push($vehiculos, $vehiculo);
            }

            return ['estado' => 'ok', 'datos' => $vehiculos];
        } catch (PDOException $ex) {
            return ['estado' => 'error', 'error' => $ex->errorInfo];
        }
    }

    function get_total_of_entries($since, $until)
    {
        try {
            $query = $this->db->connect()->prepare('SELECT SUM(valor) AS entradas FROM registro WHERE fecha BETWEEN :since AND :until');
            $query->execute([
                ':since' => $since,
                ':until' => $until,
            ]);

            $values = [];

            while ($row = $query->fetch()) {
                $values['entradas'] = $row['entradas'];
            }

            return [
                'estado' => 'ok',
                'data' => $values['entradas']
            ];
        } catch (PDOException $ex) {
            $error = $ex->errorInfo;
            return [
                'estado' => 'error',
                'error' => $error[1]
            ];
        }
    }
    function get_total_of_mensualidades($since, $until)
    {
        try {
            $query = $this->db->connect()->prepare('SELECT SUM(valor) AS mensualidades FROM mensualidades WHERE fecha_pago BETWEEN :since AND :until');
            $query->execute([
                ':since' => $since,
                ':until' => $until,
            ]);

            $values = [];

            while ($row = $query->fetch()) {
                $values['mensualidades'] = $row['mensualidades'];
            }

            return [
                'estado' => 'ok',
                'data' => $values['mensualidades']
            ];
        } catch (PDOException $ex) {
            $error = $ex->errorInfo;
            return [
                'estado' => 'error',
                'error' => $error[1]
            ];
        }
    }
}
