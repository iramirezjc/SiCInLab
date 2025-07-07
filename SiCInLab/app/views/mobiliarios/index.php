<?php
use Core\Enlace;
ob_start();
?>
<div class="mobiliarios-index">
    <div class="container">
        <div class="contenedorForma">
			<div class="container-titulo">
				<h5>Mobiliarios</h5>
			</div>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <div>
                        <form method="GET" action="<?= Enlace::url('mobiliarios/buscador') ?>">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="buscar" placeholder="Buscar por nombre del mobiliario" aria-label="Buscar por nombre del mobiliario" aria-describedby="button-addon2">
                                <button class="btn btn-outline-primary" type="submit" id="buscar">Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-3">
                    <div class="text-end">
                        <a href="<?= Enlace::url('mobiliarios/alta') ?>" class="btn btn-success" role="button">Agregar mobiliario</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <table class="tabla-general" >
                    <thead>
                        <tr>
                            <th>Nombre del Mobiliario</th>
                            <th>Tipo</th>
                            <th>Material</th>
                            <th>Cantidad</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($mobiliarios as $mobiliario): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($mobiliario['nombr']); ?></td>
                                <td><?php echo htmlspecialchars($mobiliario['tipo']); ?></td>
                                <td><?php echo htmlspecialchars($mobiliario['mater']); ?></td>
                                <td class="text-end"><?php echo htmlspecialchars($mobiliario['canti']); ?></td>
                                <td class="col-opciones">
                                    <div>
                                        <a href="<?= Enlace::url('mobiliarios/editar/'. $mobiliario['id_mobil']) ?>" class="btn btn-secondary">Editar</a>
                                        <a href="<?= Enlace::url('mobiliarios/borrar/'. $mobiliario['id_mobil']) ?>" 
                                        class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este equipo?');">Eliminar</a>                     
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Mobiliarios';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>
