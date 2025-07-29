<?php
include("../admin.php");
$id_mob="";
if(@$_POST['id_mobil']){
	$id_mob=$_POST['id_mobil'];
	
}
?>
<center>
 
		<tr><td><b>BAJA DE MOBILIARIO</b>
		
		<hr> <!-- ---------------------------------------------->
		
		<form method="post" action="eliminarmobil.php">
			ID del mobiliario a borrar:
			<input type="text" size="26" name="id_mobiliario" id="id_mobiliario" <?php echo(" value='".$id_mob."' ");?>/><br><br>
			<div align="center">
			<input type="checkbox" name="confirmar" value="1"/> Confirmar borrado
			<input type="submit" value="Borrar"/>
			</div>
			<br>
			
		</form>
		<a href="consultaMobiliario.php"><input type="button" id="eliminar" value="Regresar" /></a>
		</td></tr>
		</center>
		