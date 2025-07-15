<?php
namespace App\Controllers;

use App\Models\Incidencia;
use Core\Controller;

class IncidenciasController extends Controller {
    private $incidencia;
    
    public function __construct() {
        parent::__construct(true);
        $this->incidencia = new Incidencia();        
    }
    public function index() {
        $this->render('incidencias/index');
    }
    public function guardar() {
        $datos = [
            'fecha' => $_POST['fecha'],
            'descripcion' => $_POST['descripcion'],
            'matricula' => $_POST['matricula'],
        ];
        $this->incidencia->insertar($datos);

        return $this->redirect('incidencias/index');
    }
}