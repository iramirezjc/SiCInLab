<?php 
include("../admin.php");
 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">
    <style type="text/css" media="screen">
        textarea{
            max-width: 200px;
            max-height: 100px;
            height: 100px;
            width: 200px;
            min-height: 100px;
            min-width: 200px;

        }

        label{
            display: inline-block;
            width: 150px;
        }

        input[type="text"]{
            font-size: 11px;
            height: 15px;
        }

        .nada{

            width: 350px;
            height: 140px;
            position: absolute;
            left: 260px;
            top: 45%;

        }

        .respuesta{
            width: 600px;
            height: 30px;
        }
    </style>
</head>
<body>
<center>
    <form action="datos.php" method="POST" accept-charset="utf-8">
        
        <table>
	<tr >
		<td colspan="2" style="margin: 10px 0; font-size: 30px;">Prestamo</td>
		
	</tr>
	<tr>
		<td>Usuario:</td>
		<td><input type="text"  value="<?php echo($matri_usuar);?>" disabled=""/>
		<input type="hidden" name="solicitante" value="<?php echo($matri_usuar);?>" />
		</td>
	</tr>
		<tr>
		<td>Matricula del prestador:</td>
		<td><input type="text" name="matricula" required="true"></td>
	</tr>
		<tr>
		<td>Fecha de entrega:</td>
		<td><input type="date" name="entrega" required="true"></td>
	</tr>
		<tr>
		<td>Fecha de devolución:</td>
		<td><input type="date" name="devolucion" required="true"></td>
	</tr>
		<tr>
		<td><input type="submit" name="aceptar" value="Aceptar"></td>
		<td><a href="../admin.php"><input type="button" id="eliminar" name="cancelar" value="Cancelar"></a></td>
	</tr>
	
</table>
       <br>
    </form>
    	<a href="/SiClnLab/Main_app/Admin/Consumible/prestamo_consumible.php"><input type="button" id="modificaciones" value="Prestamos consumibles"/></a>
    </center>
</body>
</html>