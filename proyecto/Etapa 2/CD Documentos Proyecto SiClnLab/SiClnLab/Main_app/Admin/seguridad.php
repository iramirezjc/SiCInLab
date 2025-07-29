<?php
// if (strcmp ($cadena1 , $cadena2 ) !== 0)
include("admin.php");
include("conexion.php");
	
if(@$_POST['matri_usuar_del']){
$matricula=$_POST['matri_usuar_del'];
$sql="select id_matri,nombr,apell,contr from usuar where id_matri=".$matricula."";
$resultado=$mysqli->query($sql);
$registro= $resultado->fetch_assoc();

}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<script language="javascript"> 
function funcion_usaurio_eliminado(){ 
   alert ("Usuario eliminado"); 
} 

function funcion_error_contraseña(){ 
   alert ("Contraseña incorrecta"); 
} 

function salir(){ 
  location.href ="consulta_usuario.php";
} 
</script> 
		<title></title>
	</head>
	<body>
	
	<?php
	include("conexion.php");

if(@$_POST['contrasena_confirmar']){
$matricula=$_POST['matri_usuar_del_comp'];
$sql="select id_matri,nombr,apell,contr from usuar where id_matri=".$matricula."";
$resultado=$mysqli->query($sql);
$registro= $resultado->fetch_assoc();

if (strcmp ($registro['contr'] , $_POST['contrasena_confirmar'] ) == 0){
$sql="delete from usuar where id_matri=".$matricula."";
$resultado=$mysqli->query($sql);
?>
<script language="javascript"> 

funcion_usaurio_eliminado(); 
location.href ="consulta_usuario.php";

</script>
<?php
}else{
	?>
<script language="javascript"> 
funcion_error_contraseña(); 
</script>
<?php
 
}

}
	?>

	<form method="post" action="seguridad.php"  >
		<fieldset>
			<legend>Seguridad</legend>
			<div style="text-align: center;" >
			
			<?php
			echo "¿Está seguro que desea eliminar a ".$registro['nombr']." ".$registro['apell']."?<br>";
?>
			<label >Para llevar a cabo la baja de usuario, es necesario</label><br>
			<label>ingresar su contraseña.</label> <br>
			<p>Contraseña: <input type="password" size="20" id="contrasena_confirmar" name="contrasena_confirmar" /></p>
			<input type="hidden"  id="matri_usuar_del_comp" name="matri_usuar_del_comp" value= 
			<?php
			echo $registro['id_matri']; 
			?>
			
			/>
			<input type="submit" value="Aceptar"/>
			<input type="button" id="eliminar" onclick="salir()" value="Cancelar"/>
			</div>
		</fieldset>
	</form>	
	</body>
</html>