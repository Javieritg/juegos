<?php

try{
    $conexion = new PDO('mysql:host=localhost;dbname=juegos', 'root','');
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conexion->exec("SET CHARACTER SET UTF8");

}catch(Exception $e){
    echo $e->getMessage() . " la linea de error es: " . $e->getLine();
}

