<?php
include("../usuario.php");
?>

<head>
	<meta http-equiv= "Content-Type" 
	content="charset= UTF-8" />
</head>
<body >
<center><h1>Gestión de equipos</h1>
<form method="post" action="MostrarEquipo.php" >
				
	<h3 >Nombre de equipo: <input type="text" name="filtro_nom" id="filtro_nom" />
					<input type="submit" value="Buscar" />
					<input type="button" onclick="location.href='AltaEquipo.php'" value="Agregar equipos" /> </h3>
					
  				</form>
				
				<h4 align="justify">Resultados:</h4>
				<table border="1" id="tablas">
				
				<tr  >
				<th id="claves">Clave</th><th >Nombre de equipo</th><th >Cantidad</th>
				<th >Descripcion</th><th >Tipo</th><th >Operaciones</th>
				</tr>
				
				<!--Alta Equipos-->
					
 					 				
				<?php
				$sql= "SELECT * FROM equip";
				if(@$_POST['filtro_nom']){
					$sql .= " WHERE nombr_equip LIKE '%".$_POST['filtro_nom']."%';";
				}
				include("conexion.php");				
				$resultado = $mysqli->query($sql);
				$filas= $resultado->num_rows;				
				while($registro= $resultado->fetch_assoc()){
					echo "<tr><th id='claves'>".$registro['id_equip'].
						 "</th><td>".$registro['nombr_equip'].
						 "</td><td>".$registro['canti_equip'].
						 "</td><td>".$registro['descr'].
						 "</td><td>".$registro['tipo'].
						 "</td><td>";		
						?>
						<table border="0">
							<tr >
							<td >
							<?php echo "<form method='post' action='ModificacionDeEquipo.php'>";
						echo "<input type='hidden' name='id_eq' id='id_eq' value='".
						$registro['id_equip']."'/>";
						echo "<input type='submit' id='modificaciones' value='Modificar'/></form>";			 
						echo "</td>";?>
						</td>
							
								<td >
						<?php echo "<form method='post' action='DeleteEquip.php'>";	
						echo "<input type='hidden' name='id_equip' id='id_equip' value='".$registro['id_equip']."'/>";         	
						echo "<input type='Checkbox' name='confirmar' id='confirmar'/>";
						echo "<input type='submit' id='eliminar' value='Eliminar' /></form>";
						?>						
						</td>
							</tr>
						</table>	
					<?php		 			 
				}		
				?>		
						
			</table>
			<p align="justify"> Se han encontrado <?php echo $filas; ?> registros.</p>
							
		
</center>
</body>