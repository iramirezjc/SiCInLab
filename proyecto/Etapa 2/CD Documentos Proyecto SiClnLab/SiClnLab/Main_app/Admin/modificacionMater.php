<?php
include("admin.php");
			if(@$_POST['id_mat']){			
			include("conexion.php");
			$sql= "SELECT * FROM mater WHERE id_mater= ".$_POST['id_mat'];
			$resultado = $mysqli->query($sql);
			$filas= $resultado->num_rows;				
			$registro= $resultado->fetch_assoc();
			$id_= $registro['id_mater'];
			$nom_= $registro['nombr'];
			$cap_= $registro['capac'];
			$cant_= $registro['canti'];
			$marc_= $registro['marca'];
			$unids_result = $mysqli->query("select nombr from unids where id_unids=".$registro['fk_unids']);
			$unids= $unids_result->fetch_assoc();
			$fk_= $unids['nombr'];
			}
		?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.70" />
		<title>Modificacion de Materiales</title>
		<link rel="stylesheet" href="/SiClnLab/Main_app/estilo.css" />
	</head>
	<body>
		
<center>
				
			<form method="post" action="updateObjeto.php" >
						<input type="hidden" name="idMat" id="idMat"
								<?php if(@$_POST['id_mat']){echo "value= '".$id_."'"; }?>
								/> 
						<table border="0">
	<tr>
		<th>Nombre:</th>
		<td>
			<input type="text" name="nomMater" id="nomMater"size= "20" maxlength="30" 
								<?php if(@$_POST['id_mat']){echo "value= '".$nom_."'"; }?>
								/></td>
	</tr>
	<tr>
		<th>Capacidad:</th>
		<td><input type="text" name="capaciMater" id="capaciMater"
								
								<?php if(@$_POST['id_mat']){echo "value= '".$cap_."'"; }?>
								/></td>
	</tr>
	<tr>
		<th>Cantidad:</th>
		<td><input type="text" name="cantiMater" id="cantiMater"
							<?php if(@$_POST['id_mat']){echo "value= '".$cant_."'"; }?>/> </td>
	</tr>
	<tr>
		<th>Marca:</th>
		<td><input type="text" name="marcMater" id="marcMater"
		<?php if(@$_POST['id_mat']){echo "value= '".$marc_."'"; }?>
								/></td>
	</tr>
	<tr>
		<th>Unidad:</th>
		<td><input type="text" name="fkUnidad" id="fkUnidad"
								<?php if(@$_POST['id_mat']){ echo "value= '".$fk_."' "; }?>
								 disabled /> </td>
	</tr>
</table>
<table>
	<tr>
		<th>	Confirmar Actualizacion</th>
		<td><input type="checkbox" name="guardar" value="1" /></td>
		<td>	<input type="submit" value="Actualizar" /></td>
	</tr>
</table>			
						
						
						
						
						
					
					
				</form>
						
				
				</center>
	
	</body>
</html>



		