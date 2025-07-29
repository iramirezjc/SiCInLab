<?php
include("admin.php");
include("conexion.php");
$sql= "SELECT * FROM usuar inner join nivel_usuar on fk_nivel_usuar=id_nivel_usuar";
$sql2= "SELECT * FROM usuar inner join nivel_usuar on fk_nivel_usuar=id_nivel_usuar";

if(@$_POST['txtfld_buscar_usuario']){
	//sentencia 'LIKE' utilizada para el filtro de los registros, aplicada solamente en nombre y apellidos
					$sql .= " WHERE nombr LIKE '%".$_POST['txtfld_buscar_usuario']."%' OR apell LIKE '%".$_POST['txtfld_buscar_usuario']."%';";
				
				}
	//en el caso de que se realice una consulta especifica esta condicion la recibe y ejecuta
if(@$_POST['matri_usuar_consu']){
					$sql .= " WHERE id_matri=".$_POST['matri_usuar_consu'];
					$sql2 .= " WHERE id_matri=".$_POST['matri_usuar_consu'];
				
				}	
				
 

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		    <link rel="stylesheet" href="/SiClnLab/Main_app/estilo.css" />
		<title></title>
	</head>
	<body>
	<center>
		 <form method="post" action="consulta_usuario.php">
		 <fieldset >
		 <legend>Consulta de usuarios</legend>
		 
		 <table>
	<tr>
		<td><input placeholder="Buscar usuario" type="text" id="txtfld_buscar_usuario" name="txtfld_buscar_usuario" size="35" /></td>
		<td><input type="submit" value="Buscar"/></td>
		<td><a href="usuarios.php"><input id="modificaciones" type="button" value="Nuevo"/></a></td>
	</tr>
</table>
		 
		 
		 
		 

		 <br/>
		</fieldset>
		 </form>
		 </center>
		 <form method="post" action="consulta_usuario.php">
	 <center><fieldset >
		  <legend>Resultados de búsqueda</legend>
		 <table id="tablas" border="1" >
  <tbody>
    <tr>
    <th></th>
      <th  id="claves">Matrícula</th>
      <th>Nombre(s)</th>
       <th>Apellido(s)</th>
	   <th>Nivel de Usuario</th>

	
    </tr>
    
    <?php
    
   $resultado=$mysqli->query($sql);
    $filas= $resultado->num_rows;
	if($filas==0){
		echo "Sin resultados";
	}
		
$contador=0;	
//bucle que dibuja la tabla de los usuarios
while($registro= $resultado->fetch_assoc()){
	echo("			
	<tr>
      <td><input type='radio' name='matri_usuar_consu' value=".$registro['id_matri']." id='".$contador."' required></td>
	  <th id='claves'><label for='".$contador."'>".$registro['id_matri']."</label></th>
      <td><label for='".$contador."'>".$registro['nombr']."</label></td>
      <td><label for='".$contador."'>".$registro['apell']."</label></td>
	   <td><label for='".$contador."'>".$registro['nombr_nivel']."</label></td>	   

    </tr>
	");
	$contador++;	
				}
	
    ?>
    

 
  </tbody>
</table><br>

		 <input type="submit"  id="modificaciones" value="Ver detalle"/>
		</fieldset> </center>
		 </form>
		 <?php if(@$_POST['matri_usuar_consu']){
		 	
}else{
	echo("<!-- ");
}
		 	 ?>
		<?php
		$resultado=$mysqli->query($sql2);
		$registro= $resultado->fetch_assoc();
		?>
			
		 	<br />
		 	<fieldset >
		 		<legend>Detalles</legend>
		 		<p>Nombre: <?php if(@$_POST['matri_usuar_consu']){echo $registro['nombr'];}?></p>
		 		<p>Apellido: <?php if(@$_POST['matri_usuar_consu']){echo $registro['apell'];}?></p>
		 		<p>Matrícula: <?php if(@$_POST['matri_usuar_consu']){echo $registro['id_matri'];}?></p>
		 		<p>Nivel: <?php if(@$_POST['matri_usuar_consu']){echo $registro['nombr_nivel'];}?></p>
		 		<p>Número de teléfono: <?php if(@$_POST['matri_usuar_consu']){echo $registro['num_tel'];}?></p>
		 		<table>
	<tr>
		<td><form action='modificacion_usuario.php' method='post'>
	<input type='hidden' <?php if(@$_POST['matri_usuar_consu']){echo("value='".$registro['id_matri']."' ");} ?> id="modificar_usuario" name="modificar_usuario" />
	<input type='submit' id="modificaciones" value='Modificar' <?php if(@$_POST['matri_usuar_consu']){}else{echo("disabled");}?>   />
</form></td>


		<td>   <form action='baja_de_usuario.php' method='post'>
	<input type='hidden' <?php if(@$_POST['matri_usuar_consu']){echo("value='".$registro['nombr']."' ");} ?> id="txt_nombre_usuario_baja" name='txt_nombre_usuario_baja' />
	<input type='submit' id="eliminar" value='Eliminar' <?php if(@$_POST['matri_usuar_consu']){}else{echo("disabled");}?>/> </form></td>
	</tr>
</table>

	
</form>
	 
				
		 	</fieldset>
		 	<fieldset >
		 		<legend>Mostrar</legend>
		 		<img src="../../img/ERR.PNG" style="width: 100%"/>
		 		<input type="button" id="mostrar_prestamos" name="mostrar_prestamos" value="Prestamos" disabled />
		 		<input type="button" id="acceso_laboratorio" name="acceso_laboratorio" value="Acceso al laboratorio" disabled/>
		 	</fieldset>
		 <?php
		 if(@$_POST['matri_usuar_consu']){
		 	
}else{
	echo(" -->");
}
		 ?>
		 	
		
	</body>
</html>