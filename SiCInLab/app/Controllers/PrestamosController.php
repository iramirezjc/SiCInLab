<?php
namespace App\Controllers;

use App\Models\Categoria;
use App\Models\DetallePrestamo;
use App\Models\Equipo;
use App\Models\Material;
use App\Models\Mobiliario;
use App\Models\PrestamoConsumible;
use App\Models\Prestamo;
use Core\Controller;

class PrestamosController extends Controller {
    private $prestamoConsumible;
    private $detallePrestamo;
    private $prestamo;
    private $categoria;
    private $equipos;
    private $materiales;
    private $mobiliarios;

    public function __construct() {
        $this->prestamoConsumible = new PrestamoConsumible(); 
        $this->detallePrestamo = new DetallePrestamo(); 
        $this->prestamo = new Prestamo();  
        $this->categoria = new Categoria();
        $this->equipos = new Equipo();
        $this->materiales = new Material();
        $this->mobiliarios = new Mobiliario();
    }
    public function index() {
        $this->render('prestamos/index');
    }
    public function registrarPrestamo() {
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
        $this->prestamo->insertar($datos);

        return $this->redirect('prestamos/detallePrestamo');
    }
    public function detallePrestamo() {
        $categorias = $this->categoria->listarParaPrestamo();
        $prestamos = $this->prestamo->ultimoPrestamo();

        $this->render('prestamos/detalle-prestamo',[
                'categorias' => $categorias,
                'prestamo' => $prestamos,
            ]
        );
    }
    public function listarObjetos() {
        $opcion = isset($_GET['opcion']) ? $_GET['opcion'] : 0;
        $valores = [];
        
        switch ($opcion) {
            case 0:
                $valores = array_merge(
                    $this->equipos->listar(),
                    $this->materiales->listar(),
                    $this->mobiliarios->listar()
                );
                break;
            case 1:
                $valores = $this->equipos->listar();
                break;
            case 2:
                $valores = $this->materiales->listar();
                break;
            case 3:
                $valores = $this->mobiliarios->listar();
                break;
        }
        //Asegura que la respuesta sea JSON limpio
        header('Content-Type: application/json');
        echo json_encode($valores);
    }
    public function guardarDetallePrestamo() {
        $categorias = $_POST['categoria'];
        $objetos = $_POST['articulo'];
        $cantidades = $_POST['cantidad'];
        $idPrestamo = $_POST['noPrestamo'];

        for ($i = 0; $i < count($objetos); $i++) {
            $datos = [
                'fk_categ' => $categorias[$i],
                'fk_obj' => $objetos[$i],
                'cant' => $cantidades[$i],
                'fk_prest' => $idPrestamo,
            ];
            $this->detallePrestamo->insertar($datos);

            switch ($datos['fk_categ']) {
                case 1:
                    $this->equipos->restaCantidadId($datos['fk_obj'], $datos['cant']);
                    break;
                case 2:
                    $this->materiales->restaCantidadId($datos['fk_obj'], $datos['cant']);
                    break;
                case 1:
                    $this->mobiliarios->restaCantidadId($datos['fk_obj'], $datos['cant']);
                    break;
            }
        }
        header('Content-Type: application/json'); //devuelves JSON
        echo json_encode([
            'redirect' => BASE_URL . 'prestamos/index'
        ]);
        exit;
    }
}