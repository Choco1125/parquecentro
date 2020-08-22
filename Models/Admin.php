<?php   
    class AdminModel extends Model{
        function __construct(){
            parent::__construct();
        }

        function get_all_admin($fecha){
            try{

                $vehiculos =[];

                $query = $this->db->connect()->prepare('SELECT * FROM registro WHERE fecha=:fecha');
                $query->execute([
                    'fecha'=>$fecha
                ]);

                while($row=$query->fetch()){
                    $vehiculo['placa']=$row['placa'];
                    $vehiculo['vehiculo']=$row['vehiculo'];
                    $vehiculo['hora_entrada']=$row['hora_entrada'];
                    $vehiculo['hora_salida']=$row['hora_salida'];
                    $vehiculo['valor']=$row['valor'];
                   array_push($vehiculos,$vehiculo);
                }

                return ['estado'=>'ok','datos'=>$vehiculos];
                
            }catch(PDOException $ex){
                return ['estado'=>'error','error'=>$ex->errorInfo];
            }
        }

        function total_dia($fecha){
            try{

                $valor =[];

                $query = $this->db->connect()->prepare('SELECT SUM(valor) FROM registro WHERE fecha =:fecha');
                $query->execute([
                    'fecha'=>$fecha
                ]);

                while($row=$query->fetch()){
                    $val['total']=$row['SUM(valor)'];
                   
                   array_push($valor,$val);
                }

                return ['estado'=>'ok','datos'=>$valor];
                
            }catch(PDOException $ex){
                return ['estado'=>'error','error'=>$ex->errorInfo];
            }
        }
    }