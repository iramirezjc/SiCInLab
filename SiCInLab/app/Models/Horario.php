<?php
namespace App\Models;

use Core\Model;

class Horario extends Model {

    public function listar() {
        $sql = "SELECT * FROM horario";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function listarHorasReservadas($fecha) {
        $sql = "SELECT hora_inicio, hora_fin 
                FROM horario h 
                WHERE fecha = '$fecha'";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function insertar($datos) {
        $sql = "INSERT INTO horario
                (fecha, asunt, fk_solicitud, hora_inicio, hora_fin)
                VALUES(
                    '{$datos['fecha']}', 
                    '{$datos['asunto']}', 
                    '{$datos['id_solicitud']}', 
                    '{$datos['horaInicio']}', 
                    '{$datos['horaFin']}'
                );";

        return $this->db->query($sql);
    }
}