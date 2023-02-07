<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>
<body>

    <?php

        session_start();
        if(!isset($_SESSION["nombre"])){
            header('location:formulario.php');
        }

    ?>
    <div class="fondo">

    </div>

    <?php
        include 'conexion.php';
        $registros=$conexion->query("SELECT * FROM juego")->fetchAll(PDO::FETCH_OBJ);

        if(isset($_POST["crear"])){
            $nombre=$_POST["nombre"];
            $tipo=$_POST["tipo"];
            $numJugadores=$_POST["numJugadores"];
            $gratuito=$_POST["gratuito"];
            $foto=$_POST["foto"];

            $consulta = "INSERT INTO juego (nombre, tipo, numJugadores, gratuito, foto) VALUES (:nombre, :tipo, :numJugadores, :gratuito, :foto)";

            $resultado = $conexion->prepare($consulta);

            $resultado->execute(array(":nombre"=>$nombre,":tipo"=>$tipo,":numJugadores"=>$numJugadores,":gratuito"=>$gratuito,":foto"=>$foto));

            header("location:crud.php");
        }
        if(isset($_POST["favorito"])){

            $idUsuario = $_SESSION["nombre"];

            $sql = "SELECT * FROM usuario WHERE nombre = '$idUsuario'";

            $resultadoid = $conexion->prepare($sql);

            $resultadoid->execute();

            while($registroid = $resultadoid->fetch(PDO::FETCH_ASSOC)){
                $idUsuario= $registroid["id"];
                echo $idUsuario;
            }

            $idJuego = $_POST["juegos"];

            
            echo $idUsuario;
            echo $idJuego;

            $consulta = "INSERT INTO favoritos (idUsuario,idJuego) VALUES (:idUsuario, :idJuego)";

            $resultado = $conexion->prepare($consulta);

            $resultado->execute(array(":idUsuario"=>$idUsuario,":idJuego"=>$idJuego));

            header("location:crud.php");
        }
    ?>

<?php
    include 'conexion.php';

    $consulta = "SELECT * FROM juego";

    $resultado = $conexion->prepare($consulta);

    $resultado->execute(array());


    $tamanoPaginacion = 3;
    $pag = 1;
    $filas = $resultado->rowCount();
    $totalPag = ceil($filas/$tamanoPaginacion);
    

    if(isset($_GET["pagina"])){
        if($_GET["pagina"]==1){
            header("location:crud.php");
        }else{
            $pag=$_GET["pagina"];
        }
    } else {
        $pag = 1;
    }

    $inicio = ($pag-1) * $tamanoPaginacion;
    
    $registros=$conexion->query("SELECT * FROM juego LIMIT $inicio,$tamanoPaginacion")->fetchAll(PDO::FETCH_OBJ);

    $resultado->closeCursor();

    ?>
    <div class="crud">
    <div class="titulo"><h1>CRUD</h1></div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <table>
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Tipo</td>
                <td>Numero Jugadores</td>
                <td>Gratuito</td>
                <td>Imagen</td>
            </tr>
            <?php
                foreach($registros as $juego):
            ?>
                <tr>
                    <td><?php echo $juego->id ?></td>
                    <td><?php echo $juego->nombre ?></td>
                    <td><?php echo $juego->tipo ?></td>
                    <td><?php echo $juego->numJugadores ?></td>
                    <td><?php echo $juego->gratuito ?></td>
                    <td><img src="<?php echo $juego->foto?>" class="imagen" alt="" width="40" height="30"></td>
                    <td><a href="borrar.php?id=<?php echo $juego->id?>"><input type="button" value="borrar" id="borrar"></a></td>
                    <td><a href="modificar.php?id=<?php echo $juego->id?> & nombre=<?php echo $juego->nombre?> & tipo=<?php echo $juego->tipo?> & numJugadores=<?php echo $juego->numJugadores?> & gratuito=<?php echo $juego->gratuito?> & foto=<?php echo $juego->foto?>">
                        <input type="button" value="modificar" id="modificar"></a>
                    </td>
                </tr>
            <?php
                endforeach;
            ?>
            <tr>
                <td></td>
                <td><input type="text" name="nombre" id="nombre" placeholder="Nombre"></td>
                <td><input type="text" name="tipo" id="tipo" placeholder="Tipo"></td>
                <td><input type="text" name="numJugadores" id="numJugadores" placeholder="Numero Jugadores"></td>
                <td><input type="text" name="gratuito" id="gratuito" placeholder="Gratuito"></td>
                <td><input type="text" name="foto" id="foto" placeholder="url de la imagen"></td>
                <td><input type="submit" name="crear" value="crear"></td>
            </tr>
        </table>
    </form>

    <div class="pag">
        <tr>
            <td>
                <?php
                        echo $pag . " de " . $totalPag . " páginas" . "<br>";
                        for ($i=1; $i <= $totalPag ; $i++) { 
                            echo "<a href ='?pagina=" . $i . "'>" . $i ."</a>";
                        }
                ?>
            </td>    
        <tr>
    </div>
    </div><br><br><br>

    <a class="boton" href="main.php">Volver</a>

    <div class="anadir">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            
            
                <tr>
                    <select name="juegos" id="juegos">
                    <?php
                    $registros=$conexion->query("SELECT * FROM juego")->fetchAll(PDO::FETCH_OBJ);
                        foreach($registros as $juego):
                    ?>
                        <option name="opcion" value="<?php echo $juego->id ?>"><?php echo $juego->nombre ?></option>
                    <?php
                        endforeach;
                    ?>   
                    </select>
                        
                    <td><input type="submit" name="favorito" value="favorito"></td>
                </tr>
              
        </form>

    </div>
    
</body>
</html>