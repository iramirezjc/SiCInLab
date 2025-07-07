<?php

use Core\Enlace;
ob_start() 
?>

<div class="mobiliario-alta">
    <div class="container">
        <div class="contenedorForma">
			<div class="container-titulo">
				<h5>Editar Mobiliario</h5>
            </div>
            <div class="row">
                <form method="POST" action="<?= Enlace::url('mobiliarios/editar/'. $mobiliario['id_mobil']); ?>">
                    <div class="mb-3">
                        <input type="hidden" name="id_mobil" id="id_mobil"   
                        value="<?= isset($mobiliario['id_mobil']) ? $mobiliario['id_mobil'] : ''; ?>"/>
                    </div>
                    <div class="mb-3">
                        <label for="nombr" class="form-label">Nombre del mobiliario</label>
                        <input type="text" class="form-control" name="nombr" id="nombr" required
                        value="<?= isset($mobiliario['nombr']) ? $mobiliario['nombr'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de mobiliario</label>
                        <input type="text" class="form-control" name="tipo" id="tipo" required
                        value="<?= isset($mobiliario['tipo']) ? $mobiliario['tipo'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="mater" class="form-label">Material del mobiliario</label>
                        <input type="text" class="form-control" name="mater" id="mater" required
                        value="<?= isset($mobiliario['mater']) ? $mobiliario['mater'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="canti" class="form-label">Cantidad de piezas</label>
                        <input type="number" class="form-control" name="canti" id="canti" required
                        value="<?= isset($mobiliario['canti']) ? $mobiliario['canti'] : ''; ?>"/>
                    </div>
                    <div class="text-end">
                        <a href="<?= Enlace::url('mobiliarios/index'); ?>" class="btn btn-secondary" style="display: inline-block;">Volver</a>
                        <button type="submit" class="btn btn-primary" style="display: inline-block;">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Modificar mobiliario';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>