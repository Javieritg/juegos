<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <link rel="stylesheet" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <title>Document</title>
</head>
<body>



<?php

    /*session_start();
    if(!isset($_SESSION["nombre"])){
        header('location:formulario.php');
    }*/

?>

<div class="fondo">

</div>

    <?php
    
        try{
            $conexion = new PDO('mysql:host=localhost;dbname=juegos', 'root','');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $conexion->exec("SET CHARACTER SET UTF8");

            $array=array();
            $registros = $conexion->query("SELECT foto FROM juego")->fetchAll(PDO::FETCH_OBJ);
        
        }catch(Exception $e){
            echo $e->getMessage() . " la linea de error es: " . $e->getLine();
        }

    ?> 

<?php
    
    
        $db_host= "localhost";
        $db_user= "root";
        $db_password= "";
        $db_database= "juegos";

        $connection = mysqli_connect($db_host, $db_user, $db_password, $db_database);
 
        $dataConsulta = "SELECT
        us.nombre,
        ju.nombre

        FROM juego ju

        LEFT JOIN favoritos fav ON fav.idJuego = ju.id
        LEFT JOIN usuario us ON us.id = fav.idUsuario
        GROUP BY  us.nombre;";

        $resultConsulta = mysqli_query($connection, $dataConsulta);
            

?> 

<div class="titulo" >
    <div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
        <h1 class="animate-charcter"> Juegos</h1>
        </div>
    </div>
    </div>
</div>
    <audio controls autoplay loop>
        <source src="music.mp3" type="audio/mp3">
        <source src="music.org" type="audio/org">
    </audio> 

    <div class="slider">
        <?php
            foreach($registros as $juegos):
        ?>
            <div>
                <img class="imagen" src="<?php echo $juegos->foto;?>" class="imagen" alt="" width="400" height="300">
            </div>
        <?php
            endforeach;
        ?>
    </div>
    <a class="boton" href="cerrarsesion.php">Cerrar sesión</a><br><br><br><br>
    <a class="boton" href="crud.php">Modificar</a><br><br><br><br><br>

    <div class="fav">
        <h1>Favoritos de la comunidad</h1>
        <?php
        while ($row = mysqli_fetch_row($resultConsulta)){
            echo "<div class='favorito'>Usuario: " . $row[0] . "<br>Juego Favorito: " . $row[1] ."<br><br></div>";

        }
        ?>
    </div>
    <script>
    $(document).ready(function(){
      $('.slider').bxSlider();
    });
  </script>
    
</body>
</html>