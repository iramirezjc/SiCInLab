<?php
include("../admin.php");
include("conexion.php");
//
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<style type="text/css" media="screen">
       

        label{
            display: inline-block;
            width: 150px;
        }

        input[type="text"]{
            font-size: 11px;
            height: 15px;
        }

       
    </style>
	</head>
	<body>
		<p>Iniciar Compras: </p>
		<form action="insertar_compras.php" method="post">
		   <label> Matricula de Usuario:</label>
		     <input type="text" value="<?php echo($matri_usuar);?>" disabled=""> <br><br>
		     <input type="hidden" name="usuario" value="<?php echo($matri_usuar);?>">
			<label>Vendedor</label> 
			<input type="text" name="vendedor"><br><br>
			<label>Monto</label>
			 <input type="text" name="monto"><br><br>
			<input type="hidden" id="fecha" name="fecha" value="<?php echo date("Y/m/d"); ?>"/>
			<input type="submit" value="Iniciar">
			<input type="reset" value="Borrar">
		</form>	
	</body>
</html>