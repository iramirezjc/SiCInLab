<?php
namespace App\Models;

use Core\Model;

class Incidencia extends Model {

    public function insertar($datos) {
        $incidencia = $this->sanitizar($datos);
        $sql = "INSERT INTO incid(fecha_incid, descr, fk_matri) 
                VALUES ('{$incidencia['fecha']}','{$incidencia['descripcion']}','{$incidencia['matricula']}')";

        return $this->db->query($sql);
    }
    private function sanitizar($datos) {
        $fecha = $this->validarFecha($datos['fecha']) ? $this->db->real_escape_string($datos['fecha']) : date('Y-m-d');
        return [
            'fecha' => $fecha,
            'descripcion' => $this->db->real_escape_string($datos['descripcion']),
            'matricula' => (int) $datos['matricula'],
        ];
    }
    private function validarFecha($fecha) {
        return preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha);
    }
}