<?php 
    require_once 'Conexion.php';

    class Producto extends Conexion {
        protected $nombre;
        protected $precio;
        protected $fecha;
        public $foto;
        public $descripcion;

        public function __construct($config, $nombre, $precio, $fecha, $foto, $descripcion){
            
            parent::__construct($config);
            $this -> nombre = $nombre;
            $this -> precio = $precio;
            $this -> fecha = $fecha;
            $this -> descripcion = $descripcion;
        }

        public function connectProduct(){
            $this->connect();
        }

        public function closeProduct(){
            $this->close();
        }
        
        public function addProduct($nombre, $precio, $fecha, $descripcion){
            $query = 'insert into productos (nombre,precio,fecha,descripcion) values '$nombre', '$precio', '$fecha', '$descripcion'';
            $this -> connection -> exec($query);
        }
    }
?>