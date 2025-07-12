<?php
use Core\Enlace;
?>
<div class="menu-index">
    <div class="container-menu">
        <ul class="modulos">
            <li>
                <a href="">Usuarios</a>
                <ul class="pantallas">
                    <li><a href="<?= Enlace::url('usuario/index'); ?>">usuarios registrados</a></li>
                    <li><a href="<?= Enlace::url('usuario/alta'); ?>">registrar usuario</a></li>
                    <li><a href="<?= Enlace::url('usuario/editar'); ?>">modificar datos</a></li>
                </ul>
            </li>
            <li><a href="<?= Enlace::url('servicio-sala/reservacion'); ?>">Servicio a sala</a></li>
            <li><a href="<?= Enlace::url('prestamos/index'); ?>">Prestamos</a></li>
            <li><a href="<?= Enlace::url('devoluciones/index'); ?>">Devoluciones</a></li>
            <li><a href="<?= Enlace::url('compras/index'); ?>">Compras</a></li>
            <li><a href="<?= Enlace::url('mobiliarios/index'); ?>">Mobiliario</a></li>
            <li><a href="<?= Enlace::url('materiales/index'); ?>">Materiales</a></li>
            <li><a href="<?= Enlace::url('equipos/index'); ?>">Equipos</a></li>
            <li><a href="<?= Enlace::url('reactivos/index'); ?>">Reactivos</a></li>
            <li><a href="<?= Enlace::url('inventarios/index'); ?>">Inventario</a></li>
            <li><a href="<?= Enlace::url('incidencias/index'); ?>">Incidencias</a></li>
            <li><a href="/servicios">Graficas</a></li>
        </ul>
    </div>
</div>