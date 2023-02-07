<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>

    <?php
        include 'conexion.php';
        if(!isset($_POST["modificar"])){
            $id=$_GET["id"];
            $nombre=$_GET["nombre"];
            $tipo=$_GET["tipo"];
            $numJugadores=$_GET["numJugadores"];
            $gratuito=$_GET["gratuito"];
            $foto=$_GET["foto"];
        }else{
            $id=$_POST["id"];
            $nombre=$_POST["nom"];
            $tipo=$_POST["tip"];
            $numJugadores=$_POST["num"];
            $gratuito=$_POST["grat"];
            $foto=$_POST["foto"];

            $consulta= "UPDATE juego SET nombre = :nombre, tipo = :tipo, numJugadores = :numJugadores, gratuito = :gratuito, foto = :foto WHERE ID = :id";
            $resultado = $conexion->prepare($consulta);

            $resultado->execute(array(":id"=>$id,":nombre"=>$nombre,":tipo"=>$tipo,":numJugadores"=>$numJugadores,":gratuito"=>$gratuito,":foto"=>$foto));

            header("location:crud.php");
        }
        
    ?>

    <h1>Modificar</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <table>
            <tr>
                <td><input type="hidden" name="id" id="id" value="<?php echo $id ?>"></td>
            </tr>
            <tr>
                <td>Nombre</td><td><input type="text" name="nom" id="nombre" value="<?php echo $nombre ?>"></td>
            </tr>
            <tr> 
                <td>Tipo</td><td><input type="text" name="tip" id="tipo" value="<?php echo $tipo ?>"></td>
            </tr>
            <tr>
                <td>Numero Jugadores</td><td><input type="text" name="num" id="numJugadores" value="<?php echo $numJugadores ?>"></td>
            </tr>
            <tr>
                <td>Gratuito</td><td><input type="text" name="grat" id="gratuito" value="<?php echo $gratuito ?>"></td>
            </tr>
            <tr>
                <td>Imagen</td><td><input type="text" name="foto" id="foto" value="<?php echo $foto ?>"></td>
            </tr>
            <tr>
                <td><input type="submit" value="modificar" name="modificar" id="modificar"></td>
            </tr>
        </table>
    </form>
    
    </body>
</html>