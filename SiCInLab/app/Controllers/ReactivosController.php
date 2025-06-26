<?php
namespace App\Controllers;

use App\Models\Reactivo;
use App\Models\Unidad;
use Core\Controller;

class ReactivosController extends Controller {
    private $reactivo;
    private $unidad;

    public function __construct() {
        $this->reactivo = new Reactivo();
        $this->unidad = new Unidad();        
    }
    public function index() {
        $reactivos = $this->reactivo->listar();

        $this->render('reactivos/index', ['reactivos' => $reactivos]);
    }
    public function alta() {
        $unidades = $this->unidad->listar();

        $this->render('reactivos/alta', ['unidades' => $unidades]);
    }
    public function guardar() {
        $datos = [
            'nombr'=> $_POST['nombr'],
            'formu'=> $_POST['formu'],
            'salud'=> $_POST['salud'],
            'infla'=> $_POST['infla'],
            'inest'=> $_POST['inest'],
            'espec'=> $_POST['espec'],
            'canti'=> $_POST['canti'],
            'fk_unids'=> $_POST['fk_unids'],
        ];
        $this->reactivo->insertar($datos);

        return $this->redirect('reactivos/index');
    }
    public function editar($idReactivo) {
        $elemento = $this->reactivo->mostrar($idReactivo);
        $unidades = $this->unidad->listar();

        $this->render('reactivos/editar', [
            'reactivo' => $elemento,
            'unidades' => $unidades,
        ]);
    }
    public function modificar($idReactivo) {
        $datos = [
            'nombr'=> $_POST['nombr'],
            'formu'=> $_POST['formu'],
            'salud'=> $_POST['salud'],
            'infla'=> $_POST['infla'],
            'inest'=> $_POST['inest'],
            'espec'=> $_POST['espec'],
            'canti'=> $_POST['canti'],
            'fk_unids'=> $_POST['fk_unids'],
        ];
        $this->reactivo->actualizar($datos, $idReactivo);

        return $this->redirect('reactivos/index');
    }
    public function borrar($idReactivo) {
        $id_react = (int) $idReactivo;
        $eliminado = $this->reactivo->eliminar($id_react);

        if($eliminado) {
            return $this->redirect('reactivos/index');
        } else {
            echo "Error al intentar eliminar el reactivo.";
        }
    }
    public function buscador() {
        $nombre = trim($_GET['buscar']);

        if ($nombre === '') {
            return $this->redirect('reactivos/index');
        } else {
            $reactivos = $this->reactivo->buscar($nombre);
        }

        $this->render('reactivos/index', ['reactivos' => $reactivos]);
    }
}