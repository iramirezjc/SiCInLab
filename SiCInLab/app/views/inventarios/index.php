<?php
use Core\Enlace;

ob_start() 
?>
<div class="inventario-index">
    <div class="container">
        <div class="contenedorForma">
			<div class="container-titulo">
				<h5>Inventario</h5>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="text-end">
                        <label style="margin-right: 15px;">
                            <input type="checkbox" id="todos" name="todos" autocomplete="off"> Todo
                        </label> 
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3" style="text-align: center;">
                        <button type="submit" id="inicio" name="inicio" class="btn btn-info">Iniciar inventario</button>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3" style="text-align: end;">
                        <button type="submit" id="generar" name="generar" class="btn btn-success">Generar PDF</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mb-3">
                    <form id="formControl">
                        <table class="tabla-general">
	                    <thead>
			        	    <tr>
                                <th># No.</th>
                                <th>Categoria</th>
                                <th>Nombre</th>
			        			<th>En Sistema</th>
                                <th>Existente</th>
                                <th>Diferencia</th>
			        		</tr>
			        	</thead>
                        <tbody id="filas">
                        </tbody>
			        </table>
                    </form>
                </div>
                <div class="text-end">
                    <button type="submit" id="guardar" name="guardar" class="btn btn-primary">Guardar Inventario</button>
                </div>
            </div>
        </div>
	</div>
</div>
<script src="<?= BASE_JS .'inventario.js'?>"></script>
<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Inventario';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>