<?php
include("../usuario.php");
	//include("index.php");
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Insertar reactivos</title>
	</head>
	<body>
	<center>
		<?php
		echo("<h1> Alta Reactivos </h1>");
		?>
		<form method="post" action="insertReact.php" >
		<table border="0">
		<tr>
			<td>Nombre</td>
			<td><input type="text" required name="nombr" id="nombre" value="" size="20" maxlength="100" />
			</td>
		</tr>
		<tr>
			<td>Cantidad</td>
			<td><input type="number" required name="canti" id="canti" value="" size="20" maxlength="11" /></td>
		</tr>
		<tr>
			<td>Unidad de medida</td>
			<td>
			<select name="unids" id="unids" required>
				<option value="">Selecione la unidad</option>
				<?php
					include'conexion.php';
					$query = 'SELECT * FROM unids';
					$result = $mysqli->query($query);
					while($row= $result->fetch_array()){?>
				<option value="<?php echo $row['id_unids']?>"><?php echo $row["nombr"]; ?></option>
				<?php } ?>
			</select>
			</td>
		</tr>
		<tr>
			<td>Formula</td>
			<td><input type="text" name="formu" id="formu" value="" size="20" maxlength="100" /></td>
		</tr>
		<tr>
			<td>Riesgo a la Salud</td>
			<td><input type="number" name="salud" id="salud" value="0" maxlength="1" max="4" min="0" /><br></td>
		</tr>
		<tr>
			<td>Inflamabilidad</td>
			<td><input type="number" name="infla" id="infla" value="0" maxlength="1" max="4" min="0" /></td>
		</tr>
		<tr>
			<td>Inestabilidad</td>
			<td><input type="number" name="inest" id="inest" value="0" maxlength="1" max="4" min="0" /></td>
		</tr>
		<tr>
			<td>Riesgo Especifico</td>
			<td><input type="text" name="espec" id="espec" value="" size="20" maxlength="10" /></td>
		</tr>
		<tr>
			<td><input type="submit" value="Guardar"/></td>
			<td><input type="reset" value="Borrar campos"/></td>
		</tr>
		</table>
		</form>
	    <br>
	    <br>
	    <a href="bajaReac.php"><input id="eliminar" type="button" value="Regresar"/></a>	
	</center>
	</body>
</html>