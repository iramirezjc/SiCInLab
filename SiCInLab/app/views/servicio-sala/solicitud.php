<?php
use Core\Enlace;
ob_start();
?>
<div class="servicio-sala-solicitud">
	<div class="container">
		<form method="POST"  action="<?= Enlace::url('servicio-sala/solicitud'); ?>">
			<div class="mb-3">
				<label for="solicita" class="form-label">Solicita: 
					<input type="text" class="form-control" id="solicita" name="solicita" required />
				</label>
			</div>
			<div class="mb-3">
				<label>Autoriza: 
					<input type="text" class="form-control" id="usuario" name="usuario" value="5681" readonly/><!--Usuario de sesion-->
				</label>
			</div>
			<div class="mb-3 d-flex gap-2">
				<a href="" class="btn btn-secondary" style="display: inline-block;">Volver</a>
                <button type="submit" class="btn btn-primary" style="display: inline-block;">Siguiente</button>
            </div>
		</form>
	</div>
</div>
<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Servicio a Sala';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>