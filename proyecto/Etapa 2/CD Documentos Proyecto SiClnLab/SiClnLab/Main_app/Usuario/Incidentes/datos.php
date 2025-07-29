<?php 
    require_once 'conexion/conect.php';

    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];
    $matricula = $_POST['matricula'];

    $sql = "INSERT INTO `incid`(`Fecha_incidencia`, `Descripcion`, `Matricula`) VALUES ('$fecha','$descripcion','$matricula')";
    $result = $conexion->query($sql);

    session_start();
    $_SESSION["Mensaje"]="Reporte realizado con exito";

    if(result){
        header("Location: http://localhost/incidentes/incidentes.php", true, 301);
        exit();
    }

 ?>