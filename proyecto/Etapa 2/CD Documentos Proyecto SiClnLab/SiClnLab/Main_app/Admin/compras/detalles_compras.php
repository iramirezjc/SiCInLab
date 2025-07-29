<?php
include("../admin.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"><title></title>
	</head>
	<body>
		<?php echo "Compra número: ".$_SESSION["compraNo"]."<br>"; ?>
		<form name="form1" action="detalles_compras.php" method="post">
			<?php /*-------------------------------------------------------------------------------------------------------------*/ ?>
			<select name="categoria" id="categoria" onChange="document.form1.action='detalles_compras.php'; document.form1.submit();">
			<option  value="0">Categoria</option>
			  <?php echo @$_POST['categoria'];
			  include("conexion.php");
				$sql="select * FROM categ";
				$resultado= $mysqli->query($sql);
			  	while($registros=$resultado-> fetch_assoc()){
			  	$sel="";
			  	if(@$_POST['categoria']==$registros['id_categ']){ $sel=" selected ";
				}else{ $sel="";
				}
			  	echo(" <option value='".$registros['id_categ']."' ".$sel." >".$registros['nombr']."</option>");
			  }
			  ?>
			</select>
			<?php /*-------------------------------------------------------------------------------------------------------------*/ ?>
			<select name="objeto" id="objeto">
					  <option selected value="0">Objeto</option>
					<?php 
					echo $_POST['categoria'];
					if(@$_POST['categoria']==1){//Para equipos
						$sql="select id_equip,nombr_equip from equip";
						$resultado=$mysqli->query($sql);
						while($registros=$resultado->fetch_assoc()){
							echo("<option value='".$registros['id_equip']."'>".$registros['nombr_equip']."</option>");}
					} else if(@$_POST['categoria']==2){// materiales 
						$sql="select id_mater,nombr from mater";
						$resultado=$mysqli->query($sql);
						while($registros=$resultado->fetch_assoc()){
							echo("<option value='".$registros['id_mater']."'>".$registros['nombr']."</option>");}
					} else if(@$_POST['categoria']==3){// mobiliarios
						$sql="select id_mobil,nombr from mobil";
						$resultado=$mysqli->query($sql);
						while($registros=$resultado->fetch_assoc()){
							echo("<option value='".$registros['id_mobil']."'>".$registros['nombr']."</option>");}
					} else if(@$_POST['categoria']==4){// reactivos
						$sql="select id_react,nombr from react";
						$resultado=$mysqli->query($sql);
						while($registros=$resultado->fetch_assoc()){
							echo("<option value='".$registros['id_react']."'>".$registros['nombr']."</option>");}
					}
					?>
				</select>
				
				<?php /*----------------------------------------------------------------------------------------------------------------------------*/ ?>
				<input type="hidden" id="fk_compr" name="fk_compr"
				<?php 
				$sql2="SELECT MAX(id_compr) as id_compr FROM compr";
				$id_compr_res=$mysqli->query($sql2);
				$id_compr=$id_compr_res->fetch_assoc();
				echo(" value='".$id_compr['id_compr']."'")
				?>
				 />
				Cantidad: <input type="text"size="4" name="cantidad" id="cantidad" />
				<?php /*----------------------------------------------------------------------------------------------------------------------------*/ ?>
				<input type="submit" id="modificaciones" value="+"/>
				</form>
				<br>
				<b><label> COMPRAS NUEVAS </label></b>
				<table>
	<tr>
		<td><input type="button" value="Nuevo Mobiliario" onclick = "location='AltaMobiliario.php'"/></td>
		<td><input type="button" value="Nuevo Reactivo" onclick = "location='AltaReactivos.php'"/></td>
		<td><input type="button" value="Nuevo Material" onclick = "location='AltaMateriales.php'"/></td>
		<td><input type="button" value="Nuevo Equipo" onclick = "location='altaequipos.php'"/></td>
	</tr>
</table>
				<BR>
	
				
				<?php /*---------- select de la tabla detalle_compr  -------------------------------------------------------------------------------------------------------*/ 
				//"select * from detalle_compr where fk_compra= ".$_session['compra'].";";
				if(@$_POST['categoria']&&@$_POST['objeto']&&@$_POST['fk_compr']&&@$_POST['cantidad']){
					$insert="insert into detall_compr (id_detall_compr, cant,fk_compr,fk_categ,fk_objeto_id) values (NULL,".$_POST['cantidad'].
					",".$_POST['fk_compr'].",".$_POST['categoria'].",".$_POST['objeto'].")";
					$registrar=$mysqli->query($insert);
					
				}
				 /*---------- select de la tabla equip campo cantidad  -------------------------------------------------------------------------------------------------------*/ 
				if(@$_POST['categoria']==1){
					
					$sql2="UPDATE equip SET canti_equip = canti_equip+".$_POST['cantidad']." WHERE id_equip = ".$_POST['objeto'];
	
	$resultado = $mysqli->query($sql2);
	 
	 
		if($resultado){
		
	
	}else{
	
		}
				}else if(@$_POST['categoria']==2){
					
					$sql2="UPDATE mater SET canti = canti+".$_POST['cantidad']." WHERE id_mater = ".$_POST['objeto'];
	
	$resultado = $mysqli->query($sql2);
	
	
	if($resultado){
		
		 
	}else{
			 
		}
				}else if(@$_POST['categoria']==3){
					
					$sql2="UPDATE mobil SET canti = canti+".$_POST['cantidad']." WHERE id_mobil = ".$_POST['objeto'];
	$resultado = $mysqli->query($sql2);
	
	
	if($resultado){
		
		 
	}else{
			 
		}
				}
				else if(@$_POST['categoria']==4){
					
							$sql2="UPDATE react SET cant = cant+".$_POST['cantidad']." WHERE id_react = ".$_POST['objeto'];
	$resultado = $mysqli->query($sql2);
	
	
	if($resultado){
		
		 
	}else{
			 
		}
				}
				$sql3="select * from detall_compr";
				$datos=$mysqli->query($sql3);
				
				?>
<br>
<table border="1" id="tablas">
	<tr>
		<th>Categoria</th>
		<th>Objeto</th>
		<th>Cantidad</th>
	</tr>
	<?php
	
	while($reg_=$datos->fetch_assoc()){
		echo("<tr>");
		echo("<td>");
		$sq1="select nombr from categ where id_categ=".$reg_['fk_categ'];
				$dat1=$mysqli->query($sq1);
				$reg_1=$dat1->fetch_assoc();
				echo($reg_1['nombr']);
		echo("</td>");
		
		echo("<td>");
		switch($reg_['fk_categ']){
			case 1:
			$sq2="select nombr_equip from equip where id_equip=".$reg_['fk_objeto_id'];
				$dat2=$mysqli->query($sq2);
				$reg_2=$dat2->fetch_assoc();
				echo($reg_2['nombr_equip']);
				break;
			case 2:
			$sq2="select nombr from mater where id_mater=".$reg_['fk_objeto_id'];
				$dat2=$mysqli->query($sq2);
				$reg_2=$dat2->fetch_assoc();
				echo($reg_2['nombr']);
				break;
			case 3:
			$sq2="select nombr from mobil where id_mobil=".$reg_['fk_objeto_id'];
				$dat2=$mysqli->query($sq2);
				$reg_2=$dat2->fetch_assoc();
				echo($reg_2['nombr']);
				break;
				case 4:
			$sq2="select nombr from react where id_react=".$reg_['fk_objeto_id'];
				$dat2=$mysqli->query($sq2);
				$reg_2=$dat2->fetch_assoc();
				echo($reg_2['nombr']);
				break;
			
			default:
				break;
		}
		
		echo("</td>");
		
		echo("<td>");
		echo($reg_['cant']);
		echo("</td>");
		
			echo("</tr>");
	}
	
	

	?>
</table>
							
				
	</body>
</html>