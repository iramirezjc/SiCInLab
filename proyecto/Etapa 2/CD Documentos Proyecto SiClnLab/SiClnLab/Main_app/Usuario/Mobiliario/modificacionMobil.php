<?php
include("../usuario.php");
			if(@$_POST['id_mobil']){			
			include("conexion.php");
			$sql= "SELECT * FROM mobil WHERE id_mobil= ".$_POST['id_mobil'];
			$resultado = $mysqli->query($sql);
			$filas= $resultado->num_rows;				
			$registro= $resultado->fetch_assoc();
			$id_mobil_= $registro['id_mobil'];
			$tipo_= $registro['tipo'];
			$mater_= $registro['mater'];
			$nombr_= $registro['nombr'];
			$canti_= $registro['canti'];
			
			}
		?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Modificacion de Mobiliario</title>
	</head>
	<body>
			<form method="post" action="updateObjeto.php" >
			
			<center>
<table>
	<tr>
		<td><input type="hidden" name="idMob" id="idMobi"<?php if(@$_POST['id_mobil']){echo "value= '".$id_mobil_."'"; }?>/>IdMobil:</td>
		<td><input type="text" name="nomMobil" id="nomMobil" size= "20" maxlength="30"  <?php if(@$_POST['id_mobil']){echo "value= '".$id_mobil_."'"; }?> disabled /> </td>
	</tr>
	
	<tr>
		<td>Tipo:</td>
		<td><input type="text" name="tipoMobil" id="tipoMobil" size= "20" maxlength="50" <?php if(@$_POST['id_mobil']){echo "value= '".$tipo_."'"; }?> /></td>
	</tr>
	
	<tr>
		<td>Materiales:</td>
		<td><input type="text" name="materMobil" id="materMobil" size= "20" maxlength="11"  <?php if(@$_POST['id_mobil']){echo "value= '".$mater_."'"; }?> /></td>
	</tr>
	
	<tr>
		<td>Nombre:</td>
		<td><input type="text" name="nombrMobil" id="nombrMobil" size= "20" maxlength="30" <?php if(@$_POST['id_mobil']){echo "value= '".$nombr_."'"; }?>/></td>
	</tr>
	
	<tr>
		<td>Cantidad:</td>
		<td><input type="number" name="cantiMobil" id="cantiMobil" size= "20" maxlength="30"  <?php if(@$_POST['id_mobil']){echo "value= '".$canti_."'"; }?> /></td>
	</tr>
	
	<tr>
		<td>Confirmar Actualizacion<input type="checkbox" name="guardar" value="1" /></td>
		<td><input type="submit" value="Actualizar" /></td>
	</tr>
	
	
</table>
			</center>
		 
			 <br>
								
			<b ></b>
			
					
					<br>
						
			
						<br> </h5>
				</p>
				</form>
						
			
	
	</body>
</html>



		