<?php
namespace App\Controllers;

use App\Models\Categoria;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Equipo;
use App\Models\Material;
use App\Models\Mobiliario;
use App\Models\Reactivo;
use Core\Controller;

class DetalleComprasController extends Controller {
    private $detalleCompra;
    private $compra;
    private $categoria;
    private $equipo;
    private $material;
    private $mobiliario;
    private $reactivo;

    public function __construct() {
        $this->detalleCompra = new DetalleCompra();  
        $this->compra = new Compra();
        $this->categoria = new Categoria();  
        $this->equipo = new Equipo();  
        $this->material = new Material();
        $this->mobiliario = new Mobiliario();
        $this->reactivo = new Reactivo(); 
    }
    public function index() {
        $elemento = $this->compra->ultimaCompra();
        $categorias = $this->categoria->listar();

        $this->render('detalle-compras/index', [
            'compra' => $elemento,
            'categorias' => $categorias, 
        ]);
    }
    public function obtenerObjetos() {
        $opcion = isset($_GET['opcion']) ? (int) $_GET['opcion'] : 0;
        $valores = [];

        switch ($opcion) {
            case 1:
                $valores = $this->equipo->listar();
                break;
            case 2:
                $valores = $this->material->listar();
                break;
            case 3:
                $valores = $this->mobiliario->listar();
                break;
            case 4:
                $valores = $this->reactivo->listar();
                break;
        }

        //Asegura que la respuesta sea JSON limpio
        header('Content-Type: application/json');
        echo json_encode($valores);
    }

    public function registrarCompras() {
        $fk_compr = $_POST['fk_compr'];
        $categorias = $_POST['categoria'];
        $objetos = $_POST['opciones'];
        $cantidades = $_POST['cantidad'];
        
        for ($i = 0; $i < count($categorias); $i++) {
            $datos = [
                'categoria' => $categorias[$i],
                'objeto' => $objetos[$i],
                'cantidad' => $cantidades[$i],
                'compra' => $fk_compr,
            ];

            $this->detalleCompra->insertar($datos);
            
            switch ($datos['categoria']) {
                case 1: 
                    $this->equipo->sumaCantidadId($datos['cantidad'], $datos['objeto']);
                    break;
                case 2: 
                    $this->material->sumaCantidadId($datos['cantidad'], $datos['objeto']);
                    break;
                case 3: 
                    $this->mobiliario->sumaCantidadId($datos['cantidad'], $datos['objeto']);
                    break;
                case 4: 
                    $this->reactivo->sumaCantidadId($datos['cantidad'], $datos['objeto']);
                    break;
            }
        }
        
        header('Content-Type: application/json');
        echo json_encode([
            'redirect' => BASE_URL . 'compras/index'
        ]);
        exit;
    }
}