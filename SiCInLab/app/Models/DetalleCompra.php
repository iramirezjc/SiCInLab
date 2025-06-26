<?php
namespace App\Models;

use Core\Model;

class DetalleCompra extends Model {
    
    public function insertar($datos) {
        $detalle_compra = $this->sanitizar($datos);
        $sql = "INSERT INTO detall_compr
                (cant,fk_compr,fk_categ,fk_objeto_id) 
                values (
                    '{$detalle_compra['cantidad']}',
                    '{$detalle_compra['fk_compr']}',
                    '{$detalle_compra['fk_categ']}',
                    '{$detalle_compra['fk_obj_id']}'
                )";
        
        return $this->db->query($sql);
    }

    private function sanitizar($datos) {
        return [
            'cantidad' => (int) $datos['cantidad'],
            'fk_compr' => (int) $datos['compra'],
            'fk_categ' => (int) $datos['categoria'],
            'fk_obj_id' => (int) $datos['opcion'],
        ];
    }
}