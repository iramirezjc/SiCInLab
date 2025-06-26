<?php
namespace App\Models;

use Core\Model;

class Material extends Model{

    public function listar() {
        $sql= "SELECT m.id_mater,
                      m.nombr AS mat_nombr, 
                      m.canti, 
                      m.marca, 
                      m.capac, 
                      u.nombr AS unid_nombr
                FROM mater AS m
                INNER JOIN unids AS u ON m.fk_unids = u.id_unids";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function mostrar($idMaterial) {
        $id_mater = (int) $idMaterial;
        $sql= "SELECT m.id_mater,
                      m.nombr AS mat_nombr, 
                      m.canti, 
                      m.marca, 
                      m.capac, 
                      u.nombr AS unid_nombr
                FROM mater AS m
                INNER JOIN unids AS u ON m.fk_unids = u.id_unids
                WHERE m.id_mater = '$id_mater'";
        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }
    public function insertar($datos) {
        $material = $this->sanitizar($datos);
        $sql = "INSERT INTO mater 
                (nombr, capac, canti, marca, fk_unids) 
                VALUES (
                    '{$material['nombre']}', '{$material['capacidad']}', 
                    '{$material['cantidad']}', '{$material['marca']}', 
                    '{$material['unidad']}'
                )";

        return $this->db->query($sql);
    }
    public function actualizar($datos, $idMaterial) {
        $material = $this->sanitizar($datos);
        $sql = "UPDATE mater
                SET nombr = '{$material['nombre']}', 
                    capac = '{$material['capacidad']}', 
                    canti = '{$material['cantidad']}', 
                    marca = '{$material['marca']}', 
                    fk_unids = '{$material['unidad']}'
                WHERE id_mater = '$idMaterial'";

        return $this->db->query($sql);
    }
    public function eliminar($idMaterial) {
        $id_mater = (int) $idMaterial;
        $sql= "DELETE FROM mater WHERE id_mater= '$id_mater'";

        return $this->db->query($sql);
    }
    public function buscar($nombre) {
        $nombr_mater = $this->db->real_escape_string($nombre);
        $sql = "SELECT m.nombr AS mat_nombr, 
                       m.canti, 
                       m.marca, 
                       m.capac, 
                       u.nombr AS unid_nombr
                FROM mater AS m
                INNER JOIN unids AS u ON m.fk_unids = u.id_unids 
                WHERE m.nombr LIKE '%$nombr_mater%'";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function sumaCantidadId($cantidad, $idMaterial) {
        $canti = (int) $cantidad;
        $sql = "UPDATE mater 
                SET canti = canti + '$canti' 
                WHERE id_mater = '$idMaterial'";
        
        return $this->db->query($sql);
    }
    private function sanitizar($datos) {
        return [
            'nombre' => $this->db->real_escape_string($datos['nombre']),
            'capacidad' => (int) $datos['capacidad'],
            'cantidad' => (int) $datos['cantidad'],
            'marca' => $this->db->real_escape_string($datos['marca']),
            'unidad' => (int) $datos['unidad'],
        ];
    }
}