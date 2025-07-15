<?php
ob_start();
?>
<div class="container">
    <div class="row text-center">
        <img src="<?= BASE_STYLE?>/web/img/fondo.png"  style="top: 0; position: fixed; height: 100%; width: 60%; left: 25%;"/>
    </div>
</div>
<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Panel Principal';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>