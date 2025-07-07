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
    <div class="container-fluid">
        <div class="row fixed-top shadow-sm">
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
        </div>
        <div class="row">
            <div class="col-2 sidebar">
                <?php include 'menu.php'; ?>
            </div>
            <div class="col-10 offset-2">
                <main class="main p-4">
                    <?= $contenido ?? '' ?>
                </main>
            </div>
        </div>
    </div>
</body>
</html>