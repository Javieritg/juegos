<?php

    if(isset($_POST["registro"])){

        try{
            $user = htmlentities(addslashes($_POST['nombre']));
            $pass = htmlentities(addslashes($_POST['contrasena']));

            $pass_encriptada = password_hash($pass, PASSWORD_BCRYPT, array("cost"=>12));

            $conexion_db = new PDO('mysql:host=localhost;dbname=juegos', 'root','');
            $conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $consulta = "INSERT INTO usuario (nombre, contrasena)
            VALUES
            (:user, :pass)";
        
            $resultado = $conexion_db->prepare($consulta);
                        
            $resultado->execute(array(':user'=> $user,':pass'=> $pass_encriptada));
             
            header("location:formulario.php");

            }catch(Exception $e){
                echo $e->getMessage() . " la linea de error es: " . $e->getLine();
            }
    }

    if(isset($_POST["login"])){

        try{

                $nombre = !empty($_POST['nombre']) ? trim($_POST['nombre']) : null;;
                $contras = !empty($_POST['contrasena']) ? trim($_POST['contrasena']) : null;
        
                $conexion_db = new PDO('mysql:host=localhost;dbname=juegos','root','');
                $conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                $consulta = "SELECT * FROM usuario WHERE nombre=:nombre";
        
                $resultado = $conexion_db->prepare($consulta);
                
                $resultado->execute(array(':nombre'=> $nombre));

                if($registro = $resultado->fetch(PDO::FETCH_ASSOC)){
                    $psw = $registro["contrasena"];
                    if ($registro["nombre"] == $nombre && password_verify($contras, $psw)) {
                        session_start();
                        $_SESSION["nombre"]=$_POST["nombre"];
                        header('location:main.php');
                    } else {
                        header('location:formulario.php');
                    }
                    
                } else {
                    header('location:formulario.php');
                }
                        
            }catch(Exception $e){
                echo $e->getMessage() . " la linea de error es: " . $e->getLine();
            }
    }
?>
   