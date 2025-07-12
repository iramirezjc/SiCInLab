<?php
namespace App\Controllers;

use App\Models\NivelUsuario;
use App\Models\Usuario;
use Core\Controller;

class UsuariosController extends Controller {
    private $usuarios;
    private $nivelUsuario;

    public function __construct(){
        $this->usuarios = new Usuario();
        $this->nivelUsuario = new NivelUsuario();
    }
    public function index() {
        $lista = $this->usuarios->listar();

        $this->render('usuario/index', ['usuarios' => $lista]);
    }
    public function alta() {
        $lista = $this->nivelUsuario->listar();

        $this->render('usuario/alta', ['roles' => $lista]);
    }
    public function guardar() {
        $clave = $_POST['clave'];
        $comprobarClave = $_POST['repiteClave'];
        if ($clave !== $comprobarClave) {
            echo "<script>alert('Las contraseñas no coinciden'); window.history.back();</script>";
            exit;
        }
        $claveCifrada = password_hash($clave, PASSWORD_ARGON2ID);

        $datos = [
            'nivelUsario' => $_POST['filtrar'],
            'nomUsuario' =>  $_POST['nombres'],
            'apeUsuario' => $_POST['apellidos'],
            'matUsuario' => $_POST['matricula'],
            'TelUsuario' => $_POST['numeroTel'],
            'fechUsuario'=> $_POST['fechaNacimiento'],
            'usuarioNom' => $_POST['userName'],
            'claveUsuario' => $claveCifrada,
        ];

        $this->usuarios->insertar($datos);
        
        return $this->redirect('usuario/index');
    }
    public function editar() {
        $this->render('usuario/editar');
    }
    public function buscador() {
        $valorBusqueda = trim($_GET['buscar']);

        if ($valorBusqueda === '') {
            return $this->redirect('usuario/index');
        } else {
            $usuarios = $this->usuarios->buscar($valorBusqueda);
        }

        $this->render('usuario/index', ['usuarios' => $usuarios]);
    }
}