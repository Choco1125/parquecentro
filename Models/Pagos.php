<?php
    class PagosModel extends Model{
        function __construct(){
            parent::__construct();
        }

        function add($placa, $valor,$fecha_pago,$fecha_fin){
            try{
                $sql = "INSERT INTO mensualidades (placa,fecha_pago,valor,fecha_fin) VALUES (:placa,:fecha_pago,:valor,:fecha_fin)";
                $query = $this->db->connect()->prepare($sql);
    
                $query->execute([
                    'placa'=>$placa,
                    'fecha_pago' => $fecha_pago,
                    'valor' => $valor,
                    'fecha_fin'=>$fecha_fin
                ]);
                return [
                    'estado' => 'ok',
                    'datos'=> '200'
                ];
            }catch(PDOException $ex){
                return [
                    'estado' => 'error',
                    'error'=> $ex->errorInfo
                ];
            }
        }
        function get_all(){
            try {
                $peticion = $this->db->connect()->query('SELECT * FROM mensualidades ORDER BY id DESC');
                $mensualidades = [];

                while($row = $peticion->fetch()){
                    $mensualidad['placa'] = $row['placa'];
                    $mensualidad['fecha_pago'] = $row['fecha_pago'];
                    $mensualidad['valor'] = $row['valor'];
                    $mensualidad['fecha_fin'] = $row['fecha_fin'];
                    array_push($mensualidades,$mensualidad);
                }
                
                return $mensualidades;
            } catch (PDOException $ex) {
                return [];
            }   
        }
        function get_valor_mes($placa){
            try{
                $peticion = $this->db->connect()->prepare('SELECT mensualidad FROM clientes WHERE placa=:placa');
                $peticion->execute([
                    'placa'=>$placa
                ]);
                
                $mensualidad=[];
                
                while($fila = $peticion->fetch()){
                    $precio=$fila['mensualidad'];
                    array_push($mensualidad,$precio);
                }

                return [
                    'estado'=>'ok',
                    'datos' => $mensualidad
                ];
            }catch(PDOException $ex){
                return [
                    'estado'=>'erro',
                    'error'=>$ex->errorInfo
                ];
            }
        }

        function pagar($placa){
            try{
                $query = $this->db->connect()->prepare('UPDATE clientes SET estado=1 WHERE placa=:placa');
                $query->execute([
                    'placa'=>$placa
                ]);
                if($query->rowCount()==1){
                    return[ 'estado'=>'ok'];
                }else{
                    return[
                        'estado' => 'error',
                        'error'=> 'Placa no encontrada'
                    ];
                }
            }catch(PDOException $ex){
                $error = $ex->errorInfo;
                return[
                    'estado' => 'error',
                    'error'=> $error[2]
                ];
            }
        }
    }