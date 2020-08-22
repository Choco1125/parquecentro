<?php
class ClientesModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function create($placa, $nombre, $telefono, $vehiculo, $estado,$mensualidad,$fecha_actalizacion)
    {
        try {
            $query = $this->db->connect()->prepare('INSERT INTO clientes (placa,nombre,telefono,vehiculo,estado,mensualidad,fecha_actualizacion ) VALUES (:placa,:nombre,:telefono,:vehiculo,:estado,:mensualidad,:fecha_actalizacion)');
            $query->execute([
                'placa' => $placa,
                'nombre' => $nombre,
                'telefono' => $telefono,
                'vehiculo' => $vehiculo,
                'estado' => $estado,
                'mensualidad'=>$mensualidad,
                'fecha_actalizacion'=>$fecha_actalizacion
            ]);
            return [
                'estado' => 'ok'
            ];
        } catch (PDOException $ex) {
            return [
                'estado' => 'error',
                'error' => $ex->errorInfo
            ];
        }
    }

    function get_all()
    {
        try {
            $query = $this->db->connect()->query('SELECT * FROM clientes');
            $clientes = [];

            while ($row = $query->fetch()) {
                $cliente['id'] = $row['id'];
                $cliente['placa'] = $row['placa'];
                $cliente['nombre'] = $row['nombre'];
                $cliente['telefono'] = $row['telefono'];
                $cliente['vehiculo'] = ucfirst($row['vehiculo']);
                $cliente['estado'] = $row['estado'];

                array_push($clientes, $cliente);
            }

            return [
                'estado' => 'ok',
                'data' => $clientes
            ];
        } catch (PDOException $ex) {
            return [
                'estado' => 'error',
                'error' => $ex->errorInfo
            ];
        }
    }

    function get($id)
    {
        try {
            $query = $this->db->connect()->prepare('SELECT * FROM clientes WHERE id=:id');
            $query->execute([
                'id' => $id
            ]);
            $cliente = [];

            while ($row = $query->fetch()) {
                $user['placa'] = $row['placa'];
                $user['nombre'] = $row['nombre'];
                $user['telefono'] = $row['telefono'];
                $user['vehiculo'] = strtolower($row['vehiculo']);
                $user['estado'] = $row['estado'];
                $user['mensualidad'] = $row['mensualidad'];

                array_push($cliente, $user);
            }

            return [
                'estado' => 'ok',
                'data' => $cliente
            ];

        } catch (PDOException $ex) {
            return [
                'estado' => 'error',
                'error' => $ex->errorInfo
            ];
        }
    }

    function update($id,$placa,$nombre,$telefono,$vehiculo,$estado,$mensualidad){
        try {
            $query = $this->db->connect()->prepare('UPDATE clientes SET placa =:placa, nombre =:nombre, telefono =:telefono, vehiculo =:vehiculo,estado =:estado,mensualidad= :mensualidad WHERE id=:id');
            $query->execute([
                'placa'=>strtoupper($placa),
                'nombre'=>$nombre,
                'telefono'=>$telefono,
                'vehiculo'=>$vehiculo,
                'estado'=>$estado,
                'id'=>$id,
                'mensualidad'=>$mensualidad
            ]);

            return ['estado'=>'ok'];
        } catch (PDOException $ex) {
            return [
                'estado' =>'error',
                'error'=> $ex->errorInfo
            ];
        }
    }

    function delete($id){
        try {
            $eliminar = $this->db->connect()->prepare('DELETE FROM clientes WHERE id=:id');
            $eliminar->execute([
                'id'=>$id
            ]);

            return [
                'estado' => 'ok'
            ];
        } catch (PDOException $ex) {
            return [
                'estado'=>'error',
                'error' => $ex->errorInfo
            ];
        }
    }
}
