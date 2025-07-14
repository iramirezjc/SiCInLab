<?php
namespace App\Controllers;

use App\Models\Material;
use App\Models\Unidad;
use Core\Controller;

class MaterialesController extends Controller {
    private $material;
    private $unidad;

    public function __construct() {
        $this->material = new Material();
        $this->unidad = new Unidad();        
    }

    public function index() {
        $materiales = $this->material->listar();

        $this->render('materiales/index', ['materiales' => $materiales]);
    }
    public function alta() {
        $unidades = $this->unidad->listar();

        $this->render('materiales/alta', ['unidades' => $unidades]);
    }
    public function guardar() {
        $datos = [
            'nombre' => $_POST['nombr'],
            'capacidad' => $_POST['capac'],
            'cantidad' => $_POST['canti'],
            'marca' => $_POST['marca'],
            'unidad' => $_POST['fk_unids'],            
        ];
        $this->material->insertar($datos);

        return $this->redirect('materiales/index');
    }
    public function editar($idMaterial) {
        $elemento = $this->material->mostrar($idMaterial);
        $unidades = $this->unidad->listar();

        $this->render('materiales/editar', [
            'material' => $elemento,
            'unidades' => $unidades,
        ]);
    }
    public function modificar($idMaterial) {
        $datos = [
            'nombre' => $_POST['nombr'],
            'capacidad' => $_POST['capac'],
            'cantidad' => $_POST['canti'],
            'marca' => $_POST['marca'],
            'unidad' => $_POST['fk_unids'],            
        ];
        $this->material->actualizar($datos, $idMaterial);

        return $this->redirect('materiales/index');
    }
    public function borrar($idMaterial) {
        $id_mater = (int) $idMaterial;
        $eliminado = $this->material->eliminar($id_mater);

        if($eliminado) {
            return $this->redirect('materiales/index');
        } else {
            echo "<script>alert('Error al intentar eliminar el material.'); window.history.back();</script>";
        }
    }
    public function buscador() {
        $nombre = trim($_GET['buscar']);

        if ($nombre === '') {
            return $this->redirect('materiales/index');
        } else {
            $materiales = $this->material->buscar($nombre);
        }

        $this->render('materiales/index', ['materiales' => $materiales]);        
    }
}