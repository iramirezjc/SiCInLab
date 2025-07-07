<?php

use Core\Enlace;
ob_start() 
?>

<div class="materiales-alta">
    <div class="container">
        <div class="contenedorForma">
			<div class="container-titulo">
				<h5>Registrar Material</h5>
            </div>
            <div class="row">
                <form method="POST" action="<?= Enlace::url('materiales/alta'); ?>">
                    <div class="mb-3">
                        <label for="nombr" class="form-label">Nombre del material</label>
                        <input type="text" class="form-control" name="nombr" id="nombr" placeholder="Ingrese el nombre del material" required>
                    </div>
                    <div class="mb-3">
                        <label for="canti" class="form-label">Cantidad de piezas</label>
                        <input type="number" class="form-control" name="canti" id="canti" required/>
                    </div>
                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca del material</label>
                        <input type="text" class="form-control" name="marca" id="marca" placeholder="Ingrese la marca del material" required>
                    </div>
                    <div class="mb-3">
                        <label for="capac" class="form-label">Capacidad</label>
                        <input type="number" class="form-control" name="capac" id="capac" required/>
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
$titulo = 'Registrar nuevo material';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>