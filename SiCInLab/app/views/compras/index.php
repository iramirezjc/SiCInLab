<?php
use Core\Enlace;
ob_start(); 
?>
<div class="compras-index">
    <div class="container">
	    <form method="POST" action="<?= Enlace::url('compras/guardar') ?>" >
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de la Compra:</label>
                <input type="text" class="form-control" id="fecha" name="fecha" value="<?php echo date("Y/m/d"); ?>" readonly/>
            </div>
            <div class="mb-3">
                <label for="matricula" class="form-label">Matricula de Usuario:</label>
	    	    <input type="text" class="form-control" id="matricula" name="matricula"  value="5601" readonly>
            </div>
            <div class="mb-3">
                <label for="vendedor" class="form-label">Vendedor:</label>
	    	    <input type="text" class="form-control"id="vendedor" name="vendedor" placeholder="Empresa a quien se adquirió el producto." required>
            </div>
            <div class="mb-3">
                <label for="monto" class="form-label">Monto:</label>
	    	    <input type="text" class="form-control" id="monto" name="monto" required>
            </div>
            <div class="mb-3" style="text-align: end;">
                <a href="" class="btn btn-secondary" style="display: inline-block;">Volver</a>
	    	    <button class="btn btn-warning" style="display: inline-block;" type="reset">Borrar Campos</button>
                <button type="submit" class="btn btn-primary" style="display: inline-block;">Registrar Compra</button>
            </div>
	    </form>
    </div>
</div>

<?php

$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Compras';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>