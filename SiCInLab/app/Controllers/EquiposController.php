<?php
namespace App\Controllers;

use App\Models\Equipo;
use Core\Controller;

class EquiposController extends Controller {
    private $equipo;

    public function __construct() {
        parent::__construct(true);
        $this->equipo = new Equipo();
    }
    
    public function index() {
        $lista = $this->equipo->listar();

        $this->render('equipos/index', ['equipos' => $lista]);
    }
    public function alta() {
        $this->render('equipos/alta');
    }
    public function guardar() {
        $datos = [
            'nombre' => $_POST['nombr_equip'],
            'cantidad' => $_POST['canti_equip'],
            'descripcion' => $_POST['descr'],
            'tipo' => $_POST['tipo'],
        ];
        $this->equipo->insertar($datos);

        return $this->redirect('equipos/index');
    }
    public function editar($idEquipo) {
        $elemento = $this->equipo->mostrar($idEquipo);

        $this->render('equipos/editar', ['equipo' => $elemento]);
    }
    public function modificar($idEquipo) {
        $datos = [
            'idEquipo' => $_POST['id_equip'],
            'nombre' => $_POST['nombr_equip'],
            'cantidad' => $_POST['canti_equip'],
            'descripcion' => $_POST['descr'],
            'tipo' => $_POST['tipo'],
        ];
        $this->equipo->actualizar($datos, $idEquipo);
        
        return $this->redirect('equipos/index');
    }
    public function borrar($idEquipo) {
        $id_equip = (int) $idEquipo;
        $eliminado = $this->equipo->eliminar($id_equip);

        if($eliminado) {
            return $this->redirect('equipos/index');
        } else {
            echo "<script>alert('Error al intentar eliminar el equipo.'); window.history.back();</script>";
        }
    }
    public function buscador() {
        $nombre = trim($_GET['buscar']);

        if ($nombre === '') {
            return $this->redirect('equipos/index');
        } else {
            $equipos = $this->equipo->buscar($nombre);
        }

        $this->render('equipos/index', ['equipos' => $equipos]);        
    }
}