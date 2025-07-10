<?php
use Core\Enlace;
ob_start();
?>
<div class="servicio-sala-reservacion">
	<div class="container">
		<form id="formaGenerica" method="POST"  action="<?= Enlace::url('servicio-sala/reservaciones'); ?>">
			<div class="row">
				<div class="col-3">
					<div class="contenedorForma">
						<div class="container-titulo">
							<h5>Reservación</h5>
						</div>
						<div class="mb-3">
							<label>Autoriza:</label>
							<input type="text" class="form-control" id="usuario" name="usuario" value="5681" readonly/><!--Usuario de sesion-->
						</div>
						<div class="mb-3">
							<label for="solicita" class="form-label">Solicita:</label>
							<input type="text" class="form-control" id="solicita" name="solicita" autocomplete="off" required/>
						</div>
						<div class="mb-3">
							<label for="fecha" class="form-label">Elegir Fecha:</label>
							<input type="text" class="form-control" id="fecha" name="fecha" required autocomplete="off" />
						</div>
						<div class="mb-3">
							<label for="horaEntrada" class="form-label">Horario Entrada:</label>
							<select id="horaEntrada" name="horaEntrada" class="selectpicker form-control" data-size="5" autocomplete="off">
								<option selected disabled>Selecciona una Hora</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="horaSalida" class="form-label">Horario Salida:</label>
							<input type="text" id="horaSalida" name="horaSalida" class="form-control" autocomplete="off">
						</div>
            			<div class="mb-3">
            			    <label for="asunto" class="form-label">Motivo de reservación</label>
							<textarea class="form-control" name="asunto" id="asunto" rows="3" required></textarea>
            			</div>
						<div class="mb-3" style="text-align: center;">
            			    <button id="reservar" type="submit" class="btn btn-primary" style="width: 100%;">Reservar</button>
            			</div>
					</div>
				</div>
				<div class="col-9">
					<div id="calendario"></div>
				</div>
			</div>
		</form>
	</div>
</div>
<script src="<?= BASE_JS .'reservacion.js'?>"></script>
<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Reservacion';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>