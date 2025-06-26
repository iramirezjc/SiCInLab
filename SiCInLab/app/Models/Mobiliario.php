<?php
namespace App\Models;

use Core\Model;

class Mobiliario extends Model {

    public function listar() {
        $sql = "SELECT * FROM mobil";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function mostrar($idMobiliario) {
        $id_mobil = (int) $idMobiliario;
        $sql = "SELECT * FROM mobil WHERE id_mobil = '$id_mobil'";
        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }
    public function insertar($datos) {
        $mobiliario = $this->sanitizar($datos);
        $sql = "INSERT INTO mobil
                (tipo, mater, nombr, canti) 
                VALUES (
                    '{$mobiliario['tipo']}','{$mobiliario['material']}',
                    '{$mobiliario['nombre']}','{$mobiliario['cantidad']}'
                )";
        
        return $this->db->query($sql);
    }
    public function actualizar($datos, $idMobiliario) {
        $mobiliario = $this->sanitizar($datos);
        $sql = "UPDATE mobil
                SET tipo = '{$mobiliario['tipo']}',
                    mater = '{$mobiliario['material']}',
                    nombr = '{$mobiliario['nombre']}',
                    canti = '{$mobiliario['cantidad']}'
                WHERE id_mobil = '$idMobiliario'";
        
        return $this->db->query($sql);
    }
    public function eliminar($idMobiliario) {
        $id_mobil = (int) $idMobiliario;
        $sql = "DELETE FROM mobil WHERE id_mobil = '$id_mobil'";

        return $this->db->query($sql);
    }
    public function buscar($nombre) {
        $nombr_mobi = $this->db->real_escape_string($nombre);
        $sql = "SELECT * FROM mobil WHERE nombr LIKE '%$nombr_mobi%';";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function sumaCantidadId($cantidad, $idMobiliario) {
        $canti = (int) $cantidad;
        $sql = "UPDATE mobil 
                SET canti = canti + '$canti' 
                WHERE id_mobil = '$idMobiliario'";
        
        return $this->db->query($sql);
    }
    private function sanitizar($datos) {
        return [
            'tipo' => $this->db->real_escape_string($datos['tipo']),
            'material' => $this->db->real_escape_string($datos['material']),
            'nombre' => $this->db->real_escape_string($datos['nombre']),
            'cantidad' => (int) $datos['cantidad'],
        ];
    }
}