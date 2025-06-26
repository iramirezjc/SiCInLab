<?php
namespace App\Models;

use Core\Model;

class DesgloseInventario extends Model {

    public function insertar($datos) {
        $desglose = $this->sanitizar($datos);
        $sql = "INSERT INTO desgl_inven 
                (canti_siste, canti_exist, fk_categ, fk_objeto_id, fk_inven)
                VALUES (
                    '{$desglose['canti_siste']}',
                    '{$desglose['canti_exist']}',
                    '{$desglose['fk_categ']}',
                    '{$desglose['fk_objeto_id']}',
                    '{$desglose['fk_inven']}'
                )";

        return $this->db->query($sql);
    }
    public function sanitizar($datos) {
        return [
            'fk_inven' => (int) $datos['fk_inven'],
            'fk_categ' => (int) $datos['idCategoria'],
            'fk_objeto_id' => (int) $datos['idObjeto'],
            'canti_siste' => (int) $datos['enSistema'],
            'canti_exist' => (int) $datos['existente'],
        ];
    }
}