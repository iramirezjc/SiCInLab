<?php
namespace App\Models;

use Core\Model;

class DetallePrestamo extends Model {

    public function insertar($datos) {
        $prestamo = $this->sanitizar($datos);
        $sql = "INSERT INTO detall_prest(fk_prest, fk_categ, fk_objeto_id, cant)
                VALUES (
                    '{$prestamo['fk_prest']}',
                    '{$prestamo['fk_categ']}',
                    '{$prestamo['fk_objeto_id']}',
                    '{$prestamo['cant']}'
                )";
                
        return $this->db->query($sql);
    }
    public function consultaDetalleFk($idPrestamo) {
        $fk_prest = (int) $idPrestamo;
        $sql = "SELECT dp.fk_prest, dp.fk_categ, c.nombr, dp.fk_objeto_id, dp.cant
                FROM detall_prest AS dp
                INNER JOIN categ AS c ON dp.fk_categ = c.id_categ 
                WHERE dp.fk_prest = '$fk_prest'
                    AND dp.cant > 0";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function restaCantidadPrestada($datos, $suma) {
        $cantidad = (int) $suma;
        $detalle = $this->sanitizar($datos);
        $sql = "UPDATE detall_prest 
                SET cant = cant- '$cantidad'
                WHERE fk_objeto_id = '{$detalle['fk_objeto_id']}'
                    AND fk_prest = '{$detalle['fk_prest']}'
                    AND fk_categ = '{$detalle['fk_categ']}'";

        return $this->db->query($sql);
    }
    private function sanitizar($datos) {
        return [
            'fk_objeto_id' => (int) $datos['fk_obj'],
            'fk_prest' => (int) $datos['fk_prest'],
            'fk_categ' => (int) $datos['fk_categ'],
            'cant' => (int) $datos['cant']
        ];
    }
}