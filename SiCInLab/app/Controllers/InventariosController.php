<?php
namespace App\Controllers;

use App\Models\Categoria;
use App\Models\DesgloseInventario;
use App\Models\Equipo;
use App\Models\Inventario;
use App\Models\Material;
use App\Models\Mobiliario;
use App\Models\Reactivo;
use Core\Controller;
use Core\ReporteBase;

class InventariosController extends Controller {
    private $inventario;
    private $desgloseInventario;
    private $categoria;
    private $equipo;
    private $material;
    private $mobiliario;
    private $reactivo;
    private $pdf;

    public function __construct() {
        parent::__construct(true);
        $this->inventario = new Inventario();
        $this->desgloseInventario = new DesgloseInventario();
        $this->categoria = new Categoria(); 
        $this->equipo = new Equipo();
        $this->material = new Material();
        $this->mobiliario = new Mobiliario();
        $this->reactivo = new Reactivo(); 
        $this->pdf = new ReporteBase();
    }
    public function index() {
        $this->render('inventarios/index');
    }
    public function registroInventario() {
        $datos = [
            'fecha' => date("Y-m-d"),//'2019-10-25',//date("Y-m-d"),
            'fk_usuar_matri' => '5681', //USAR MATRICULA DE SESION
        ];
        $inventario = $this->inventario->inventarioRealizado($datos);
        
        if ($inventario['realizado'] > 0) {
            echo json_encode([
                'realizado' => $inventario['realizado'],
                'mensaje' => 'Ya se ha realizado el inventario de este mes.',
            ]);
            exit;
        }
        $this->inventario->insertar($datos);
        $categorias = $this->categoria->listar();

        $objetos = [
            'equipos' => $this->equipo->listar(),
            'materiales' => $this->material->listar(),
            'mobiliarios' => $this->mobiliario->listar(),
            'reactivos' => $this->reactivo->listar(),
        ];

        header('Content-Type: application/json');
        echo json_encode([
            'objetos' => $objetos,
            'categorias' => $categorias
        ]);
    }
    public function reporteInventario() {
        $detallesJSON = $_POST['detalle'] ?? '[]';
        $detalles = json_decode($detallesJSON, true);
        $numeros = $detalles['numero'];
        $categorias = $detalles['categoria'];
        $objetos = $detalles['nombreObjeto'];
        $enSistema = $detalles['enSistema'];

        $margen = (210 - 172) / 2; //para centrar la informacion
        
        $this->pdf->setDatosCabecera('Reporte de Inventario','5681', date('Y-m-d'));
        $this->pdf->AliasNbPages(); // Para que funcione {nb}
        $this->pdf->AddPage();      // MUY IMPORTANTE

        //encabezado de la tabla
        $this->pdf->SetFont('Arial','B',10); // Fuente del encabezado
        $this->pdf->SetX($margen);
        $this->pdf->Cell(15, 7, 'No.', 1, 0, 'C');
        $this->pdf->Cell(30, 7, mb_convert_encoding('Categoría', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $this->pdf->Cell(78, 7, mb_convert_encoding('Nombre', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $this->pdf->Cell(25, 7, mb_convert_encoding('Sistema', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $this->pdf->Cell(25, 7, mb_convert_encoding('Existente', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C');// el 1 habilita el salto de linea
        //cuerpo de la tabla
        $this->pdf->SetFont('Arial', '', 9);
        for ($i = 0; $i < count($numeros); $i++) {
            $datos = [
                'numero' => $numeros[$i],
                'categoria' => $categorias[$i],
                'nombreObjeto' => $objetos[$i],
                'enSistema' => $enSistema[$i],
            ];
            $this->pdf->SetX($margen);
            $this->pdf->Cell(15, 6, $datos['numero'], 'LR', 0, 'C');
            $this->pdf->Cell(30, 6, mb_convert_encoding($datos['categoria'], 'ISO-8859-1', 'UTF-8'), 'LR', 0, 'C');
            $this->pdf->Cell(78, 6, mb_convert_encoding($datos['nombreObjeto'], 'ISO-8859-1', 'UTF-8'), 'LR', 0, 'C');
            $this->pdf->Cell(25, 6, $datos['enSistema'], 'LR', 0, 'C');
            $this->pdf->Cell(25, 6, '', 'LR', 1, 'C');
        }
        if (ob_get_length()) ob_end_clean();

        $this->pdf->Output('D', 'REPORTEINVENTARIO_' . date('Ymd') . '.pdf'); //fin del documento
    }
    public function guardarDesgloseInventario() {
        $filas = $_POST['numero'];
        $categorias = $_POST['idCategoria'];
        $objetos = $_POST['idObjeto'];
        $enSistema = $_POST['enSistema'];
        $existentes = $_POST['existente'];
        $fk_inven = $this->inventario->ultimoInventario();

        for ($i = 0; $i < count($filas); $i++) {
            $datos = [
                'fk_inven' => $fk_inven['ultimo'],
                'idCategoria' => $categorias[$i],
                'idObjeto' => $objetos[$i],
                'enSistema' => $enSistema[$i],
                'existente' => $existentes[$i],
            ];
            $this->desgloseInventario->insertar($datos);
        }
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true, 
            'mensaje' => 'Inventario registrado con exito.'
        ]);
    }
    public function reporteDesgloseInventario() {
        $detallesJSON = $_POST['detalle'] ?? '[]';
        $detalles = json_decode($detallesJSON, true);
        $numeros = $detalles['numero'];
        $categorias = $detalles['categoria'];
        $objetos = $detalles['nombreObjeto'];
        $enSistema = $detalles['enSistema'];
        $existentes = $detalles['existente'];
        $diferencias = $detalles['diferencia'];

        $margen = (210 - 172) / 2; //para centrar la informacion
        
        $this->pdf->setDatosCabecera('Reporte de Inventario','5681', date('Y-m-d'));
        $this->pdf->AliasNbPages(); // Para que funcione {nb}
        $this->pdf->AddPage();      // MUY IMPORTANTE

        //encabezado de la tabla
        $this->pdf->SetFont('Arial','B',10); // Fuente del encabezado
        $this->pdf->SetX($margen);
        $this->pdf->Cell(10, 7, 'No.', 1, 0, 'C');
        $this->pdf->Cell(25, 7, mb_convert_encoding('Categoría', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $this->pdf->Cell(75, 7, mb_convert_encoding('Nombre', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $this->pdf->Cell(20, 7, mb_convert_encoding('Sistema', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $this->pdf->Cell(20, 7, mb_convert_encoding('Existente', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $this->pdf->Cell(20, 7, mb_convert_encoding('Diferencia', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C');// el 1 habilita el salto de linea
        //cuerpo de la tabla
        $this->pdf->SetFont('Arial', '', 9);
        for ($i = 0; $i < count($numeros); $i++) {
            $datos = [
                'numero' => $numeros[$i],
                'categoria' => $categorias[$i],
                'nombreObjeto' => $objetos[$i],
                'enSistema' => $enSistema[$i],
                'existente' => $existentes[$i],
                'diferencia' => $diferencias[$i],
            ];
            $this->pdf->SetX($margen);
            $this->pdf->Cell(10, 6, $datos['numero'], 'LR', 0, 'C');
            $this->pdf->Cell(25, 6, mb_convert_encoding($datos['categoria'], 'ISO-8859-1', 'UTF-8'), 'LR', 0, 'C');
            $this->pdf->Cell(75, 6, mb_convert_encoding($datos['nombreObjeto'], 'ISO-8859-1', 'UTF-8'), 'LR', 0, 'C');
            $this->pdf->Cell(20, 6, $datos['enSistema'], 'LR', 0, 'C');
            $this->pdf->Cell(20, 6, $datos['existente'], 'LR', 0, 'C');
            $this->pdf->Cell(20, 6, $datos['diferencia'], 'LR', 1, 'C');
        }
        if (ob_get_length()) ob_end_clean();

        $this->pdf->Output('D', 'REPORTEDESGLOSEINVENTARIO_' . date('Ymd') . '.pdf');
    }
}