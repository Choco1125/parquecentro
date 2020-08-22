<?php   
    class BusquedaModel extends Model{
        function __construct(){
            parent::__construct();
        }


        function get_all(){
            try{

                $vehiculos =[];

                $query = $this->db->connect()->query('SELECT * FROM registro ORDER BY fecha DESC');
              

                while($row=$query->fetch()){
                    $vehiculo['placa']=$row['placa'];
                    $vehiculo['vehiculo']=$row['vehiculo'];
                    $vehiculo['hora_entrada']=$row['hora_entrada'];
                    $vehiculo['hora_salida']=$row['hora_salida'];
                    $vehiculo['valor']=$row['valor'];
                    $vehiculo['fecha_entrada']=$row['fecha'];

                   array_push($vehiculos,$vehiculo);
                }

                return ['estado'=>'ok','datos'=>$vehiculos];
                
            }catch(PDOException $ex){
                return ['estado'=>'error','error'=>$ex->errorInfo];
            }
        }

        function buscar($sql){
            try{

                $vehiculos =[];
              
                $query = $this->db->connect()->query($sql);

                while($row=$query->fetch()){
                    $vehiculo['placa']=$row['placa'];
                    $vehiculo['vehiculo']=$row['vehiculo'];
                    $vehiculo['hora_entrada']=$row['hora_entrada'];
                    $vehiculo['hora_salida']=$row['hora_salida'];
                    $vehiculo['valor']=$row['valor'];
                    $vehiculo['fecha_entrada']=$row['fecha'];
                    array_push($vehiculos,$vehiculo);
                }

                return ['estado'=>'ok','datos'=>$vehiculos];
                
            }catch(PDOException $ex){
                return ['estado'=>'error','error'=>$ex->errorInfo];
            }
        }
    }