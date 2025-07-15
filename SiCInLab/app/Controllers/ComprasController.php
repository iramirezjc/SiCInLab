<?php
namespace App\Controllers;

use App\Models\Compra;
use Core\Controller;

class ComprasController extends Controller {
    private $compra;

    public function __construct() {
        parent::__construct(true);
        $this->compra = new Compra();        
    }

    public function index() {
        $this->render('compras/index');
    }

    public function guardar() {
        $datos = [
            'matricula' => $_POST['matricula'],
            'vendedor' => $_POST['vendedor'],
            'monto' => $_POST['monto'],
        ];
        $this->compra->insertar($datos);

        return $this->redirect('detalle-compras/index');
    }
}