<?php

class Conexion {

  public $dsn;
  public $user;
  public $password;
  public $connection;
  public $db;

  public function __construct($config) {

    $config = json_decode($config, TRUE);
    $this->dsn = "{$config['DBType']}:dbname={$config['DBName']};host={$config['Host']}";
    $this->user = "{$config['User']}";
    $this->db = "{$config['DBType']}:host={$config['Host']}";
    $this->password = "{$config['Password']}";

}

    function connect() {
      try {
        
        $this->connection = new PDO($this->dsn, $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $this -> connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $this->connection;

      } catch (PDOException $error) {

        //var_dump($error);

        $this->connection = new PDO($this->db, $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $query = $this->connection->prepare('CREATE DATABASE IF NOT EXISTS DB COLLATE utf8_spanish_ci');
        $query->execute();

        if($query){

      		$use_db = $this->connection->prepare('USE DB');
      		$use_db->execute();

          if($use_db){
          //Crear tablas
          }
        }
				
       return $this->connection;

      }
    }

    function close() {

       $connection = null;

    }

    function createTable(){
        $file = file_get_contents("users.sql");
        $this -> connection -> exec($file);
    }

    

    public function getMail($mail, $pass){
      $rows = $this -> connection -> query("select correo from usuarios");
      $rows2 = $this -> connection -> query("select pass from usuarios");
      $correos = array();
      $contraseñas = array();
      foreach($rows as $row){
        foreach($row as $field){
          array_push($correos, $field);
        }
      }

      foreach($rows2 as $row){
        foreach($row as $field){
          array_push($contraseñas, $field);
        }
      }
      

      if(in_array($mail, $correos) && in_array($pass, $contraseñas)){
        header('Refresh: 0; url=index.php?logged');
      }else{
        echo "<p>El correo <span style='color: #ff0000;'>".$mail."</span> o la contraseña <span style='color: #ff0000;'>".$pass."</span> son incorrectas</p>";
      }
    }

    //Product Functions
    
   /* public function deleteProduct($id){
      $query = 'delete from productos where id = '$id'';
      $this -> connection -> exec($query);
  }*/

  public function getProducts(){
      $query = 'select * from productos';
      $this -> connection -> exec($query);
  }

 /* public function updateProduct($id, $nombre, $precio, $fecha, $descripcion){            
      $query = 'update productos set nombre = '$nombre' && precio = '$precio' && fecha = '$fecha' && descripcion = '$descripcion' where id = '$id'';
      $this -> connection -> exec($query);
  }*/
}

?>