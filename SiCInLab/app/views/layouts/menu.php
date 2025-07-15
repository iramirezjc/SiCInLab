<?php
use Core\Enlace;
?>
<div class="menu-index">
    <div class="container-menu">
        <ul class="modulos">
            <?php if ($_SESSION['usuario']['rol'] === '1') {?>
            <li>
                <a href="#">Usuarios</a>
                <ul class="pantallas">
                    <li><a href="<?= Enlace::url('usuarios/index'); ?>">usuarios registrados</a></li>
                    <li><a href="<?= Enlace::url('usuarios/alta'); ?>">registrar usuario</a></li>
                </ul>
            </li>
            <?php } ?>
            <li>
                <a href="#">Servicio a sala</a>
                <ul class="pantallas">
                    <li><a href="<?= Enlace::url('servicio-sala/reservacion'); ?>">Reservar Sala</a></li>
                    <li><a href="<?= Enlace::url('servicio-sala/acceso'); ?>">Acceso a Sala</a></li>
                </ul>
            </li>
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