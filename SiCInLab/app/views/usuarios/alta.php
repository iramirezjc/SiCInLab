<?php
use Core\Enlace;
ob_start();
?>
<div class="container">
    <div class="contenedorForma">
		<div class="container-titulo">
			<h5>Registrar Usuario</h5>
		</div>
        <div class="row">
            <form id="formularioRegistro" action="" method="POST">
                <div class="mb-2">
                    <label for="filtrar">Tipo de Usuario</label><br>
                    <?php foreach ($roles as $rol): ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="filtrar" id="radio<?= $rol['id_nivel_usuar']?>" value="<?= $rol['id_nivel_usuar']?>" autocomplete="off" require>
                            <label class="form-check-label" for="radio<?= $rol['id_nivel_usuar']?>">
                              <?= $rol['nombr_nivel']?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="mb-2">
                    <label for="matricula">Matricula</label>
                    <input type="text" id="matricula" name="matricula" class="form-control" placeholder="Ingrese la matricula" autocomplete="off" required />
                </div>                
                <div class="mb-2">
                    <label for="nombres">Nombre</label>
                    <input type="text" id="nombres" name="nombres" class="form-control" placeholder="Ingrese los nombres o el nombre de la persona" required  autocomplete="off"/>
                </div>
                <div class="mb-2">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Ingrese los apellidos o el apellido de la persona" autocomplete="off"  required/>
                </div>
                <div class="mb-2">
                    <label for="numeroTel">Número de Teléfono</label>
                    <input type="text" id="numeroTel" name="numeroTel" class="form-control" placeholder="Numero de teléfono o celular" autocomplete="off" required /> 
                </div>
                <div class="mb-2">
                    <label for="fechaNacimiento">Fecha de Nacimiento</label>
                    <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" autocomplete="off" required/> 
                </div>
                <div class="mb-2">
                    <label for="userName">Nombre de Usuario</label>
                    <input type="text" id="userName" name="userName" class="form-control" placeholder="Ingrese un nombe de usuario" autocomplete="off" required/> 
                </div>
                <div class="mb-2">
                    <label for="clave">Contraseña</label>
                    <input type="password" id="clave" name="clave" class="form-control" placeholder="Escribe una contraseña" autocomplete="off" required /> 
		        
                </div>
                <div class="mb-2">
                    <label for="repiteClave">Comprobar Contraseña</label>
                    <input type="password" id="repiteClave" name="repiteClave" class="form-control" placeholder="Escribe una contraseña" autocomplete="off" required /> 
		        
                </div>
                <div class="mb-2 text-end">
                    <button type="reset" id="borrar" name="borrar" class="btn btn-warning">Borrar Campos</button>
		            <button type="submit" id="guardar" name="guardar" class="btn btn-primary">Guardar Datos</button>
                </div>	
	        </form>
        </div>
    </div>
</div>
<script src="<?= BASE_JS .'usuarios/registroUsuario.js'?>"></script>
<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'registro usuarios';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>