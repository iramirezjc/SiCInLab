<?php
namespace Core;

class Controller {

    public function __construct($requiereSesion = false) {
        if ($requiereSesion) {
            $this->revisaSesion();
        }
    }
    protected function revisaSesion() {
        if (!isset($_SESSION['usuario'])) {
            $this->redirect('login');
            exit;
        }
    }
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