<?php
use Core\Enlace;
ob_start() 
?>
<div class="incidencias-index">
    <div class="container">
        <form method="POST" action="<?= Enlace::url('incidencias/index') ?>" >
            <div class="mb-3">
                <label for="fecha" class="form-laber"> Fecha de incidencias:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <textarea class="form-control" rows="3" id="descripcion" name="descripcion" autocomplete="off" required></textarea>
            </div>
            <div class="mb-3">
                <label for="matricula" class="form-label">Matricula:</label>
                <input type="text" class="form-control" id="matricula" name="matricula" value="5681" readonly>
            </div>
            <div class="botones" style="text-align: end;">
                <a href="" class="btn btn-warning" id="cancelar" name="cancelar">Cancelar</a>
                <button  type="submit" id="guardar" name="guardar" class="btn btn-primary">Guardar</button>
            </div>
        </form> 
    </div>
</div>
<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Incidencias';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>