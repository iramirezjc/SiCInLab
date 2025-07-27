<?php
namespace App\Controllers;

use App\Models\NivelUsuario;
use App\Models\Usuario;
use Core\Controller;

class PerfilUsuarioController extends Controller {
    private $usuarios;
    private $nivelUsuario;

    public function __construct(){
        parent::__construct(true);
        $this->usuarios = new Usuario();
        $this->nivelUsuario = new NivelUsuario();
    }
    public function miPerfil() {
        $this->render('perfil-usuario/mi-perfil');
    }
    public function cambiarContrasenia() {
        $this->render('perfil-usuario/cambiar-clave');
    }
    public function guardaNuevaContrasenia() {
        header('Content-Type: application/json');
        $errores = [];
        $datos = $this->usuarios->mostrar($_SESSION['usuario']['matricula']);
        
        if (!password_verify($_POST['claveActual'], $datos['contr'])) {
            $errores['claveActual'] = 'La contraseña actual es incorrecta';
        }
        $claveNueva = $_POST['claveNueva'];
        $comprobarClave = $_POST['repiteClave'];
        if ($claveNueva !== $comprobarClave) {
            $errores['noIguales'] = 'Las contraseñas no coinciden';
        }
        if (!empty($errores)) {
            echo json_encode([
                'success' => false,
                'errores' => $errores
            ]);
            return;
        }
        $claveCifrada = password_hash($claveNueva, PASSWORD_ARGON2ID);
        $this->usuarios->actualizaContrasenia($claveCifrada, $_SESSION['usuario']['matricula']);

        echo json_encode([
            'success' => true,
            'redirect' => BASE_URL.'perfil-usuario/mi-perfil'
        ]);
    }
    public function editar() {
        $detalle = $this->usuarios->mostrar($_SESSION['usuario']['matricula']);
        $lista = $this->nivelUsuario->listar();

        $this->render('perfil-usuario/editar',[
            'usuario' => $detalle,
            'roles' => $lista
        ]);
    }
    public function modificar($matricula) {
        $datos = [
            'nomUsuario' =>  $_POST['nombres'],
            'apeUsuario' => $_POST['apellidos'],
            'TelUsuario' => $_POST['numeroTel'],
            'fechUsuario'=> $_POST['fechaNacimiento'],
            'usuarioNom' => $_POST['userName']
        ];
        $this->usuarios->actualizar($datos, $matricula);

        return $this->redirect('perfil-usuario/mi-perfil');
    }
}