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
            echo json_encode([
                'mensaje' => 'No se encontraron préstamos para esta matrícula.'
            ]);
            exit;
        }
        foreach ($prestamos as $prestamo) {
            $prestado = $this->detallePrestamo->consultaDetalleFk($prestamo['id_prest']);
            
            foreach ($prestado as $detalle) {
                $detalle['fk_obj'] = $detalle['fk_objeto_id'];
                $detalle['fk_devol'] = $detalle['fk_prest'];
                $detalle['cantDevol'] = $detalle['cant'];
                $devuelto = $this->detalleDevolucion->consultaCantidadDevuelta($detalle);
                $detalle['cantidad_devuelta'] = $devuelto['cantidad_devuelta'] ?? 0;
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
        header('Content-Type: application/json');
        echo json_encode([
            'objetos' => $objetos,
            'detalles' => $detalles
        ]);
    }
    public function registrarDevolucion() {
        $fk_prest = $_POST['fk_prest'];
        $categorias = $_POST['categorias'];
        $objetos = $_POST['objetos'];
        $cantDevol = $_POST['cantDevol'];//cantidad a devolver
        $cantPrest = $_POST['cantPrest'];//cantidad prestada
        $fechas = $_POST['fechaDevol'];

        for ($i = 0; $i < count($fk_prest); $i++) {
            $datos = [
                'fk_devol' => 0,
                'fk_prest' => $fk_prest[$i],
                'fk_categ' => $categorias[$i],
                'fk_obj' => $objetos[$i],
                'cantDevol' => $cantDevol[$i], //cantidad a devolver
                'cantPrest' => $cantPrest[$i], //cantidad prestada
                'observacion' => $_POST['observacion'],
                'fecha' => $fechas[$i],
            ];
            $id_devol = $this->devolucion->compruebaDevolucion($fk_prest[$i]);

            if(isset($id_devol)) {
                $datos['fk_devol'] = $id_devol['id_devol'];
                $cant_devol = $this->detalleDevolucion->consultaCantidadDevuelta($datos);
                $suma = (int)$cant_devol['cantidad_devuelta'] + $datos['cantDevol'];

                if ($suma > $datos['cantPrest']) {
                    http_response_code(400);
                    echo json_encode([
                        'error' => 'La cantidad a devolver es mayor a la prestada.'
                    ]);
                    exit;
                }
                $this->detalleDevolucion->insertar($datos);
                $this->registrarDevolucionObjetos($datos);

                if ($suma == $datos['cantPrest']) {
                    $this->detallePrestamo->restaCantidadPrestada($datos, $suma);
                }
            } else {
                if ($datos['cantDevol'] > $datos['cantPrest']) {
                    http_response_code(400);
                    echo json_encode([
                        'error' => 'La cantidad a devolver es mayor a la prestada.'
                    ]);
                    exit;
                }
                $this->devolucion->insertar($datos);//insertar una nueva devolucion
                $id_devol = $this->devolucion->ultimaDevolucion();
                $datos['fk_devol'] = $id_devol['id_devol'];
                $this->detalleDevolucion->insertar($datos);
                $this->registrarDevolucionObjetos($datos);

                if ($datos['cantDevol'] == $datos['cantPrest']) {
                    $this->detallePrestamo->restaCantidadPrestada($datos, $datos['cantDevol']);
                }
            }
        }
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true, 
            'mensaje' => 'Devolución registrada con éxito.'
        ]);       
    }
    public function registrarDevolucionObjetos($datos) {
        switch ($datos['fk_categ']) {
            case 1: 
                $this->equipo->sumaCantidadId($datos['cantDevol'], $datos['fk_obj']);
                break;
            case 2: 
                $this->material->sumaCantidadId($datos['cantDevol'], $datos['fk_obj']);
                break;
            case 3: 
                $this->mobiliario->sumaCantidadId($datos['cantDevol'], $datos['fk_obj']);
                break;
        }
    }
}