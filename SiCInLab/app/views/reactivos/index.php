<?php
use Core\Enlace;
ob_start();
?>
<div class="reactivos-index">
    <div class="container">
        <div class="contenedorForma">
			<div class="container-titulo">
				<h5>Reactivos</h5>
			</div>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <div>
                        <form method="GET" action="<?= Enlace::url('reactivos/buscador') ?>">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="buscar" placeholder="Buscar por nombre del reactivo" aria-label="Buscar por nombre del reactivo" aria-describedby="button-addon2">
                                <button class="btn btn-outline-primary" type="submit" id="buscar">Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-3">
                    <div class="text-end">
                        <a href="<?= Enlace::url('reactivos/alta')?>" class="btn btn-success" role="button">Agregar reactivo</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <table class="tabla-general">
                    <thead>
                        <tr>
                            <th>Nombre del Reactivo</th>
                            <th>Cantidad</th>
                            <th>Fórmula Química</th>
                            <th>Peligro a la salud</th>
                            <th>Inflamabilidad</th>
                            <th>Inestabilidad</th>
                            <th>Peligro específico</th>
                            <th>Opciones</th>   
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($reactivos as $reactivo): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($reactivo['react_nombr']); ?></td>
                                <td class="text-end"><?php echo htmlspecialchars($reactivo['cant'].' '.$reactivo['unid_nombr']); ?></td>
                                <td><?php echo htmlspecialchars($reactivo['formu']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($reactivo['pelig_salud']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($reactivo['pelig_infla']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($reactivo['pelig_ines']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($reactivo['pelig_esp']); ?></td>
                                <td class="col-opciones">
                                    <div>
                                        <a href="<?= Enlace::url('reactivos/editar/'.$reactivo['id_react'])?>" class="btn btn-secondary">Editar</a>
                                        <a href="<?= Enlace::url('reactivos/borrar/'.$reactivo['id_react'])?>" 
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
$titulo = 'Reactivos';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>