<?php

use Core\Enlace;
ob_start() 
?>

<div class="materiales-alta">
    <div class="container">
        <div class="contenedorForma">
			<div class="container-titulo">
				<h5>Editar Material</h5>
            </div>
            <div class="row">
                <form method="POST" action="<?= Enlace::url('materiales/editar/' . $material['id_mater']); ?>">
                    <div class="mb-3">
                        <input type="hidden" name="id_mater" id="id_mater"  
                        value="<?= isset($material['id_mater']) ? $material['id_mater'] : ''; ?>"/>
                    </div>
                    <div class="mb-3">
                        <label for="nombr" class="form-label">Nombre del material</label>
                        <input type="text" class="form-control" name="nombr" id="nombr" required
                                value="<?= isset($material['mat_nombr'])? $material['mat_nombr'] : ''; ?>"/>
                    </div>
                    <div class="mb-3">
                        <label for="canti" class="form-label">Cantidad de piezas</label>
                        <input type="number" class="form-control" name="canti" id="canti" required
                                value="<?= isset($material['canti'])? $material['canti'] : ''; ?>"/>
                    </div>
                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca del material</label>
                        <input type="text" class="form-control" name="marca" id="marca" required
                                value="<?= isset($material['marca'])? $material['marca'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="capac" class="form-label">Capacidad</label>
                        <input type="number" class="form-control" name="capac" id="capac" required
                                value="<?= isset($material['capac'])? $material['capac'] : ''; ?>"/>
                    </div>
                    <div class="mb-3">
                        <label for="fk_unids" class="form-label">Unidad de medida</label>
                        <select class="form-select" name="fk_unids" id="fk_unids" aria-label="Default select example">
                            <?php foreach ($unidades as $unidad):?>
                                <option value="<?= $unidad['id_unids'] ?>"
                                    <?= (isset($material['fk_unids']) && $material['fk_unids'] == $unidad['id_unids']) ? 'selected' : '' ?>>
                                    <?= $unidad['nombr'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br>
                    <div class="text-end">
                        <a href="<?= Enlace::url('materiales/index'); ?>" class="btn btn-secondary" style="display: inline-block;">Volver</a>
                        <button type="submit" class="btn btn-primary" style="display: inline-block;">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Modificar un material';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>