<?php
namespace App\Models;

use Core\Model;

class Inventario extends Model {

    public function insertar($datos) {
        $inventario = $this->sanitizar($datos);
        $sql = "INSERT INTO inven
                (fecha, fk_usuar_matri)
                VALUES('{$inventario['fecha']}','{$inventario['fk_usuar_matri']}')";

        return $this->db->query($sql);
    }
    public function inventarioRealizado($datos) {
        $inven_mes = $this->sanitizar($datos);
        $sql = "SELECT COUNT(*) AS realizado FROM inven 
                WHERE MONTH(fecha) = MONTH('{$inven_mes['fecha']}')
                AND YEAR(fecha) = YEAR('{$inven_mes['fecha']}')";
        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }
    public function ultimoInventario() {
        $sql = "SELECT MAX(id_inven) AS ultimo FROM inven";
        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }
    public function sanitizar($datos) {
        $fecha = $this->validarFecha($datos['fecha']) ? $this->db->real_escape_string($datos['fecha']) : date('Y-m-d');
        return [
            'fecha' => $fecha,
            'fk_usuar_matri' => (int) $datos['fk_usuar_matri'],
        ];
    }
    private function validarFecha($fecha) {
        return preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha);
    }
}