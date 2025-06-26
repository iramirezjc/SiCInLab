<?php
namespace Core;

use FPDF;

class ReporteBase extends FPDF {
    private $usuario;
    private $fecha;
    private $tituloDoc;

    public function __construct() {
        parent::__construct();      
    }
    public function setDatosCabecera($tituloDoc, $usuario, $fecha) {
        $this->usuario = $usuario;
        $this->fecha = $fecha;
        $this->tituloDoc = $tituloDoc;
    }
    // Cabecera de página
    public function Header() {
        $this->image(realpath(IMGS_PATH.'logo_pdf.png'), 10, 3, 33);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(60);
        $this->Cell(80, 8, mb_convert_encoding( $this->tituloDoc , 'ISO-8859-1', 'UTF-8'), 1, 1, 'C');
        $this->Ln(20);
          //-----------------datos----------------
        // Establecer posición desde el margen derecho
        $this->SetFont('Arial', 'B', 10);
        $this->SetY(15); // Ajusta si es necesario
        $this->SetX(-67); // 70 mm desde el borde derecho
        $this->Cell(40, 10, 'Usuario: '. $this->usuario, 0, 0, 'R');
        $this->Ln(5);
        $this->SetX(-60); // Volver a alinear a la derecha
        $this->Cell(40,10, 'Fecha: '. $this->fecha, 0, 0, 'R');
        $this->Ln(10);
    }
    // Pie de página
    public function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10, mb_convert_encoding('Página '.$this->PageNo().'/{nb}', 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
    }

}


