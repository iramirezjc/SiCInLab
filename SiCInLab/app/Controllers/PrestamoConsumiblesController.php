<?php
namespace App\Controllers;

use App\Models\DetallePrestamoConsumible;
use App\Models\Reactivo;
use App\Models\PrestamoConsumible;
use Core\Controller;

class PrestamoConsumiblesController extends Controller {
    private $reactivo;
    private $prestamoConsumible;
    private $detallePrestamoConsumibe;

    public function __construct() {
        $this->reactivo = new Reactivo(); 
        $this->prestamoConsumible = new PrestamoConsumible();
        $this->detallePrestamoConsumibe = new DetallePrestamoConsumible();       
    }
    public function index() {
        $reactivos = $this->reactivo->listar();
        $ultimoPrestamo = $this->prestamoConsumible->ultimoPrestamoConsumible();

        $this->render('consumibles/index', [
            'reactivos' => $reactivos,
            'prestamo' => $ultimoPrestamo,
        ]);
    }
    public function guardarPrestamoConsumible() {
        $consumibles = $_POST['reactivo'];
        $cantidad = $_POST['cantidad'];
        $fk_prest_consu = $_POST['fk_prest_consu'];
        
        for ($i = 0; $i < count($consumibles); $i++) {
            $datos = [
                'id_prest_consu' => $fk_prest_consu,
                'reactivo' => $consumibles[$i],
                'cantidad' => $cantidad[$i],
            ];
            
            $this->detallePrestamoConsumibe->insertar($datos);
            $this->reactivo->restaCantidadId($datos['reactivo'], $datos['cantidad']);
        }
        
        header('Content-Type: application/json'); //devuelves JSON
        echo json_encode([
            'redirect' => BASE_URL . 'prestamos/index'
        ]);
        exit;
    }
    public function obtenerCatidades() {
        $idReactivo = isset($_GET['reactivo']) ? (int) $_GET['reactivo'] : 0;
        $elemento = $this->reactivo->mostrar($idReactivo);

        header('Content-Type: application/json');
        echo json_encode($elemento);
    }
}