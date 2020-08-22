<?php
    class PreciosModel extends Model{
        function __construct(){
            parent::__construct();
        }

        function get_all(){
            try {
                $query = $this->db->connect()->query('SELECT * FROM precios');
                $valores = [];
                
                while($row = $query->fetch()){
                    $valor['carro'] = $row['carro'];
                    $valor['moto'] = $row['moto'];
                    $valor['noche_carro'] = $row['noche_carro'];
                    $valor['noche_moto'] = $row['noche_moto'];
                    $valor['dia_carro'] = $row['dia_carro'];
                    $valor['dia_moto'] = $row['dia_moto'];

                    array_push($valores,$valor);
                }

                return [
                    'estado' => 'ok',
                    'data' => $valores
                ];
            } catch (PDOException $ex) {
                return [
                    'return'=>'erro',
                    'error'=>$ex->errorInfo
                ];
            }
        }

        function update($campo,$valor){
            try {
                $query = $this->db->connect()->prepare('UPDATE precios SET '.$campo.'=:valor');
                $query->execute([
                    'valor' => $valor
                ]);
                return [
                    'estado'=>'ok'
                ];
            } catch (PDOException $ex) {
                return [
                    'estado' => 'error',
                    'error' => $ex->errorInfo
                ];
            }
        }
    }