<?php

include 'conexion.php';

$id=$_GET['id'];

$conexion->query("DELETE FROM juego WHERE id = '$id'");

header('location:crud.php');