<?php
include("admin.php")
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv= "Content-Type" 
	content="charset= UTF-8" />

	<!--Esta parte refresca la pantalla cada 1 segundo me permite observar como se va actulizando mi diseño                           <META HTTP-EQUIV="Refresh" CONTENT="1;">       -->
	 
</head>
<body>
	
	<br>
	<h1 align="center">Registro de usuarios </h1>
	<br>
<!-- 	esta funcion es para la edicion de todos los textos o label -->
	<form  action="ConectoDataBase.php" method="POST"   style="margin-left: 37%; font-family:Arial; font-size: 15pt;">
		
		Nombre(s)
		<input type="text" name="nomUser" 
		style="margin-left:0%; width:295px; height:30px; margin-bottom:10px; font-family: Arial; font-size: 13pt;" required /> 			
		<br>
		Apellidos 
		<input type="text" name="apeUser" 
			style="margin-left:0%; width:305px; height:30px; margin-bottom:10px; font-family: Arial; font-size: 13pt;" required/> 
			<br>
		Matricula
		<input type="number" name="matUser" style="margin-left: 0%; width: 305px; height: 30px; margin-bottom: 10px; font-family: Arial; font-size: 13pt" required/>
		<br>
		Numero celular
		<input type="number" name="ncelUser"  style="margin-left: 0%; width: 250px; height: 30px; margin-bottom:10px; font-family: Arial; font-size: 13pt;"required/>
		<br>
		Fecha de nacimiento
		<input type="DATE" name="fnacUser"   style="margin-left: 0%; width:200px; height:30px; margin-bottom:10px; font-family: Arial; font-size: 13pt;"required/>
		<br>
		Nivel de usuario:

		&nbsp <input type="radio" name="NivelUsar"  value="1" style="margin-left: 0%; margin-bottom: 15px; padding-bottom: 10%;"/>Encargado
		&nbsp <input type="radio" name="NivelUsar" value="2" style=" margin-bottom: 15px;"/>Servicio<br>

		Nombre de usuario
		<input type="text" name="userName" style="margin-left: 0%; width:215px; height:30px; margin-bottom:10px; font-family: Arial; font-size: 13pt;"/>
		<br>
		Contraseña
		<input type="password" name="contUser" 
		style="margin-left: 0%; width:280px; height:30px; margin-bottom:10px; font-family: Arial; font-size: 15pt;" /> 
		<br>
		Confirme contraseña
		<input type="password" name="contUser2" 
		style="margin-left: 0%; width:200px; height:30px; margin-bottom:10px; font-family: Arial; font-size: 15pt;"/> <br>
		
		

		<br>
		<input type="submit" value="Registrar"  /> 
		<input type="reset" id="eliminar" name="Cancelar" value="Borrar campos" />
		<br>	
	</form>


</body>

</html>
