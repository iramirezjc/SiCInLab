<?php
use Core\Enlace;
ob_start();
?>
<div class="usuario-index">
    <div class="container">
        <div class="contenedorForma">
			<div class="container-titulo">
				<h5>Usuarios</h5>
			</div>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <div>
                        <form method="GET" action="<?= Enlace::url('usuario/buscador') ?>">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="buscar" placeholder="Buscar usuario..." aria-label="Buscar por nombre de usuario" aria-describedby="button-addon2" autocomplete="off">
                                <button class="btn btn-outline-primary" type="submit" id="buscar">Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-3"></div>
                <div class="row">
                    <table class="tabla-general">
                        <thead>
                            <tr>
                                <th>Matricula</th>
                                <th>Nombre Usuario</th>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Nivel de usuario</th> 
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($usuarios as $usuario): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($usuario['id_matri']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['user_name']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['apell'].' '.$usuario['nombr']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['num_tel']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['nombr_nivel']); ?></td>
                                    <td class="col-opciones">
                                        <div>
                                            <a href="<?= Enlace::url('usuarios/editar/'.$usuario['id_matri'])?>" class="btn btn-secondary">Restablecer</a>
                                            <a href="<?= Enlace::url('usuarios/borrar/'.$usuario['id_matri'])?>" class="btn btn-danger" 
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">Eliminar</a>                     
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
</div>

<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Usuarios';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>