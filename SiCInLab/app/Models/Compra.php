<?php
namespace App\Models;

use Core\Model;

class Compra extends Model {

    public function insertar($datos) {
        $compra = $this->sanitizar($datos);
        $sql = "INSERT INTO compr
                (fk_usuar_matri, fecha, vendr, monto) 
                values (
                    '{$compra['matricula']}', NOW(),
                    '{$compra['vendedor']}', '{$compra['monto']}'
                )";

        return $this->db->query($sql);
    }
    public function ultimaCompra() {
        $sql="SELECT MAX(id_compr) AS id_compr FROM compr";
        $resutl = $this->db->query($sql);

        return $resutl->fetch_assoc();
    }
    private function sanitizar($datos) {
        return [
            'matricula' => (int) $datos['matricula'],
            'vendedor' => $this->db->real_escape_string($datos['vendedor']),
            'monto' => (float) $datos['monto'],
        ];
    }
}