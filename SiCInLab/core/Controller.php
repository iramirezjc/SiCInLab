<?php
namespace Core;

class Controller {

    protected function render($path, $parameters = [], $layout = '') {
        extract($parameters);
        require_once(__DIR__.'/../app/views/'.$path.'.php');
    }

    protected function redirect($path, $parameters = []) {
        extract($parameters);
        header('Location: ' .BASE_URL. $path);
        exit;
    }
}