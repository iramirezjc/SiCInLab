<?php
include("../usuario.php");
?>
<center>
		 <b>Registrar nuevo equipo</b>
		
		
		
		<form method="post" action="insertequipos.php">
		<table>
	<tr>
		<td>Nombre</td>
		<td><input type="text" name="nombre" id="nombre"   required=""/></td>
	</tr>
	<tr>
		<td>Cantidad</td>
		<td><input type="number" name="cantidad" id="cantidad"   required/></td>
	</tr>
	<tr>
		<td>Descripcion</td>
		<td><textarea name="descripcion" id="descripcion"  rows="2" required></textarea></td>
	</tr>
	<tr>
		<td>Tipo</td>
		<td><input type="text" name="tipo" id="tipo"   required/></td>
	</tr>
	<tr>
		<td>
			<a href="detalles_compras.php"><input type="submit" value="Guardar"/></a></td>
		<td> 
			 <a href="detalles_compras.php"><input  id="eliminar" type="button" value="Cancelar"/> </a></td>
	</tr>
			
			
</table>
	
			</form>
			</center>