<?php
    require_once "Conexion.php";
    
    class User extends Conexion{
        protected $name;
        protected $apellidos;
        private $pass;
        private $correo;
        protected $edad;
        public $color;
        protected $fecha;
        public $descripcion;

        public function __construct($config, $name, $apellidos, $pass, $correo, $edad, $color, $fecha, $descripcion){
            
            parent::__construct($config);
            $this -> name = $name;
            $this -> apellidos = $apellidos;
            $this -> pass = $pass;
            $this -> correo = $correo;
            $this -> edad = $edad;            
            $this -> color = $color;
            $this -> fecha = $fecha;
            $this -> descripcion = $descripcion;
        }

        public function connectUser(){
            $this -> connect();
        }

        public function closeUser(){
            $this -> close();
        }

        public function addUser(){
            $name = $this -> name;
            $apellidos = $this -> apellidos;
            $pass = $this -> pass;
            $correo = $this -> correo;
            $edad = $this -> edad;
            $color = $this -> color;
            $fecha = $this -> fecha;
            $descripcion = $this -> descripcion;

            $query = "Insert into usuarios(nombre,apellidos,pass,correo,edad,color,fecha,descripcion) Values('$name','$apellidos','$pass','$correo','$edad', '$color','$fecha','$descripcion')";

            $this -> connection -> exec($query);
        }
    }
?>