<?php
use Core\Enlace;
?>
<div class="menu-index">
    <div class="container-menu">
        <ul class="modulos" id="accordionList">
            <?php if ($_SESSION['usuario']['rol'] === '1') {?>
            <li>
                <a href="#" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#lista1" aria-expanded="false" aria-controls="lista1">
                    Usuarios
                </a>
                <div id="lista1" class="accordion-collapse collapse" data-bs-parent="#accordionList">
                    <div class="accordion-body">
                        <ul class="pantallas">
                            <li><a href="<?= Enlace::url('usuarios/index'); ?>">usuarios registrados</a></li>
                            <li><a href="<?= Enlace::url('usuarios/alta'); ?>">registrar usuario</a></li>
                        </ul>
                    </div>
                </div> 
            </li>
            <?php } ?>
            <li>
                <a href="#" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#lista2" aria-expanded="false" aria-controls="lista2">
                    Servicio a sala
                </a>
                <div id="lista2" class="accordion-collapse collapse" data-bs-parent="#accordionList">
                    <div class="accordion-body">
                        <ul class="pantallas">
                            <li><a href="<?= Enlace::url('servicio-sala/reservacion'); ?>">Reservar Sala</a></li>
                            <li><a href="<?= Enlace::url('servicio-sala/acceso'); ?>">Acceso a Sala</a></li>
                        </ul>
                    </div>
                </div> 
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
        </ul>
    </div>
</div>