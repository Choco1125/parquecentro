<?php
    class Database{

        private $user;
        private $password;
        private $database;
        private $host;
        private $charset;
        private $string;

        function __construct(){
            $this->user = constant('USER');
            $this->password = constant('PASSWORD');
            $this->database = constant('DATABASE');
            $this->host = constant('HOST');
            $this->charset = constant('CHARSET');
            $this->string = 'mysql:host='.$this->host.';dbname='.$this->database.';charset='.$this->charset;
        }

        function connect(){
            try{
                $opciones =[
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false
                ];

                $pdo =new PDO($this->string,$this->user,$this->password,$opciones);
                
                return $pdo;
            }catch(PDOException $ex){
                print_r('Error en conexión a la base de datos: '.$ex->getMessage());
            }
        }

    }