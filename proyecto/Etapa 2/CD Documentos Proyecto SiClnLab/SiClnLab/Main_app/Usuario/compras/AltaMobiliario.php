<?php
include("../usuario.php");
?>
		<center>
		<table border="0">
		<tr><td> <b>Agregar objeto</b>
		<hr> <!-- ------------------------------------------->
		<form method="post" action="InserteMobiliario.php">
		
		<div align="right">
			Tipo:
			<input type="text" name="tipo" id="tipo" required/>
			<br><br>
			Material:
			<input type="text" name="material" id="material" required/>
			<br><br>
			Nombre:
			<input type="text" name="nombre" id="nombre" required/>
			<br><br>
			Cantidad:
			<input type="number" name="cantidad" id="cantidad" required=""/>
			<br><br>
			
			
			<input type="submit" value=" Guardar "/>
		</form>
		<br><br>

			
			<div align="right">
			<input  type="button" onclick="location.href='detalles_compras.php'" id="eliminar" value="Regresar" />
		</div>
		</center>
		
		
		