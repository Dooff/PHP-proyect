<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shoppy</title>
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/pushbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>

    

    <div data-pushbar-id="pussybar" class="pushbar from_left pussybar">
        <div id="wrapper">
            <div id="navigation">
                <div class="div left"><a class="left push a"href="#"><i class="fa fa-home" class="button"></i> Inicio</a></div>
                <div class="div left"><a class="left push a"href="gallery.html" class="dropdown"><i class="fa fa-photo" class="button"></i> Galería</a></div>
                <div class="div left"><a class="left push a"href="blog.html"><i class="fa fa-book" class="button"></i> Blog</a></div>
                <div class="div left"><a class="left push a"href="about.html"><i class="fa fa-info" class="button"></i> Más info</a></div>
                <div class="div left"><a class="left push a"href="ModelReleaseForm.pdf" target="_blank"><i class="fa fa-plane" class="button"></i> Próximos productos</a></div>
                <div class="div left"><a class="left push a"href="contact.html"><i class="fa fa-user" class="button"></i> Contactar</a></div>
            </div>

        </div>
     
      <a href="#" type="button"
    onclick="document.getElementById('demo').innerHTML = Date()">
    Pulsa para ver la fecha y hora actual</a>

    <p style="color: white;" id="demo"></p>
      <a href="#" data-pushbar-close>Close</a>
  </div>

  <div class="pushbar_main_content">
      <h1>Bienvenido a Shoppy</h1>
    <nav>
    <a href="#"><i class="fa fa-bars" class="boton ini" data-pushbar-target="pussybar"></i></a>
        <div class="divnav">Productos Populares</div>
    </nav>      

    <xml id="1" src="animal.xml"></xml>
        <div class="container">
            <div class="xmldiv">
            
            <a href="manager.php">Editar animales</a>
                <table>
                    <tr>
                        <th>Portada</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Color</th>
                        <th>Edad</th>
                    </tr>

                    <?php

                        $animales = simplexml_load_file("animal.xml");
                        foreach($animales as $animal){
                        echo "<td><img class='img' src=".$animal->foto."></img></td>";
                        echo "<td>".$animal->nombre."</td>";
                        echo "<td>".$animal->tipo."</td>";
                        echo "<td>".$animal->color."</td>";
                        echo "<td>".$animal->edad."</td>";
                        echo "</tr>";
                        }
                    ?>
                    </table>
            </div>
        </div>

  </div>
    <script src="./js/pushbar.js"></script>
    <script type="text/javascript">
        var pushbar = new Pushbar({
                blur:false,
                overlay:true,
            });
    </script>
</body>
</html>