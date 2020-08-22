<?php
    class UsuariosModel extends Model{
        function __construct(){
            parent::__construct();
        }

        function create($usuario,$contrasena,$rol,$estado=1,$cobro){
            try {
                $query = $this->db->connect()->prepare('INSERT INTO usuarios (usuario,contrasena,rol,estado) VALUES(:usuario,:contrasena,:rol,:estado)');
                $query->execute([
                    'usuario'=>$usuario,
                    'contrasena'=>$contrasena,
                    'rol'=>$rol,
                    'estado'=>$estado
                ]);
                return ['estado'=>'ok'];
            } catch (PDOException $ex) {
                $error = $ex->errorInfo;
                return [
                    'estado'=>'error',
                    'error'=>$error[1],
                    
                ];
            }
        }

        function get_all(){
            try {
                $query = $this->db->connect()->query('SELECT * FROM usuarios');
                $users = [];
                
                while($row = $query->fetch()){
                    $user['id'] = $row['id'];
                    $user['usuario'] = $row['usuario'];
                    $user['rol'] = $row['rol'];
                    $user['estado'] = $row['estado'];

                    array_push($users,$user);
                }

                return [
                    'estado'=>'ok',
                    'data'=>$users                    
                ];
                
            } catch (PDOException $ex) {
                $error = $ex->errorInfo;
                return [
                    'estado'=>'error',
                    'error'=>$error[1]
                ];
            }
        }

        function get_by_id($id){
            try {
                $query = $this->db->connect()->prepare('SELECT * FROM usuarios WHERE id=:id');
                $query->execute([
                    ':id'=>$id
                ]);

                $user = [];
                
                while($row = $query->fetch()){
                    $user['id'] = $row['id'];
                    $user['usuario'] = $row['usuario'];
                    $user['rol'] = $row['rol'];
                    $user['estado'] = $row['estado'];
                }

                return [
                    'estado'=>'ok',
                    'data'=>$user                    
                ];
                
            } catch (PDOException $ex) {
                $error = $ex->errorInfo;
                return [
                    'estado'=>'error',
                    'error'=>$error[1]
                ];
            }
        }

        function update($id,$usuario,$rol,$estado){
            try {
                $query = $this->db->connect()->prepare('UPDATE usuarios SET usuario = :usuario, rol= :rol, estado=:estado WHERE id=:id');
                $query->execute([
                    'id' => $id,
                    'usuario'=>$usuario,
                    'rol'=>$rol,
                    'estado'=>$estado
                ]);
                return ['estado'=>'ok'];
            } catch (PDOException $ex) {
                $error = $ex->errorInfo;
                return [
                    'estado'=>'error',
                    'error'=>$error[1],
                    
                ];
            }
        }

        function delete($id){
            try {
                $query = $this->db->connect()->prepare('DELETE FROM usuarios WHERE id=:id');
                $query->execute([
                    'id'=>$id,
                ]);
                return ['estado'=>'ok'];
            } catch (PDOException $ex) {
                $error = $ex->errorInfo;
                return [
                    'estado'=>'error',
                    'error'=>$error[1],
                    
                ];
            }
        }
    }