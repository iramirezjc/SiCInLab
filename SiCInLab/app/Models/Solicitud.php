<?php
namespace App\Models;

use core\Model;

class Solicitud extends Model {

    public function compruebaSolicitud($matricula) {
        $sql = "SELECT id_solicitud FROM solicitud
                WHERE solicitante = '$matricula'";
        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }
    public function insertar($datos) {
        $solicitud = $this->sanitizar($datos);
        $sql = "INSERT INTO solicitud 
                (solicitante, fk_matri) 
                VALUES ('{$solicitud['solicitante']}', '{$solicitud['usuario']}')";

        return $this->db->query($sql);
    }
    public function sanitizar($datos) {
        return [
            'solicitante' => $datos['solicitante'],
            'usuario' => $datos['usuario'],
        ];
    }
}