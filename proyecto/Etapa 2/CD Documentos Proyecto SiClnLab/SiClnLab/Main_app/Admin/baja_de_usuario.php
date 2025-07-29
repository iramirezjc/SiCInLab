<?php
include("admin.php");

$sql= "SELECT id_matri,nombr,apell,nombr_nivel FROM usuar inner join nivel_usuar on fk_nivel_usuar=id_nivel_usuar";
if(@$_POST['txt_nombre_usuario_baja']){
					$sql .= " WHERE nombr LIKE '%".$_POST['txt_nombre_usuario_baja']."%' OR apell LIKE '%".$_POST['txt_nombre_usuario_baja']."%';";
				}		
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title></title>
	</head>
	<body>

	
		<form method="post" action="seguridad.php" >
		<fieldset>
			<legend>Baja de usuario</legend>
			
			
			
			<p>Seleccione el usuario para eliminar</p><br/>
			
			<table id="tablas" border="1">
  <tbody>
    <tr>
    <th></th>
      <th>Matrícula</th>
      <th>Nombre(s)</th>
       <th>Apellido(s)</th>
	   <th>Nivel de Usuario</th>
    </tr>
    
    <?php
    include("conexion.php");
    $resultado=$mysqli->query($sql);
    $filas= $resultado->num_rows;
	if($filas==0){
		echo "Sin resultados";
	}
		
$contador=0;	
while($registro= $resultado->fetch_assoc()){
	echo("			
	<tr>
      <td><input type='radio' name='matri_usuar_del' value=".$registro['id_matri']." id='".$contador."' required></td>
	  <td><label for='".$contador."'>".$registro['id_matri']."</label></td>
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

<input type="submit" value="Aceptar" />
			<a href="consulta_usuario.php"><input id="eliminar" type="button" value="Cancelar"/></a>
		</fieldset>	
		</form> 
	</body>
</html>