<?php

use Core\Enlace;
ob_start(); 
?>

<!--Vista Equipos -->
<div class="equipos-index">
    <div class="container">
        <div class="contenedorForma">
			<div class="container-titulo">
				<h5>Equipos</h5>
			</div>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <div>
                        <form method="GET" action="<?= Enlace::url('equipos/buscador') ?> ">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="buscar" placeholder="Buscar por nombre del equipo" aria-label="Buscar por nombre del equipo" aria-describedby="button-addon2">
                                <button class="btn btn-outline-primary" type="submit" id="buscar">Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-3">
                    <div class="text-end">
                        <a href="<?= Enlace::url('equipos/alta') ?>" class="btn btn-success" role="button">Agregar equipo</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <table class="tabla-general">
                    <thead>
                        <tr>
                            <th style="width: 12rem;">Nombre del equipo</th>
                            <th>Cantidad</th>
                            <th>Descripcion</th>
                            <th>Tipo</th>
                            <th >Operaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($equipos as $equipo): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($equipo['nombr_equip']); ?></td>
                            <td class="text-end"><?php echo htmlspecialchars($equipo['canti_equip']); ?></td>
                            <td><?php echo htmlspecialchars($equipo['descr']); ?></td>
                            <td><?php echo htmlspecialchars($equipo['tipo']); ?></td>
                            <td class="col-opciones">
                                <div>
                                    <a href="<?= Enlace::url('equipos/editar/' . $equipo['id_equip']) ?>" class="btn btn-secondary">Editar</a>
                                    <a href="<?= Enlace::url('equipos/borrar/' . $equipo['id_equip']) ?>" 
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
$titulo = 'Equipos';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>