<?php
use Core\Enlace;
?>
<div class="container">
    <form action="<?= Enlace::url('perfil-usuario/modificar/'.$usuario['id_matri']) ?>" method="POST">
        <div class="mb-2">
            <label for="matricula">Matricula</label>
            <input type="text" id="matricula" name="matricula" class="form-control" placeholder="Ingrese la matricula" autocomplete="off" readonly
            value="<?= $usuario['id_matri']; ?>"/>
        </div>               
        <div class="mb-2">
            <label for="nombres">Nombre</label>
            <input type="text" id="nombres" name="nombres" class="form-control" placeholder="Ingrese los nombres o el nombre de la persona" required  autocomplete="off"
            value="<?= $usuario['nombr']; ?>"/>
        </div>
        <div class="mb-2">
            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Ingrese los apellidos o el apellido de la persona" autocomplete="off"  required
            value="<?= $usuario['apell']; ?>"/>
        </div>
        <div class="mb-2">
            <label for="numeroTel">Número de Teléfono</label>
            <input type="text" id="numeroTel" name="numeroTel" class="form-control" placeholder="Numero de teléfono o celular" autocomplete="off" required
            value="<?= $usuario['num_tel']; ?>"/> 
        </div>
        <div class="mb-2">
            <label for="fechaNacimiento">Fecha de Nacimiento</label>
            <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" autocomplete="off" required
            value="<?= $usuario['fecha_nacim']; ?>"/> 
        </div>
        <div class="mb-2">
            <label for="userName">Nombre de Usuario</label>
            <input type="text" id="userName" name="userName" class="form-control" placeholder="Ingrese un nombe de usuario" autocomplete="off" required
            value="<?= $usuario['user_name']; ?>"/> 
        </div>
        <div class="mb-2 text-end">
            <a href="<?= Enlace::url('perfil-usuario/mi-perfil'); ?>" class="btn btn-secondary" style="display: inline-block;">Volver</a>
	        <button type="submit"  id="guardar" name="guardar" class="btn btn-primary">Guardar Cambios</button>
        </div>	
	</form>
</div>