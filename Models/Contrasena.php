<?php
    class ContrasenaModel extends Model{
        function __construct(){
            parent::__construct();
        }

        function get_password($id){
            try{
                $peticion = $this->db->connect()->prepare('SELECT contrasena FROM usuarios WHERE id=:id');
                $peticion->execute([
                    'id'=>$id
                ]);
                $contrasena=[];
                
                while($fila = $peticion->fetch()){
                    $dato=$fila['contrasena'];
                    array_push($contrasena,$dato);
                }

                return [
                    'estado'=>'ok',
                    'datos' => $contrasena[0]
                ];
            }catch(PDOException $ex){
                return [
                    'estado'=>'erro',
                    'error'=>$ex->errorInfo
                ];
            }
        }

        function update($id,$password){
            try{
                $query = $this->db->connect()->prepare('UPDATE usuarios SET contrasena=:contrasena WHERE id=:id');
                $query->execute([
                    'contrasena'=>$password,
                    'id'=>$id
                ]);
                if($query->rowCount()==1){
                    return[ 'estado'=>'ok'];
                }else{
                    return[
                        'estado' => 'error',
                        'error'=> 'No se pudo actualizar'
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