
<?php
include'conect.php';

      $cantidad=$_POST['cant_prest']; 
       $registro=$_POST['act'];
       $fk_prest=$_SESSION["prestConsNum"];
if($registro=="equi"){ // equipos
	              $id_categ=1;
	              $id_mob=$_POST['id_equip'];
		          

	$query = "INSERT INTO `detall_prest`(`fk_prest`, `fk_categ`, `fk_objeto_id`, `cant` ) VALUES ('$fk_prest','$id_categ','$id_mob','$cantidad');";
		
	$exito = $conexion->query($query);
	
	$sql2="UPDATE equip SET canti_equip = canti_equip-".$cantidad." WHERE id_equip = ".$id_mob;
	
	$resultado = $conexion->query($sql2);
	 echo $query;
	 echo $sql2;
		if($resultado){
		
		echo"funciono";
	}else{
			echo"no funciono";
		}
	} else if ( $registro == "mater" ){ // materiales
		        $id_categ=2;
				$id_mater=$_POST['id_mater'];
		        

	$query = "INSERT INTO `detall_prest`(`fk_prest`, `fk_categ`, `fk_objeto_id`, `cant` ) VALUES ('$fk_prest','$id_categ','$id_mater','$cantidad');";
	
	$exito = $conexion->query($query);
	$sql2="UPDATE mater SET canti = canti-".$cantidad." WHERE id_mater = ".$id_mater;
	
	$resultado = $conexion->query($sql2);
	 echo $query;
	 echo $sql2;
	if($resultado){
		
		echo"funciono";
	}else{
			echo"no funciono";
		}
	} else if ( $registro == "mob" ){ // mobiliario
	             $id_categ=3;
	             $id_mob=$_POST['id_mobil'];
		       

	$query = "INSERT INTO `detall_prest`(`fk_prest`, `fk_categ`, `fk_objeto_id`, `cant` ) VALUES ('$fk_prest','$id_categ','$id_mob','$cantidad');";
	
	$exito = $conexion->query($query);
	$sql2="UPDATE mobil SET canti = canti-".$cantidad." WHERE id_mobil = ".$id_mob;
	$resultado = $conexion->query($sql2);
	 echo $query;
	 echo $sql2;
	if($resultado){
		
		echo"funciono";
	}else{
			echo"no funciono";
		}
	
	} 
	header("location: detall_prest.php");
 ?>
	
	

<!---
<?php
session_start();
   $prest_consu= $_SESSION["Numprest"];
   $id_react= (int) $_POST['id_react'];
   $cantidad= (int) $_POST['text_cant_consu'];
   include'conect.php';
   // insertando
	$sql="INSERT INTO detall_prest_consu VALUES (NULL, ".$prest_consu.", ".$id_react.", ".$cantidad.")";
	echo $sql;
	$exito= $mysqli->query($sql);
	// actualizando
	$sql2="UPDATE react SET cant = cant-".$cantidad." WHERE id_react = ".$id_react;
	if($exito=$mysqli->query($sql2)){
	echo "<a href= 'llenar_prestamo.php	'>Continuar</a>";
	//	header("Location: llenar_prestamo.php");
	}else{
		echo "Algo ha fallado.";
	}
?>
---->