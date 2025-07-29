<?php
include("admin.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title></title>
	</head>
	<body>
		<center>
<table > 
		<tr><td><b>Eliminar material</b>
		
		<hr> <!-- ---------------------------------------------->
		
		<form method="post" action="eliminarmater.php">
			ID del material a borrar:
			<input type="text" size="26" name="id_material" id="id_material" value="  <?php
			if(@$_POST['id_mat']){			
			echo($_POST['id_mat']);
			}
		?>" /><br><br>
			
			<div align="center">
			<input type="checkbox" name="confirmar" value="1"/> Confirmar borrado
			<input type="submit" id="eliminar" value="Borrar"/>
			</div>
			
		</form>
		</td></tr>
		</table>
		</center>
		
	</body>
</html>




