<?php
session_start();
require_once './Conexion.php';
require_once './User.php';

    function inicio(){
        $config = file_get_contents('db.json');
        $db = new Conexion($config);
        $db -> connect();
        $db -> createTable();
        $db -> close();
        echo "<div>
        <h1>Bienvenido al Inicio</h1>
        <p style='color: white;'>Selecciona que deseas hacer</p>
        <p><a href='index.php?login'>Iniciar sesión</a> <span style='color: rgb(78, 192, 230);'>|| </span><a href='index.php?register'>Crear cuenta</a></p>
        </div>";
    }

    function login(){    
        echo "<div>
        <h1>Bienvenido a mi webb</h1>
        <p>Introduce tus datos</p>
        <form method='post' action=''>
        <fieldset>
        <legend>Identifícate</legend>              
        <p>Correo: <input type='email' placeholder='user@gmail.com' name='mail' required></p>
        <p>Contraseña: <input type='password' name='pass' required></p>  
        <input type='submit' value='Introducir datos'>       
        </fieldset>
        </form>
        <p><a href='index.php'>Volver al inicio</a>
        <a href='index.php?register'>Crear mi cuenta</a></p>
        </div>";
    }

    function register(){
        echo "<div>
        <h1>Bienvenido al Registro de Usuarios</h1>
        <p>Introduce tus datos</p>
        <form method='post' action=''>
        <fieldset>
        <legend>Datos Personales</legend>        
        <p>Nombre: <input type='text' name='name' required></p>
        <p>Apellidos: <input type='text' name='apellidos' required></p>
        <p>Contraseña: <input type='password' name='newpass' required></p>
        <p>Repetir contraseña: <input type='password' name='renewpass' required></p>
        <p>Correo: <input type='email' name='newmail' required></p>
        <p>Edad: <input type='number' min='18' max='100' name='edad' required></p>
        </fieldset>

        <fieldset>
        <legend>Datos Secundarios</legend>        
        <p>Color favorito: <input type='color' name='color'></p>
        <p>Fecha de nacimiento: <input type='date' name='fecha' required></p>
        <p>Descripción: <textarea name='area' cols=40 rows=20 required></textarea></p>        
        </fieldset>

        <input type='submit' value='Acceder'>   
        <input type='reset' value='Eliminar Datos'> 
        </form>
        <p><a href='index.php'>Volver al inicio</a>
        <a href='index.php?login'>Iniciar sesión</a></p>
        </div>";
    }

    function verify(){
        if($_POST['newpass'] == $_POST['renewpass']){
            verified();
        }else{            
            echo "<script type='text/javascript'>alert('Contraseña errónea');</script>"; 
            header('Refresh: 0; url=index.php?register');
        }
    }

    function verified(){
        $name = $_POST['name'];
        $apellidos = $_POST['apellidos'];
        $pass = $_POST['newpass'];
        $correo = $_POST['newmail'];
        $edad = $_POST['edad'];
        $color = $_POST['color'];
        $fecha = $_POST['fecha'];
        $descripcion = $_POST['area'];
        
        $_SESSION['name'] = $name;
        $_SESSION['apellidos'] = $apellidos;
        $_SESSION['pass'] = $pass;
        $_SESSION['correo'] = $correo;
        $_SESSION['edad'] = $edad;
        $_SESSION['color'] = $color;
        $_SESSION['fecha'] = $fecha;
        $_SESSION['descripcion'] = $descripcion;


        $config = file_get_contents('db.json');

        $user = new User($config, $name, $apellidos, $pass, $correo, $edad, $color, $fecha, $descripcion);
        $user -> connectUser();
        $user -> addUser();
        $user -> closeUser();

        echo "<script type='text/javascript'>alert('Usuario añadido con éxito');</script>"; 
        header('Refresh: 0; url=index.php?login');

    }

    function prelog(){
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];
        $config = file_get_contents('db.json');
        $db = new Conexion($config);
        $db -> connect();
        $fuet = $db -> getMail($mail, $pass);
        if($fuet != $_POST['mail']){
            //echo "<script type='text/javascript'>alert('Ha ocurrido un error');</script>"; 
            
            echo "<p>Prueba a volver a introducir los parámetros</p>";
        }
        $db -> close();
        echo '<p><a href="index.php?login">Volver al login </a></p>';
        echo "<p>O cierra la sesión y vuelve al inicio</p>";
        echo '<p><a href="index.php?close"> Cerrar sesión</a></p>';
    }

    function logged(){
        header('Location: apk.php');
    }

    function close(){
        session_destroy();
        header('Location: index.php');
    }


?>