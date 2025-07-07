<?php

use Core\Enlace;
ob_start(); 
?>
<div class="materiales-index">
    <div class="container">
        <div class="contenedorForma">
			<div class="container-titulo">
				<h5>Materiales</h5>
			</div>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <div>
                        <form method="GET" action="<?= Enlace::url('materiales/buscador')?>">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="buscar" placeholder="Buscar por nombre del material" aria-label="Buscar por nombre del material" aria-describedby="button-addon2">
                                <button class="btn btn-outline-primary" type="submit" id="buscar">Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-3">
                    <div class="text-end">
                        <a href="<?= Enlace::url('materiales/alta') ?>" class="btn btn-success" role="button">Agregar material</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <table class="tabla-general">
	    	        <thead>
	    	            <tr>
	    	                <th>Nombre del material</th>
	    	                <th>Cantidad</th>
                            <th >Marca</th>
	    	                <th>Capacidad</th>
	    	                <th>Opciones</th>
                        </tr>
	    	        </thead>
	    	        <tbody>
                        <?php foreach($materiales as $material): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($material['mat_nombr']); ?></td>
                            <td class="text-end"><?php echo htmlspecialchars($material['canti']); ?></td>
                            <td><?php echo htmlspecialchars($material['marca']); ?></td>
                            <td class="text-end"><?php echo htmlspecialchars($material['capac'].' '.$material['unid_nombr']); ?></td>
                            <td class="col-opciones">
                                <div>
                                    <a href="<?= Enlace::url('materiales/editar/'.$material['id_mater'])?>" class="btn btn-secondary">Editar</a>
                                    <a href="<?= Enlace::url('materiales/borrar/'.$material['id_mater'])?>" 
                                    class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este equipo?');">Eliminar</a>                     
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
	    	        </tbody>			
	            </table>
            </div>
        </div>
	</div>
</div>

<?php

$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Materiales';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>
