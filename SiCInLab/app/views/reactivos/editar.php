<?php
use Core\Enlace;
ob_start() 
?>
<div class="reactivos-editar">
    <div class="container">
        <div class="contenedorForma">
			<div class="container-titulo">
				<h5>Editar Reactivo</h5>
			</div>
            <div class="row">
                <form method="POST" action="<?= Enlace::url('reactivos/editar/'.$reactivo['id_react']); ?>">
                    <div class="mb-2">
                        <input type="hidden" name="id_react" id="id_react"  
                        value="<?= isset($reactivo['id_react']) ? $reactivo['id_react'] : ''; ?>"/>
                    </div>
                    <div class="mb-2">
                        <label for="nombr" class="form-label">Nombre del reactivo</label>
                        <input type="text" class="form-control" name="nombr" id="nombr" required
                        value="<?= isset($reactivo['react_nombr']) ? $reactivo['react_nombr'] : ''; ?>">
                    </div>
                    <div class="mb-2">
                        <label for="canti" class="form-label">Cantidad de reactivo</label>
                        <input type="number" class="form-control" name="canti" id="canti" required
                        value="<?= isset($reactivo['cant']) ? $reactivo['cant'] : ''; ?>"/>
                    </div>
                    <div class="mb-2">
                        <label for="fk_unids" class="form-label">Unidad de medida</label>
                        <select class="form-select" name="fk_unids" id="fk_unids" aria-label="Default select example" required>
                            <?php foreach ($unidades as $unidad):?>
                                <option value="<?= $unidad['id_unids'] ?>" 
                                    <?= (isset($reactivo['fk_unids']) && $reactivo['fk_unids'] == $unidad['id_unids']) ? 'selected' : '' ?>>
                                    <?= $unidad['nombr'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="formu" class="form-label">Formula Quimica</label>
                        <input type="text" class="form-control" name="formu" id="formu" required
                        value="<?= isset($reactivo['formu']) ? $reactivo['formu'] : ''; ?>">
                    </div>
                    <div class="mb-2">
                        <label for="salud" class="form-label">Riesgo a la Salud</label>
                        <input type="text" class="form-control" name="salud" id="salud" required
                        value="<?= isset($reactivo['pelig_salud']) ? $reactivo['pelig_salud'] : ''; ?>">
                    </div>
                    <div class="mb-2">
                        <label for="infla" class="form-label">Riesgo de Inflamabilidad</label>
                        <input type="text" class="form-control" name="infla" id="infla" required
                        value="<?= isset($reactivo['pelig_infla']) ? $reactivo['pelig_infla'] : ''; ?>">
                    </div>
                    <div class="mb-2">
                        <label for="inest" class="form-label">Nivel de Inestabilidad</label>
                        <input type="text" class="form-control" name="inest" id="inest" required
                        value="<?= isset($reactivo['pelig_ines']) ? $reactivo['pelig_ines'] : ''; ?>">
                    </div>
                    <div class="mb-2">
                        <label for="espec" class="form-label">Riesgo Especifico</label>
                        <input type="text" class="form-control" name="espec" id="espec" required
                        value="<?= isset($reactivo['pelig_esp']) ? $reactivo['pelig_esp'] : ''; ?>">
                    </div>
                    <br>
                    <div class="text-end">
                        <a href="<?= Enlace::url('reactivos/index'); ?>" class="btn btn-secondary" style="display: inline-block;">Volver</a>
                        <button type="submit" class="btn btn-primary" style="display: inline-block;">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Modificar Reactivo';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>