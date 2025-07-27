<?php
ob_start();
?>
<div class="usuario-mi-perfil">
    <div class="container">
        <div class="contenedorForma">
			<div class="container-titulo">
				<h5>Mi Perfil</h5>
			</div>
            <div id="contenido" class="row">
                <div class="list-group">
                    <button id="informacion" name="informacion" type="button" class="list-group-item list-group-item-action">
                        Editar Información
                        <i class="bi bi-chevron-right" style="float: right;"></i>
                    </button>
                    <button id="clave" name="clave" type="button" class="list-group-item list-group-item-action">
                        Cambiar Contraseña
                        <i class="bi bi-chevron-right" style="float: right;"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= BASE_JS .'miPerfil.js'?>"></script>
<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Mi perfil';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>