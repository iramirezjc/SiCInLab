<?php
include("../usuario.php");
?>

<center>
		 <b>Registrar nuevo equipo</b>
		<hr/> <!-- ------------------------------------------->
		<form method="post" action="InsertEquipo.php">
<table>

	<tr>	
	
		<td>Nombre</td>
		<td><input type="text" name="nombre" id="nombre"  /></td>
	</tr>
	<tr>
		<td>Cantidad</td>
		<td><input type="number" name="cantidad" id="cantidad"  /></td>
	</tr>
	<tr>
		<td>Descripcion</td>
		<td><textarea name="descripcion" id="descripcion"   rows="2"></textarea></td>
	</tr>
	<tr>
		<td>Tipo</td>
		<td><input type="text" name="tipo" id="tipo" /></td>
	</tr>
		
	
</table>
<input type="submit"  value="Guardar"/>
</form>

 
				<div align="center">
				<form method="post" action="MostrarEquipo.php">
                <input type="submit" id="eliminar" value="Cancelar"/>
			    </form>
				</div>

		</center>