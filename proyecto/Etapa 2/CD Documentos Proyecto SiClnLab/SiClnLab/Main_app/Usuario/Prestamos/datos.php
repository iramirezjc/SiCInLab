<?php 
include("../usuario.php");
    include 'conect.php';

    $solicitante = $_POST['solicitante'];
    $matricula = $_POST['matricula'];
    $entrega = $_POST['entrega'];
    $devolucion = $_POST['devolucion'];
   

//id    solicitante matricula   entrega devolucion  disponible  prestar
    $sql = "INSERT INTO `prest`(`fk_usuar_matri`, `matri_solic`, `fecha_entre`, `fecha_devol` ) VALUES ('$solicitante','$matricula','$entrega','$devolucion');";
    
    $result = $conexion->query($sql);

$sql1= "select max(id_prest) as final from prest";
if($resultado= $conexion->query($sql1)){
	$registro= $resultado->fetch_assoc();
	$_SESSION["prestConsNum"]= $registro["final"];
	
}
else {
	echo "error";
}

if($result){
	
	header("Location: detall_prest.php");
}
else {
	
	echo "Error Usuario no indentificado";
	echo "<a href='prestamo.php' > Regresar </a>";
}
	




 ?>