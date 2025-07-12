<?php
use Core\Enlace;
ob_start();
?>
<div class="container">
    <div class="contenedorForma">
		<div class="container-titulo">
			<h5>Modificar datos de usuario</h5>
		</div>
        <div class="row">
            <form  action="" method="POST">
                <div class="mb-2">
                    <label for="matricula">Matricula</label>
                    <input type="text" id="matricula" name="matricula" class="form-control" placeholder="Ingrese la matricula" autocomplete="off" required />
                </div> 
                <div class="mb-2">
                    <label for="filtrar">Tipo de Usuario</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="filtrar" id="radio" value="0" checked>
                        <label class="form-check-label" for="radio0">
                          Encargado
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="filtrar" id="radio" value="0" checked>
                        <label class="form-check-label" for="radio0">
                          Servicio
                        </label>
                    </div>
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
                    <a href="" id="borrar" name="borrar" class="btn btn-danger">Eliminar usuario</a>
		            <a href="" id="guardar" name="guardar" class="btn btn-primary">Guardar Datos</a>
                </div>	
	        </form>
        </div>
    </div>
</div>
<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Modificar usuario';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>