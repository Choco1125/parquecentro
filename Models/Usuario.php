<?php   
    class UsuarioModel extends Model{
        function __construct(){
            parent::__construct();
        }

        function is_client($placa){
            $query = $this->db->connect()->prepare('SELECT id FROM clientes WHERE placa=:placa');
            $query->execute([
                'placa'=>$placa
            ]);
            return ($query->rowCount()>0)?true:false;
        }

        function repetido($placa,$fecha){
            $peticion = $this->db->connect()->prepare('SELECT id FROM registro WHERE placa=:placa AND fecha=:fecha AND activo=1');
            $peticion->execute([
                'placa'=>$placa,
                'fecha'=>$fecha
            ]);
            return ($peticion->rowCount()>0)?true:false;
        }
        function registrar_entrada($placa,$vehiculo,$hora_entrada,$fecha,$precio){
            try{
                $query = $this->db->connect()->prepare('INSERT INTO registro 
                                                        (placa,vehiculo,hora_entrada,activo,fecha,valor,precio) 
                                                        VALUES (:placa,:vehiculo,:hora_entrada,:activo,:fecha,:valor,:precio)');
                $query->execute([
                    'placa'=>$placa,
                    'vehiculo'=>$vehiculo,
                    'hora_entrada'=>$hora_entrada,
                    'activo'=>1,
                    'fecha'=>$fecha,
                    'valor'=>0,
                    'precio'=>$precio
                ]);
                return ['estado'=>'ok'];
            }catch(PDOException $ex){
                return[
                    'estado' => 'error',
                    'error'=>$ex->errorInfo
                ];
            }
        }
        function buscar_registro($placa,$fecha){
            try {
                $query = $this->db->connect()->prepare('SELECT id,vehiculo,hora_entrada,precio 
                                                        FROM registro 
                                                        WHERE placa=:placa 
                                                        AND fecha=:fecha 
                                                        AND activo=1');
                $query->execute([
                    'placa'=>$placa,
                    'fecha'=>$fecha
                ]);

                $registro = [];
                if($query->rowCount()>0){
                    while($row = $query->fetch()){
                        $datos['id']= $row['id'];
                        $datos['vehiculo']= $row['vehiculo'];
                        $datos['hora_entrada']= $row['hora_entrada'];
                        $datos['precio']= $row['precio'];
                        
                        array_push($registro,$datos);
                    }
                }
                    
                return [
                    'estado'=>'ok',
                    'datos'=>$registro
                ];
            } catch (PDOException $ex) {
                return [
                    'estado'=>'erro',
                    'error'=>$ex->errorInfo
                ];
            }
        }

        function get_valor($vehiculo){
            try{
                $query = $this->db->connect()->query('SELECT '.$vehiculo.' FROM precios');
                $valor = [];

                while($row = $query->fetch()){
                    array_push($valor,$row[$vehiculo]);
                }

                return (count($valor)>0)?$valor[0]:0;
            }catch(PDOException $ex){
                return 0;
            }
        }

        function get_mensualidad($placa){
            try{
                $query = $this->db->connect()->prepare('SELECT mensualidad 
                                                      FROM clientes
                                                      WHERE placa = :placa');
                $query->execute([
                    'placa'=>$placa
                ]);
                $valor = [];

                while($row = $query->fetch()){
                    array_push($valor,$row['mensualidad']);
                }

                return ['estado'=>'ok','datos'=> $valor[0]];
            }catch(PDOException $ex){
                return ['estado'=> 'error','error'=>null];
            }
        }

        function registrar_salida($id,$hora_salida,$total){
            try {
                $query = $this->db->connect()->prepare('UPDATE registro SET activo=0, hora_salida=:hora_salida, valor=:total WHERE id=:id');
                $query->execute([
                   
                    'hora_salida'=>$hora_salida,
                    'id'=>$id,
                    'total'=>$total
                ]);
                return ['estado'=>'ok'];
            } catch (PDOException $ex) {
                return [
                    'estado'=>'error',
                    'error'=>$ex->errorInfo
                ];
            }
        }

        function get_all($fecha){
            try{

                $vehiculos =[];

                $query = $this->db->connect()->prepare('SELECT placa,vehiculo,hora_entrada,fecha FROM registro WHERE activo=1 AND fecha=:fecha');
                $query->execute([
                    'fecha'=>$fecha
                ]);

                while($row=$query->fetch()){
                    $vehiculo['placa']=$row['placa'];
                    $vehiculo['vehiculo']=$row['vehiculo'];
                    $vehiculo['hora_entrada']=$row['hora_entrada'];
                    $vehiculo['fecha']=$row['fecha'];
                   array_push($vehiculos,$vehiculo);
                }

                return ['estado'=>'ok','datos'=>$vehiculos];
                
            }catch(PDOException $ex){
                return ['estado'=>'error','error'=>$ex->errorInfo];
            }
        }

        function update_morosos($fecha){
            try{

                $query = $this->db->connect()->prepare('UPDATE clientes SET estado=1 WHERE fecha_actualizacion=:fecha');
                $query->execute([
                    'fecha'=>$fecha
                ]);

            }catch(PDOException $ex){
               var_dump($ex->errorInfo);
            }
        }
    }