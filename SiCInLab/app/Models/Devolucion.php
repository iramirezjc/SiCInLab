<?php
namespace App\Models;

use Core\Model;

class Devolucion extends Model {

    public function insertar($datos) {
        $devolucion = $this->sanitizar($datos);
        $sql = "INSERT INTO devol
                (fecha_devol, obser_devol, fk_prest)
                VALUES ('{$devolucion['fecha']}', '{$devolucion['obser']}', '{$devolucion['fk_prest']}')";

        return $this->db->query($sql);
    }
    /**
     * $fkPrestamo clave foranea del prestamo relacionado con una devolucion previa
     */
    public function compruebaDevolucion($fkPrestamo) {
        $fk_prest = (int) $fkPrestamo;
        $sql = "SELECT id_devol FROM devol WHERE fk_prest = '$fk_prest'";
        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }
    public function ultimaDevolucion() {
        $sql = "SELECT MAX(id_devol) AS id_devol FROM devol";
        $result = $this->db->query($sql);
        
        return $result->fetch_assoc();
    }
    private function sanitizar($datos) {
        $fecha = $this->validarFecha($datos['fecha']) ? $this->db->real_escape_string($datos['fecha']) : date('Y-m-d');
        return [
            'fecha' => $fecha,
            'obser' => $this->db->real_escape_string($datos['observacion']),
            'fk_prest' => (int) $datos['fk_prest'],
        ];
    }
    private function validarFecha($fecha) {
        return preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha);
    }
}