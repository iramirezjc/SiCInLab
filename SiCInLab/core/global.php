<?php
//RUTAS ABSOLUTAS
define('BASE_PATH', dirname(__DIR__));//almacena (C:\laragon\www\SiClnLab_v1)
define('BASE_APP', BASE_PATH . '/app');
define('IMGS_PATH', BASE_PATH .'/web/img/');

//RUTAS RELATIVAS
$publicPath = dirname($_SERVER['SCRIPT_NAME']);//almacena (/SiClnLab_v1/public)
define('BASE_URL', $publicPath.'/');
define('BASE_JS', dirname($publicPath).'/web/js/');
define('BASE_STYLE', dirname($publicPath));
