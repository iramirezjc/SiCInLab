<?php
namespace App\Models;

use Core\Model;

class DetalleDevolucion extends Model {

    public function insertar($datos) {
        $detall_devol = $this->sanitizar($datos);
        $sql = "INSERT INTO detall_devol
                (fk_devol, fk_categ, fk_objeto_id, cant)
                VALUES (
                    {$detall_devol['fk_devol']}, 
                    {$detall_devol['fk_categ']}, 
                    {$detall_devol['fk_obj']}, 
                    {$detall_devol['cant']}
                )";
        
        return $this->db->query($sql);
    }
    public function consultaCantidadDevuelta($idDevolucion, $datos) {
        $sql = "SELECT SUM(cant) AS devuelto
                FROM detall_devol 
                WHERE fk_devol = $idDevolucion
                    AND fk_objeto_id = {$datos['fk_objeto_id']}
                    AND fk_categ = {$datos['fk_categ']}";
        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }
    private function sanitizar($datos) {
        return [
            'fk_devol' => (int) $datos['fk_devol'],
            'fk_categ' => (int) $datos['fk_categ'],
            'fk_obj' => (int) $datos['fk_objeto_id'],
            'cant' => (int) $datos['cantADevol'],
        ];
    }
}