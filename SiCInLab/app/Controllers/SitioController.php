<?php
namespace App\Controllers;

use App\Models\Usuario;
use Core\Controller;

class SitioController extends Controller {
    private $usuario;

    public function __construct() {
        $this->usuario = new Usuario();        
    }
    public function login() {
        $this->render('sitio/login');
    }
    public function iniciarSesion() {
        header('Content-Type: application/json');
        $datos = $this->usuario->mostrar($_POST['usuario']);

        if (!isset($datos)) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'error' => 'Usuario no registrado'
            ]);
            exit;
        }
        if (!password_verify($_POST['clave'], $datos['contr'])) {
            http_response_code(401);
            echo json_encode([
                'success' => false,
                'error' => 'constraseña incorrecta'
            ]);
            exit;
        }
        /*$_SESSION['usuario'] = [
            'id' => $datos['id_usuario'],
            'nombre' => $datos['nombre'],
            'rol' => $datos['id_nivel_usuar']
        ];*/

        echo json_encode([
            'success' => true, 
            'status' => 'ok',
            'redirect' => BASE_URL . 'sitio/panel',
        ]);
    }
    public function panel() {
        /**if (!isset($_SESSION['usuario'])) {
            $this->redirect('login');
            exit;
        }*/
        $this->render('sitio/panel');
    }
}