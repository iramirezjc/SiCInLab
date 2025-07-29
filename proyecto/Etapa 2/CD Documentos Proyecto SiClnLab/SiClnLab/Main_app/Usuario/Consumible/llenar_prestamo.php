<?php
include("../usuario.php");
include("conexion.php");
	$prest_consu = $_SESSION['prestConsNum'];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"><title></title>
	</head>
	<body>
<center>
		<!--- ---------------------------------------------------------------------------------------------------------- --->
		<table   >
			<tr >
				<th>
					<h1>Prestamo Consumible</h1>
				</th>
					
				<td rowspan="4">
			<div  style="overflow: auto;  height: 400px;">
						<b>Prestamos realizados:</b>
						<table border="1" id="tablas">
							
				        <tr>
						    <th>No.</th>
						    <th >Nombre</th>
						    <th >Cantidad</th>
					    </tr>
					    	   	
						<?php 

							$query = "SELECT * FROM detall_prest_consu WHERE fk_prest_consu='$prest_consu'";
							$result = $mysqli->query($query);
							$no = 1;
							while($row2 = $result->fetch_array()) {
								
								$nombre = $row2['fk_react'];
								$cantidad = $row2['cant'];

								//Obteniendo el nombre
								$query = "SELECT * FROM react WHERE id_react='$nombre'";
								$result3 = $mysqli->query($query);
								if($row3 = $result3->fetch_array()) {
									$nombre = $row3['nombr'];
								}

								echo '
									<tr>
										<td>'.$no.'</td>
										<td>'.$nombre.'</td>
										<td>'.$cantidad.'</td>
									</tr>
								';

								$no++;
							}	
						 ?>
						</table>
						</div>
					</td>
					
		
			</tr>
			<tr>
				<th>
					<h2>Realizando el prestamo <?php echo $_SESSION['prestConsNum']; ?>:</h2>
				</th>
			</tr>

			<tr >
				<td rowspan="2"   valign="top">
<div  style="overflow: auto;  height: 300px;">
					<table border="1" id="tablas">
						<tr>
							<th>Nombre</th>
							<th>Formula</th>
							<th>Cantidad</th>
							<th>Solicitado</th>
							<th>Unidades</th>
							<th></th>
						</tr>

							<?php
							$sql= "select id_react,nombr,formu,cant,fk_unids from react;";
							$contador=0;
							$resultado1= $mysqli->query($sql);
							
							//bucle que dibuja la tabla de los usuarios
							while($registro= $resultado1->fetch_assoc()){
								$resultado2=$mysqli->query("select nombr from unids WHERE id_unids=".$registro['fk_unids']);
						   		$unidades= $resultado2->fetch_assoc();
								echo "<tr>";
								echo "<td>".$registro['nombr']."</td>";
								echo "<td>".$registro['formu']."</td>";
								echo "<td>".$registro['cant']."</td>";
														
								echo "<td><form action='update_prest.php' method='post'>";
								echo "<input type='number' id='text_cant_consu' name='text_cant_consu' min='1' max='".$registro['cant']."' required/>";
								echo "<input type='hidden' id='id_react' name='id_react' value=".$registro['id_react']."/>";
								echo "<td>".$unidades['nombr']."</td>";	
								echo "<td> <input type='submit' id='modificaciones' value='Agregar a prestamos'/></td>";
								echo "</form></td>";							
								echo "</tr>";
								$contador++;
							}	
						?>
					
					</table>
					</div>
					<a href="/SiClnLab/Main_app/Admin/Consumible/prestamo_consumible.php" > <input type="button" id="eliminar" value="Finalizar prestamo"/> </a>
					
				
				
				</td>
					
					
				</tr>
					
			</table>

		</center>
		<!--- ---------------------------------------------------------------------------------------------------------- --->


	</body>
</html>