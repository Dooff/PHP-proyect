<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manager</title>
    <link rel="stylesheet" href="./css/estilos.css">
</head>
<body>
    

<?php
        
        echo '<p><a href="apk.php">Volver al Inicio</a></p>';
        
        if(isset($_POST['newnombre'])){
            //POST variables  
            $nombre = $_POST['newnombre'];
            $precio = $_POST['newtipo'];
            $foto = $_POST['newfoto'];
            $fecha = $_POST['newcolor'];
            $descripcion = $_POST['newedad'];
            $item = $_POST['item'];
            //DOM Time!
            $file = 'productos.xml';
            $doc = new DOMDocument;        
                $doc->load("productos.xml");
                $animales = $doc->documentElement;
                $animal = $animales->getElementsByTagName('nombre')->item($item)->nodeValue="$nombre";
                $animal = $animales->getElementsByTagName('precio')->item($item)->nodeValue="$precio";
                $animal = $animales->getElementsByTagName('foto')->item($item)->nodeValue="$foto";
                $animal = $animales->getElementsByTagName('fecha')->item($item)->nodeValue="$fecha";
                $animal = $animales->getElementsByTagName('descripcion')->item($item)->nodeValue="$descripcion";
                $doc->save($file);

                echo "Animal actualizado correctamente!!";
                header("Refresh: 3; url=apk.php");
        }else{
            if(isset($_GET['delete'])){  
                $file = 'productos.xml';
                $doc = new DOMDocument;        
                $doc->load("productos.xml");
                $animales = $doc->documentElement;
                $item = $_GET['delete'];
                $animal = $animales->getElementsByTagName('producto')->item($item);
                $oldanimal = $animales->removeChild($animal);
                $doc->save($file);
                $config = file_get_contents('db.json');
                $db = new Conexion($config);
                $db -> connect();
                $db -> deleteProduct($item);
                $db -> close();

                echo "Animal eliminado correctamente!!";
                header("Refresh: 3; url=apk.php");
        
            }else if(isset($_GET['edit'])){
                $doc = new DOMDocument;
                $doc->load("productos.xml");
                $animales = $doc->documentElement;
                $item = $_GET['edit'];
                $animal = $animales->getElementsByTagName('nombre')->item($item)->nodeValue;
                echo "<h1>Editar el animal:".$animal."</h1>";
                echo '<form action="" method="post">
                    <p>Nueva portada: <input type="text" name="newfoto" placeholder="Introducir URL" required></p>
                    <p>Nueva nombre: <input type="text" name="newnombre" required></p>
                    <p>Nueva tipo: <input type="text" name="newtipo" required></p>
                    <p>Nueva color: <input type="text" name="newcolor" required></p>
                    <p>Nueva edad: <input type="text" name="newedad" required></p>
                    <input type="hidden" name="item" value="'.$_GET['edit'].'">
                    <input type="submit" value="Editar '.$animal.'">
                </form></div>';
                
                echo '<a href="manager.php">Volver</a>';
            }else{
            if(isset($_POST['nombre'])){
                
                $xml = new SimpleXMLElement("productos.xml", 0, true);

                $animal = $xml->addChild('animal');
                $animal->addChild('nombre', $_POST['nombre']);
                $animal->addChild('precio', $_POST['precio']);
                $animal->addChild('foto', $_POST['foto']);
                $animal->addChild('fecha', $_POST['fecha']);
                $animal->addChild('descripcion', $_POST['descripcion']);

                $xml->asXML("productos.xml");
                
                echo "Animal introducido correctamente!!";
                header("Refresh: 3; url=apk.php");
            }else if(isset($_GET['add'])){
                echo '<form action="" method="post">
                    <p>Portada: <input type="text" name="foto" placeholder="Introducir URL" required></p>
                    <p>Nombre: <input type="text" name="nombre" required></p>
                    <p>Tipo: <input type="text" name="tipo" required></p>
                    <p>Color: <input type="text" name="color" required></p>
                    <p>Edad: <input type="text" name="edad" required></p>
                    <input type="submit" value="Agregar Producto">
                </form></div>';
                
                echo '<a href="manager.php">Volver</a>';
                }else{                
                    echo '<div class="container">
                    <p><a href="manager.php?add">Añadir animal</a></p>
                <div class="xmldiv">
                    <table>
                        <tr>
                            <th>Portada</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Color</th>
                            <th>Edad</th>
                        </tr>';


                $animales = simplexml_load_file("productos.xml");
                $cont = -1;
                foreach($animales as $animal){
                    $cont++;
                echo "<td><img class='img' src=".$animal->foto."></img></td>";
                echo "<td>".$animal->nombre."</td>";
                echo "<td>".$animal->tipo."</td>";
                echo "<td>".$animal->color."</td>";
                echo "<td>".$animal->edad."</td>";
                echo "<td><a href='manager.php?edit=$cont'>Editar </a></td>
                <td>||</td>
                <td><a href='manager.php?delete=$cont'> Borrar Animal</a></td>
                </tr>";
                }

            echo '</table>';
        }
    }
}
?>

</body>
</html>