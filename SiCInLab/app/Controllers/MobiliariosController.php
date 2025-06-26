<?php
namespace App\Controllers;

use App\Models\Mobiliario;
use Core\Controller;

class MobiliariosController extends Controller {
    private $mobiliario;

    public function __construct() {
        $this->mobiliario = new Mobiliario();
    }
    public function index() {
        $mobiliarios = $this->mobiliario->listar();

        $this->render('mobiliarios/index', ['mobiliarios' => $mobiliarios]);
    }
    public function alta() {
        $this->render('mobiliarios/alta');
    }
    public function guardar() {
        $datos = [
            'nombre' => $_POST['nombr'],
            'tipo' => $_POST['tipo'],
            'material' => $_POST['mater'],
            'cantidad' => $_POST['canti'],
        ];
        $this->mobiliario->insertar($datos);

        return $this->redirect('mobiliarios/index');
    }
    public function editar($idMobiliario) {
        $elemento = $this->mobiliario->mostrar($idMobiliario);

        $this->render('mobiliarios/editar', ['mobiliario' => $elemento]);
    }
    public function modificar($idMobiliario) {
        $datos = [
            'nombre' => $_POST['nombr'],
            'tipo' => $_POST['tipo'],
            'material' => $_POST['mater'],
            'cantidad' => $_POST['canti'],
        ];
        $this->mobiliario->actualizar($datos, $idMobiliario);

        return $this->redirect('mobiliarios/index');
    }
    public function borrar($idMobiliario) {
        $id_mobil = (int) $idMobiliario;
        $eliminado = $this->mobiliario->eliminar($id_mobil);

        if($eliminado) {
            return $this->redirect('mobiliarios/index');
        } else {
            echo "Error al intentar eliminar el mobiliario.";
        }
    }
    public function buscador() {
        $nombre = trim($_GET['buscar']);

        if ($nombre === '') {
            return $this->redirect('mobiliarios/index');
        } else {
            $mobiliarios = $this->mobiliario->buscar($nombre);
        }

        $this->render('mobiliarios/index', ['mobiliarios' => $mobiliarios]);
    }
}