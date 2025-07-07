<?php

use Core\Enlace;
ob_start() 
?>
<div class="equipos-alta">
    <div class="container">
        <div class="contenedorForma">
			<div class="container-titulo">
				<h5>Registrar Equipo</h5>
			</div>
            <div class="row">
                <form method="POST" action="<?= Enlace::url('equipos/alta'); ?>">
                    <div class="mb-3">
                        <label for="nombr_quip" class="form-label">Nombre del equipo</label>
                        <input type="text" class="form-control" name="nombr_equip" id="nombr_equip" placeholder="Ingrese el nombre del equipo" required>
                    </div>
                    <div class="mb-3">
                        <label for="canti_equip" class="form-label">Cantidad de piezas</label>
                        <input type="number" class="form-control" name="canti_equip" id="canti_equip" required/>
                    </div>
                    <div class="mb-3">
                        <label for="descr" class="form-label">Descripcion del equipo</label>
                        <textarea class="form-control" name="descr" id="descr" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de Equipo</label>
                        <input type="text" class="form-control" name="tipo" id="tipo" placeholder="Ingrese el tipo de equipo" required>
                    </div>
                    <br>
                    <div class="text-end">
                        <a href="<?= Enlace::url('equipos/index'); ?>" class="btn btn-secondary" style="display: inline-block;">Volver</a>
                        <button type="submit" class="btn btn-primary" style="display: inline-block;">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Registrar nuevo equipo';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>