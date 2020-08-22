<?php
    class MainModel extends Model{
        function __construct()
        {   
            parent::__construct();
        }

        function logear($usuario){
            try{
                $query = $this->db->connect()->prepare('SELECT id,rol,contrasena,estado FROM usuarios WHERE usuario=:usuario LIMIT 1');
                $query->execute([
                    'usuario'=>$usuario
                ]);

                $datos=[];

                while($row = $query->fetch()){
                    $dato['id']=$row['id'];
                    $dato['rol']=$row['rol'];
                    $dato['contrasena']=$row['contrasena'];
                    $dato['estado']=$row['estado'];

                    array_push($datos,$dato);
                }
                
                return[
                    'estado'=>'ok',
                    'datos'=>$datos[0]
                ];
            }catch(PDOException $ex){
                return[
                    'estado'=>'error',
                    'error'=>$ex->errorInfo
                ];
            }
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
                   array_push($vehiculos,$vehiculo);
                }

                return ['estado'=>'ok','datos'=>$vehiculos];
                
            }catch(PDOException $ex){
                return ['estado'=>'error','error'=>$ex->errorInfo];
            }
        }

    }