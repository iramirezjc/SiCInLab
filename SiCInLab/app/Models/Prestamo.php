<?php
namespace App\Models;

use Core\Model;

class Prestamo extends Model {

    public function insertar($datos) {
        $prest_consu = $this->sanitizar($datos);
        $sql = "INSERT INTO prest
                (fk_usuar_matri, matri_solic, fecha_entre, fecha_devol) 
                VALUES (
                    '{$prest_consu['usuario']}',
                    '{$prest_consu['solicita']}',
                    '{$prest_consu['entrega']}',
                    '{$prest_consu['devolucion']}'
                )";
        
        return $this->db->query($sql);
    }
    public function ultimoPrestamo() {
        $sql= "SELECT MAX(id_prest) AS id_prest FROM prest";
        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }
    public function buscarMatricula($matricula) {
        $matri_solic = (int) $matricula;
        $sql = "SELECT * FROM prest WHERE matri_solic = '$matri_solic'";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    private function sanitizar($datos) {
        $fechaEntrega = $this->validarFecha($datos['entrega']) ? $this->db->real_escape_string($datos['entrega']) : date('Y-m-d');
        $fechaDevolucion = $this->validarFecha($datos['devolucion']) ? $this->db->real_escape_string($datos['devolucion']) : date('Y-m-d');
        return [
            'entrega' => $fechaEntrega,
            'usuario' => (int) $datos['usuario'],
            'solicita' => (int) $datos['solicita'],
            'devolucion' => $fechaDevolucion,
        ];
    }
    private function validarFecha($fecha) {
        return preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha);
    }
}