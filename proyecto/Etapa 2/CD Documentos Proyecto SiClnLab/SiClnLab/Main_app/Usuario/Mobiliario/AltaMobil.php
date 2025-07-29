<?php
include("../usuario.php");
?>
		<center>
		<table border="0">
		<tr><td> <b>Agregar objeto</b>
		<hr> <!-- -------------------- ----------------------->
		<form method="post" action="insertmob.php">
		
		<div align="right">
			Tipo:
			<input type="text" name="tipo" id="tipo" required/>
			<br><br>
			Material:
			<input type="text" name="material" id="material" required/>
			<br><br>
			Nombre:
			<input type="text" name="nombre" id="nombre"required/>
			<br><br>
			Cantidad:
			<input type="text" name="cantidad" id="cantidad" required/>
			<br><br>
			
			
			<input type="submit" value=" Guardar "/>
		</form>
		<br><br>

			<form method="post" action="Mobiliario.php">
			</form>
			</div>
			<div align="right">
			<a href="consultaMobiliario.php"><input type="button" id="eliminar" value="Regresar" /></a>
		</div>
		</center>
		
		
		