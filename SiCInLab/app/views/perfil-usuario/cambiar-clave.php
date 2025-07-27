<?php
use Core\Enlace;
?>
<form id="formaGenerica" method="POST" action="<?= Enlace::url('perfil-usuario/guardaNuevaContrasenia'); ?>">
    <div id="mensajes" class="alert alert-warning d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Warning:" style="width: 1rem; height: 1rem;">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
        <div id="mensaje"></div>
    </div>
    <div class="mb-2">
        <label for="clave">Contraseña Actual</label>
        <input type="password" id="claveActual" name="claveActual" class="form-control" placeholder="Escribe la contraseña actual" autocomplete="off" required /> 
    </div>
    <div class="mb-2">
        <label for="clave">Nueva Contraseña</label>
        <input type="password" id="nuevaClave" name="nuevaClave" class="form-control" placeholder="Escribe una nueva contraseña" autocomplete="off" required /> 
    </div>
    <div class="mb-2">
        <label for="repiteClave">Comprobar Contraseña</label>
        <input type="password" id="repiteClave" name="repiteClave" class="form-control" placeholder="Repite la neva contraseña" autocomplete="off" required /> 
    </div>
    <div class="text-end">
        <a href="<?= Enlace::url('perfil-usuario/mi-perfil'); ?>" class="btn btn-secondary" style="display: inline-block;">Volver</a>
        <button type="submit" id="guardar" name="guardar" class="btn btn-primary" style="display: inline-block;">Guardar</button>
    </div>
</form>
