<?php
include("../usuario.php");
	include("conexion.php");
	$vendedor=$_POST['vendedor'];
	$monto=$_POST['monto'];
	$fecha= $_POST["fecha"];
	 //$_SESSION["user"]; <-- recordar que es una fk y por tanto debe ser una matricula registrada.
$sql=  "insert into compr (id_compr, fk_usuar_matri, fecha, vendr, monto) values (NULL, ".$matri_usuar.", (select now()), '".$vendedor."', ".$monto.")";
	if($resultado = $mysqli->query($sql) ){
		$sql= "SELECT MAX(id_compr) AS ultimo FROM compr";
		if($resultado= $mysqli->query($sql) ){
			$registro= $resultado->fetch_assoc();
			$_SESSION["compraNo"]= $registro["ultimo"];
			header("location:detalles_compras.php");
		} else { echo "Algo ha fallado al intentar obtener el valor del último registro"; }
	} else { echo "Algo a fallado al intentar insertar un registro en la tabla Compras"; }
?>
