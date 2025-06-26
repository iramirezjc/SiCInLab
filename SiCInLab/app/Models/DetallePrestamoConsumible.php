<?php
namespace App\Models;

use Core\Model;

class DetallePrestamoConsumible extends Model {

    public function insertar($datos) {
        $consumible = $this->sanitizar($datos);
        $sql = "INSERT INTO detall_prest_consu 
                (fk_prest_consu, fk_react, cant)
                VALUES (
                    '{$consumible['fk_prest_consu']}', 
                    '{$consumible['fk_react']}', 
                    '{$consumible['cant']}'
                )";

        return $this->db->query($sql);
    }
    private function sanitizar($datos) {
        return [
            'fk_prest_consu' => (int) $datos['id_prest_consu'],   
            'fk_react' => (int) $datos['reactivo'],
            'cant' => (int) $datos['cantidad'],
        ];
    }
}