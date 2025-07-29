<?php
namespace App\Controllers;

use App\Models\Devolucion;
use App\Models\DetalleDevolucion;
use App\Models\DetallePrestamo;
use App\Models\Prestamo;
use App\Models\Equipo;
use App\Models\Material;
use App\Models\Mobiliario;
use Core\Controller;

class DevolucionesController extends Controller {
    private $devolucion;
    private $detalleDevolucion;
    private $prestamo;
    private $detallePrestamo;
    private $equipo;
    private $material;
    private $mobiliario;

    public function __construct() {
        parent::__construct(true);
        $this->devolucion = new Devolucion();
        $this->detalleDevolucion = new DetalleDevolucion();
        $this->prestamo = new Prestamo();  
        $this->detallePrestamo = new DetallePrestamo(); 
        $this->equipo = new Equipo(); 
        $this->material = new Material();
        $this->mobiliario = new Mobiliario();
    }
    public function index() {
        $this->render('devoluciones/index');
    }
    public function buscarPrestamos() {
        $matricula = isset($_GET['prestamos']) ? (int) $_GET['prestamos'] : 0;
        $prestamos = $this->prestamo->buscarMatricula($matricula);
        $detalles = [];
        $objetos = [];

        if (empty($prestamos)) {
            header('Content-Type: application/json');
            echo json_encode([
                'mensaje' => 'No se encontraron préstamos para esta matrícula.'
            ]);
            exit;
        }
        foreach ($prestamos as $prestamo) {
            $detalle['cant_devue'] = 0;
            $prestado = $this->detallePrestamo->consultaDetalleFk($prestamo['id_prest']);

            foreach ($prestado as $detalle) {
                $id_devol = $this->devolucion->compruebaDevolucion($detalle['fk_prest']);
                
                if ($id_devol && isset($id_devol['id_devol'])) {
                    $devuelto = $this->detalleDevolucion->consultaCantidadDevuelta($id_devol['id_devol'], $detalle);
                    $detalle['cant_devue'] = $devuelto['devuelto'] ?? 0;
                }
                $detalles[] = $detalle;
                
                switch ($detalle['fk_categ']) {
                    case 1:
                        $objetos[] = $this->equipo->mostrar($detalle['fk_objeto_id']);
                        break;
                    case 2: 
                        $objetos[] = $this->material->mostrar($detalle['fk_objeto_id']);
                        break;
                    case 3:
                        $objetos[] = $this->mobiliario->mostrar($detalle['fk_objeto_id']);
                        break;
                }
            }

        }
        if (empty($detalles)) {
            header('Content-Type: application/json');
            echo json_encode([
                'mensaje' => 'No se encontraron préstamos pendientes de devolución para esta matrícula.'
            ]);
            exit;
        }
        header('Content-Type: application/json');
        echo json_encode([
            'objetos' => $objetos,
            'detalles' => $detalles
        ]);
        exit;
    }
    public function registrarDevolucion() {
        $fk_prest = $_POST['fk_prest'];
        $categorias = $_POST['categorias'];
        $objetos = $_POST['objetos'];
        $cantADevol = $_POST['cantDevol'];//cantidad a devolver
        $cantPrest = $_POST['cantPrest'];//cantidad prestada
        $fechas = $_POST['fechaDevol'];

        for ($i = 0; $i < count($objetos); $i++) {
            $datos = [
                'fk_prest' => $fk_prest[$i],
                'fk_categ' => $categorias[$i],
                'fk_objeto_id' => $objetos[$i],
                'cantADevol' => $cantADevol[$i], //cantidad a devolver
                'cantPrest' => $cantPrest[$i], //cantidad prestada
                'observacion' => $_POST['observacion'],
                'fecha' => $fechas[$i],
                'fk_devol' => 0
            ];
            $id_devol = $this->devolucion->compruebaDevolucion($datos['fk_prest']);

            if($id_devol && isset($id_devol['id_devol'])) {
                $cant_devol = $this->detalleDevolucion->consultaCantidadDevuelta($id_devol['id_devol'], $datos);
                $cantDevuelta = (int)($cant_devol['devuelto'] ?? 0);
                $suma = $cantDevuelta + $datos['cantADevol'];

                if ($suma > $datos['cantPrest']) {
                    http_response_code(400);
                    header('Content-Type: application/json');
                    echo json_encode([
                        'error' => 'La cantidad a devolver es mayor a la prestada.'
                    ]);
                    exit;
                }
                $datos['fk_devol'] = $id_devol['id_devol'];
                $this->detalleDevolucion->insertar($datos);
                $this->registrarDevolucionObjetos($datos);
                
                if ($suma == (int)($datos['cantPrest'])) {
                    $this->detallePrestamo->restaCantidadPrestada($datos, $suma);
                }
            } else {
                if ($datos['cantADevol'] > $datos['cantPrest']) {
                    http_response_code(400);
                    header('Content-Type: application/json');
                    echo json_encode([
                        'error' => 'La cantidad a devolver es mayor a la prestada.'
                    ]);
                    exit;
                }
                $this->devolucion->insertar($datos);//insertar una nueva devolucion
                $id_devol = $this->devolucion->ultimaDevolucion();
                $datos['fk_devol'] = (int)($id_devol['id_devol']);
                $this->detalleDevolucion->insertar($datos);
                $this->registrarDevolucionObjetos($datos);

                if ((int)($datos['cantADevol']) == (int)($datos['cantPrest'])) {
                    $total = (int)($datos['cantADevol']);
                    $this->detallePrestamo->restaCantidadPrestada($datos, $total);
                }
            }
        }
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true, 
            'mensaje' => 'Devolución registrada con éxito.'
        ]); 
        exit;    
    }
    public function registrarDevolucionObjetos($datos) {
        switch ($datos['fk_categ']) {
            case 1: 
                $this->equipo->sumaCantidadId($datos['cantADevol'], $datos['fk_objeto_id']);
                break;
            case 2: 
                $this->material->sumaCantidadId($datos['cantADevol'], $datos['fk_objeto_id']);
                break;
            case 3: 
                $this->mobiliario->sumaCantidadId($datos['cantADevol'], $datos['fk_objeto_id']);
                break;
        }
    }
}