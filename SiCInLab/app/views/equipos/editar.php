<?php

use Core\Enlace;
ob_start() 
?>

<div class="equipos-modificacion">
    <div class="container">
        <div class="contenedorForma">
			<div class="container-titulo">
				<h5>Editar Equipo</h5>
			</div>
            <div class="row">
                <form method="POST" action="<?= Enlace::url('equipos/editar/'. $equipo['id_equip']); ?>">
                    <div class="mb-3">
                        <input type="hidden" name="id_equip" id="id_equip"  
                        value="<?php echo isset($equipo['id_equip']) ? $equipo['id_equip'] : ''; ?>"/>
                    </div>
                    <div class="mb-3">
                        <label for="nombr_equip" class="form-label">Nombre del equipo</label>
                        <input type="text" class="form-control" name="nombr_equip" id="nombr_equip" required
                        value="<?php echo isset($equipo['nombr_equip']) ? $equipo['nombr_equip'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="canti_quip" class="form-label">Cantidad de piezas</label>
                        <input type="number" class="form-control" name="canti_equip" id="canti_equip" required
                        value="<?php echo isset($equipo['canti_equip']) ? $equipo['canti_equip'] : ''; ?>"/>
                    </div>
                    <div class="mb-3">
                        <label for="descr" class="form-label">Descripcion del equipo</label>
                        <textarea class="form-control" name="descr" id="descr" rows="3" required>
                            <?= isset($equipo['descr']) ? htmlspecialchars($equipo['descr']) : null ?>
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de Equipo</label>
                        <input type="text" class="form-control" name="tipo" id="tipo" required
                        value="<?php echo isset($equipo['tipo']) ? $equipo['tipo'] : ''; ?>">
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
$titulo = 'Modificar un equipo';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>
		