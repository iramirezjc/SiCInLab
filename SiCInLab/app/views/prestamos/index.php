<?php
use Core\Enlace;
ob_start();
?>
<div class="prestamos-index">
    <div class="container">
        <div class="contenedorForma">
			<div class="container-titulo">
				<h5>Registrar Prestamos</h5>
			</div>
            <div class="row">
                <form action="<?= Enlace::url('prestamos/guardar') ?>" method="POST" accept-charset="utf-8">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
        	            <input type="text" class="form-control" id="usuario" name="usuario"  value="5601" readonly/><!--Usuario se sesion-->
                    </div>
                    <div class="mb-3">
                        <label for="solicita" class="form-label">Matricula del prestador:</label>
        	            <input type="text" class="form-control" id="solicita" name="solicita" autocomplete="off" placeholder="Ingrese la matricula del estudiante o profesor que solicita" required/> 
                    </div>
                    <div class="mb-3">
                        <label for="entrega" class="form-label">Fecha de entrega:</label>
        	            <input type="date" class="form-control" id="entrega" name="entrega" value="<?php echo date('Y-m-d'); ?>" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" name="esConsumible" type="checkbox" value="1" id="esConsumible" autocomplete="off">
                            <label class="form-check-label" for="esConsumible">
                                Registrar Prestamo Consumible
                            </label>
                        </div>
                    </div>
                    <div class="mb-3" id="devol">
                        <label for="devolucion" class="form-label">Fecha de devolución:</label>
        	            <input type="date" class="form-control" id="devolucion" name="devolucion" placeholder="aa/mm/dd" autocomplete="off" required>
                    </div>
                    <div class="mb-3" style="text-align: end;">
        	            <button class="btn btn-warning" style="display: inline-block;" type="reset">Borrar Campos</button>
                        <button class="btn btn-primary" type="submit">Registrar Prestamo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?= BASE_JS .'prestamos.js'?>"></script>
<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Prestamos';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>