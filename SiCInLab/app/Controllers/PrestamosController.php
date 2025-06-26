<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\PrestamoConsumible;

class PrestamosController extends Controller {
    private $prestamoConsumible;

    public function __construct() {
        $this->prestamoConsumible = new PrestamoConsumible();      
    }

    public function index() {
        return $this->render('prestamos/index');
    }

    public function guardar() {
        $esConsumible = isset($_POST['esConsumible']) ? true : false;
        $datos = [
            'usuario' => $_POST['usuario'],
            'solicita' => $_POST['solicita'],
            'entrega' => $_POST['entrega'],
            'devolucion' => isset($_POST['devolucion']) ? $_POST['devolucion'] : '',
        ];
        if ($esConsumible) {
            $this->prestamoConsumible->insertar($datos);
            
            return $this->redirect('consumibles/index');
            exit;
        }
        echo 'se queda en prestamos';
    }
}