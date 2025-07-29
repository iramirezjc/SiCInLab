<?php
include("../usuario.php");

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
	<center> 
	<h2>Prestamo de reactivos "Consumible"</h2>

	<form action="login.php" method="post">
		<table border="0">
	<tr>
		<th>Mi usuario:</th>
		<td><?php echo($nombr_usuar);?></td>
	</tr>
	<tr>
		<th>Solicitante</th>
		<td><input type="text" id="matri_solic" placeholder="Matricula" name="matri_solic" pattern="[0-9]*" required=""/></td>
	</tr>
	<tr >
	<td colspan="2">	<center><input type="submit" id="modificaciones" value="Solicitar"/></center></td>
	</tr>
	
</table>
<input type="hidden" id="usuar_matri" name="usuar_matri" value="<?php echo($matri_usuar); ?>"/>
	</form>
	</center>
	</body>
</html>