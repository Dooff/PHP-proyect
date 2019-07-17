<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    <link href='https://fonts.googleapis.com/css?family=Nova Flat' rel='stylesheet'>
    <link rel="stylesheet" href="./css/estilos.css">
</head>
<body>
    <?php
        require_once "functions.php";
    if(isset($_GET['logged'])){
        logged();
    }else{
        
        if(isset($_POST['mail'])){
                prelog();        
        }else{
            if(isset($_POST['name'])){
                verify();
            }else{
            if(isset($_GET['login'])){
                login();            
            }else{
                    if(isset($_GET['register'])){
                        register();
                    }else{
                        if(isset($_GET['close'])){
                            close();
                        }else{
                            inicio();
                        }
                    }
                } 
            }
        }
    }
    ?>
</body>
</html>