<?php
use Core\Enlace;
ob_start();
?>
<div class="servicio-sala-acceso">
    <div class="container">
        <form id="formaGenerica" method="POST"  action="<?= Enlace::url('servicio-sala/acceso'); ?>">
    		<div class="row">
                <div class="contenedorForma">
    				<div class="container-titulo">
    					<h5>Reservaciones del día</h5>
    				</div>
                    <table class="tabla-general">
                        <thead>
                            <tr>
                                <th>Solicita</th>
                                <th>Hora Inicio</th>
                                <th>Asunto</th>
                                <th>Autoriza</th>
                                <th>Estatus</th>
                                <th>Opciones</th>   
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($solicitudes as $solicitud): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($solicitud['solicitante']); ?></td>
                                    <td>
                                        <?php 
                                            $hora = new DateTime($solicitud['hora_inicio']); 
                                            echo htmlspecialchars($hora->format('h:i A')); 
                                        ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($solicitud['asunt']); ?></td>
                                    <td><?php echo htmlspecialchars($solicitud['fk_matri']); ?></td>
                                    <td><?php echo htmlspecialchars($solicitud['estado']); ?></td>
                                    <td class="col-opciones">
                                        <div>
                                            <?php if ($solicitud['estado'] != 'Ocupado') {?>
                                                <button id="ingreso" name="ingreso" class="btn btn-secondary" data-id_horario="<?= htmlspecialchars($solicitud['id_horario']) ?>" >Ingresar</button>
                                            <?php } ?>
                                            <?php if ($solicitud['estado'] == 'Ocupado') {?>
                                                <a href="<?= Enlace::url('servicio-sala/terminaActividad/'.$solicitud['id_horario'])?>" 
                                                class="btn btn-danger" onclick="return confirm('¿Estás por finalizar una actividad en la sala?');">Finalizar</a>
                                            <?php } ?>                  
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>    
                    </table>
                </div>
    		</div>
    	</form>
    </div>
    <!-- Modal de Acceso a sala -->
    <div class="modal fade" id="darAcceso" tabindex="-1" aria-labelledby="accesoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="padding: 2rem; padding-top: 3rem;">
                <form id="formAcceso">
                    <div class="contenedorForma">
    				    <div class="container-titulo">
    				    	<h5>Permitir Acceso a la Sala</h5>
    				    </div>
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="id_horario" name="id_horario"/>
    			    	    <label for="fecha" class="form-label">Fecha:</label>
    			    	    <input type="text" class="form-control" id="fecha" name="fecha" required autocomplete="off"
                            value="<?= date('Y-m-d')?>"/>
    			        </div>
    			        <div class="mb-3">
    			        	<label>Autoriza:</label>
    			        	<input type="text" class="form-control" id="usuario" name="usuario" readonly/><!--Usuario de sesion-->
    			        </div>
    			        <div class="mb-3">
    			        	<label for="solicita" class="form-label">Solicita:</label>
    			        	<input type="text" class="form-control" id="solicita" name="solicita" autocomplete="off" required/>
    			        </div>
            	        <div class="mb-3">
            	            <label for="asunto" class="form-label">Asunto</label>
    			        	<textarea class="form-control" name="asunto" id="asunto" rows="3" required></textarea>
            	        </div>
                        <div class="modal-footer">
                            <button id="reservar" type="submit" class="btn btn-primary" style="width: 100%;">Permitir Ingreso</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?= BASE_JS .'accesoASala.js'?>"></script>
<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Acceso a Sala';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>