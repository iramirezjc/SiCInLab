<?php
ob_start(); 
?>

<div class="devoluciones-index">
    <br>
	<div class="buscador">
		<form method="GET" action="">
            <div class="input-group mb-3">
			    <input type="text" class="form-control w-50" name="matricula" id="matricula" placeholder="Ingrese la matricula del estudiante o profesor" autocomplete="off">
			    <button type="submit" class="btn btn-outline-primary" id="buscar">consultar</button>
            </div>
		</form>
  </div>
	<div class="container">
        <form id="devoluciones">
            <table class="tabla-general">
                <thead>
                    <tr>
			            <th>Categoría</th>
			            <th>Objeto</th>
                        <th>Prestado</th>
                        <th>Devuelto</th>
                        <th>A Devolver</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="filas">
                </tbody>
		        </table>
            <br>
            <div class="text-end">
                <button class="btn btn-success" type="submit" id="registrar">Registrar Devolucion</button>
            </div>
        </form>
	</div>
</div>

<!-- Modal de Observación -->
<div class="modal fade" id="observacion" tabindex="-1" aria-labelledby="observacionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formObservacion">
        <div class="modal-header">
          <h5 class="modal-title" id="observacionLabel">Registrar Observación de Devolución</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="observacionGeneral" class="form-label">Observación</label>
            <textarea class="form-control" id="observacionGeneral" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="fechaDevolucion" class="form-label">Fecha de devolución</label>
            <input type="date" id="fechaDevolucion" class="form-control" value="<?= date('Y-m-d') ?>" required>
          </div>
        </div>
        <div class="modal-footer">
          <button id="confirmar" type="submit" class="btn btn-primary">Confirmar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="<?= BASE_JS .'devoluciones.js'?>"></script>
<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Devoluciones';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>