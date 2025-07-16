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
    public function listarPorDia($fecha) {
        $sql = "SELECT s.solicitante,
                       s.fk_matri,
                       h.hora_inicio,
                       h.id_horario,
                       h.fecha, 
                       h.asunt,
                       CASE h.estatus
                        WHEN 'R' THEN 'Reservado'
                        WHEN 'O' THEN 'Ocupado'
                        WHEN 'F' THEN 'Finalizado'
                        ELSE 'Desconocido'
                       END AS estado
                FROM solicitud s 
                INNER JOIN horario h ON s.id_solicitud = h.fk_solicitud
                WHERE h.fecha = STR_TO_DATE('$fecha', '%Y-%m-%d')
                    AND h.estatus != 'F'";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    private function sanitizar($datos) {
        return [
            'solicitante' => $datos['solicitante'],
            'usuario' => $datos['usuario'],
        ];
    }
}