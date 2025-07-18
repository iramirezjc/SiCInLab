<?php
use Core\Enlace;
ob_start();
?>
Bienvenido a mi perfil
<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Mi perfil';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>