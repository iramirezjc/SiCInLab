<?php
use Core\Enlace;
ob_start();
?>
<div class="servicio-sala-reservacion">
	<div class="container">
		<form method="POST"  action="<?= Enlace::url('servicio-sala/reservacion'); ?>">
			<div class="mb-3">
				<label for="fecha" class="form-label">Elegir Fecha: 
					<input type="text" class="form-control" id="fecha" name="fecha" placeholder="aaaa/mm/dd" required />
				</label>
			</div>
			<div class="mb-3">
				<label>Autoriza: 
					<input type="text" class="form-control" id="usuario" name="usuario" value="5681" readonly/><!--Usuario de sesion-->
				</label>
			</div>
            <div class="mb-3">
                <label for="asunto" class="form-label">Motivo de reservación
                    <textarea class="form-control" name="asunto" id="asunto" rows="3" required></textarea>
                </label>
            </div>
			<div class="mb-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary" style="display: inline-block;">Reservar</button>
            </div>
            <div class="calendario">
                ad
            </div>
		</form>
	</div>
</div>
<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Reservacion';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>