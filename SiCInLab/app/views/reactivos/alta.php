<?php

use Core\Enlace;
ob_start() 
?>

<div class="reactivos-alta">
    <div class="container">
        <form method="POST" action="<?= Enlace::url('reactivos/alta'); ?>">
            <div class="mb-3">
                <label for="nombr" class="form-label">Nombre del reactivo</label>
                <input type="text" class="form-control" name="nombr" id="nombr" placeholder="Ingrese el nombre del material" required>
            </div>
            <div class="mb-3">
                <label for="canti" class="form-label">Cantidad de reactivo</label>
                <input type="number" class="form-control" name="canti" id="canti" required/>
            </div>
            <div class="mb-3">
                <label for="fk_unids" class="form-label">Unidad de medida</label>
                <select class="form-select" name="fk_unids" id="fk_unids" aria-label="Default select example" required>
                    <option selected>Seleccione una opcion</option>
                    <?php foreach ($unidades as $unidad):?>
                        <option value="<?= $unidad['id_unids']?>"><?= $unidad['nombr']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="formu" class="form-label">Formula Quimica</label>
                <input type="text" class="form-control" name="formu" id="formu" placeholder="Ingrese la Formula Quimica" required>
            </div>
            <div class="mb-3">
                <label for="salud" class="form-label">Riesgo a la Salud</label>
                <input type="text" class="form-control" name="salud" id="salud" required>
            </div>
            <div class="mb-3">
                <label for="infla" class="form-label">Riesgo de Inflamabilidad</label>
                <input type="text" class="form-control" name="infla" id="infla" required>
            </div>
            <div class="mb-3">
                <label for="inest" class="form-label">Nivel de Inestabilidad</label>
                <input type="text" class="form-control" name="inest" id="inest" required>
            </div>
            <div class="mb-3">
                <label for="espec" class="form-label">Riesgo Especifico</label>
                <input type="text" class="form-control" name="espec" id="espec" required>
            </div>
            <br>
            <div class="mb-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary" style="display: inline-block;">Guardar</button>
                <a href="<?= Enlace::url('reactivos/index'); ?>" class="btn btn-secondary" style="display: inline-block;">Volver</a>
            </div>
        </form>
    </div>
</div>

<?php

$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Registrar nuevo Reactivo';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>