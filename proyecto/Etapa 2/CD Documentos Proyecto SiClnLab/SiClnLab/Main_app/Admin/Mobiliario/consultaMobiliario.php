<?php
include("../admin.php");
?>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>SiCInLab</title>
    <link rel="stylesheet" href="/SiClnLab/Main_app/estilo.css" />
  </head>

<body>
<center>

<br><br>
<h1>SiCInLab</h1>


<table border="1" id="tablas" >
<th id='claves' >Clave</th>
<th>Nombre</th>
<th >Tipo</th>
<th >Material</th>
<th >Cantidad</th>
<th></th>
<th></th>
<br>
<form method="post" action="consultaMobiliario.php">
<center>
Ingrese el nombre.
<br><br>
Mobiliario:&nbsp;&nbsp;
<input type="text" name="BuscarMob" id="BuscarMob"/>&nbsp;&nbsp;
<input type="submit" value="Buscar"/>
 
</center>
</form>
<br><br>
	<?php
	$sql= "SELECT * FROM mobil";
	if(@$_POST['BuscarMob']){
	$sql .= " WHERE nombr LIKE '%".$_POST['BuscarMob']."%';";
	}
	include("conexion.php");				
	$resultado = $mysqli->query($sql);
	$filas= $resultado->num_rows;				
	while($registro= $resultado->fetch_assoc()){
	echo "<tr>
	<th id='claves'>".$registro['id_mobil']."</th>
	<td>".$registro['nombr']."</td>
	<td>".$registro['tipo']."</td>
	<td>".$registro['mater']."</td>
	<td>".$registro['canti']."</td>
	<td>
		<form action='modificacionMobil.php' method='post'>
		<input type='hidden' name='id_mobil' id='id_mobil' value='".$registro['id_mobil']."'/>
		<input type='submit' id='modificaciones' value='Modificar'/>
		</form>
	</td>
	<td>
		<form action='deletemobil.php' method='post'>
		<input type='hidden' name='id_mobil' id='id_mobil' value='".$registro['id_mobil']."'/>
		<input type='submit' id='eliminar' value='Eliminar'/>
		</form>
	</td>";

	}				
	?>		
</table>

</center>
</body>
</html>