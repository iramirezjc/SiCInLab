<?php
namespace App\Models;

use Core\Model;

class PrestamoConsumible extends Model {

    public function insertar($datos) {
        $prest_consu = $this->sanitizar($datos);
        $sql = "INSERT INTO prest_consu 
                (fecha_entre, fk_matri, matri_solic) 
                VALUES ('{$prest_consu['fecha']}','{$prest_consu['usuario']}','{$prest_consu['solicita']}')";
        
        return $this->db->query($sql);
    }
    public function ultimoPrestamoConsumible() {
        $sql= "SELECT MAX(id_prest_consu) AS id_prest_consu FROM prest_consu";
        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }
    public function sanitizar($datos) {
        $fecha = $this->validarFecha($datos['entrega']) ? $this->db->real_escape_string($datos['entrega']) : date('Y-m-d');
        return [
            'fecha' => $fecha,
            'usuario' => (int) $datos['usuario'],
            'solicita' => (int) $datos['solicita'],
        ];
    }
    private function validarFecha($fecha) {
        return preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha);
    }
}