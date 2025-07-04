<?php
use Core\Enlace;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Estilos -->
    <link href="<?=BASE_URL?>css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="<?=BASE_URL?>css/bootstrap-icons.css" rel="stylesheet">
    <link href="<?=BASE_URL?>css/bootstrap-select.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= BASE_STYLE?>/web/css/app.css">
    <!-- Scripts -->
    <script src="<?=BASE_URL?>js/jquery-3.7.1.min.js"></script>
    <script src="<?=BASE_URL?>js/jquery.validate.min.js"></script>
    <script src="<?=BASE_URL?>js/index.global.min.js"></script>
    
    <!-- Bootstrap con Popper incluido -->
    <script src="<?=BASE_URL?>js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?=BASE_URL?>js/bootstrap-select.min.js" crossorigin="anonymous"></script>
    
    <link rel="icon" href="<?= BASE_STYLE?>/web/img/escudo_letras.png" type="image/x-icon">
    <title><?= htmlspecialchars($titulo ?? 'SiCInLab') ?></title>
</head>
<body>
    <header class="header">
        <div class="cabecera logo-nav-container">
            <a href="" class="logo">Logo</a>
            <nav class="navbar">
                <ul>
                    <li><a href="/usuario">Usuario</a></li>
                    <li><a href="/Inicio">Inicio</a></li>
                    <li><a href="/salir">Salir</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="app-wrapper">
        <div class="sidebar">
            <ul>
                <li><a href="/">Usuarios</a></li>
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
        <main class="main">
            <h1 style="text-align:center;"><?= htmlspecialchars($titulo ?? 'SiCInLab') ?></h1>
            <?= $contenido ?? '' ?>
        </main>
    </div>
</body>
</html>