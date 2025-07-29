<?php
include("../usuario.php");
include("conexion.php");

	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Baja reactivo</title>
	</head>

	<body>
	  <center>
	<div style=" position:relative; top:50px; ">
		
		
		<h1> Baja de reactivo </h1>
		<form method="post" action="bajaReac.php">
		
		  <span>Nombre del reactivo</span>
		  <input type = "text" id = "Reactivo" name = "Reactivo">
		  <input type = "submit" id = "Buscar" value = "Buscar" name = "Buscar">
		 <a href="alta_react.php"><input type="button" value="Agregar reactivo"/></a>
		 <br>
		 <br>
		</form>
		
	<table border="1" id="tablas">
    <tr>
	    <th colspan="10">Resultados de búsqueda</th>	
	</tr>
	
	<tr>
		<th>Nombre</th>
		<th>Cantidad</th>
		<th>Unidad de medida</th>
		<th>Fórmula</th>
		<th>Peligro a la salud</th>
		<th>Inflamabilidad</th>
		<th>Inestabilidad</th>
		<th>Peligro específico</th>
		<th>Editar</th>
		<th>Eliminar</th>
		
	</tr>

	
			<?php
					$sql= "SELECT * FROM react";
					if(@$_POST['Reactivo']){
						$sql .= " WHERE nombr LIKE '%".$_POST['Reactivo']."%';";
					}		
					$res = mysqli_query($mysqli, $sql);		
					while($registro= mysqli_fetch_assoc($res)){
						$sql2 = mysqli_query($mysqli, "SELECT nombr FROM unids WHERE id_unids = ".$registro['fk_unids']."");
						while($nomb = mysqli_fetch_array($sql2)){
							$registro['fk_unids'] = $nomb['nombr'];
						}
					echo "<tr><td>".$registro['nombr'].
						 "</td><td>".$registro['cant'].
						 "</td><td>".$registro['fk_unids'].
						 "</td><td>".$registro['formu'].
						 "</td><td>".$registro['pelig_salud'].
						 "</td><td>".$registro['pelig_infla'].
						 "</td><td>".$registro['pelig_ines'].
						 "</td><td>".$registro['pelig_esp'].	
						 "</td><td>";
						
						echo "<form method='post' action='ModifReact.php'>";
						echo "<input type='hidden' name='id_react' id='id_react' value='".$registro['id_react']."'/>";
						echo "<input type='hidden' name='id_react' id='id_react' value='".
						$registro['id_react']."'/>";
						echo "<input type='submit' id='modificaciones' value='Modificar'/></form>";
						echo "</td><td>";
						echo "<form method='post' action='deleteReact.php'>";
						echo "<input type='hidden' name='id_react' id='id_react' value='".$registro['id_react']."'/>";
						echo "<input type='Checkbox' name='confirmar' id='confirmar' />";		 
						echo "<input type='submit' id='eliminar' value='Eliminar' /></form>"; 
						echo "</td></tr>";								 
					}		
				?>	
				
	</table>
	</div>
	  </center>
	</body>
</html>