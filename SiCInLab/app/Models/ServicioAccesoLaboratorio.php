<?php
namespace App\Models;

use Core\Model;

class ServicioAccesoLaboratorio extends Model {
    
    public function insertar($datos) {
        $acceso = $this->sanitizar($datos);
        $sql = "INSERT INTO sicinlab.servi_acces_labor
                (fecha, asunto, fecha_apart, fk_usuar_matri, matric_solic)
                VALUES(
                    '{$acceso['fecha']}', 
                    '{$acceso['asunto']}', 
                    '{$acceso['fecha']}', 
                    {$acceso['autoriza']}, 
                    {$acceso['solicitante']}
                );";
        
        return $this->db->query($sql);
    }
    private function sanitizar($datos) {
        return [
            'fecha' => $datos['fecha'],
            'asunto' => $this->db->real_escape_string($datos['asunto']),
            'fecha' => $datos['fecha'],
            'autoriza' => (int) $datos['autoriza'],
            'solicitante' => (int) $datos['solicitante']
        ];
    }
}