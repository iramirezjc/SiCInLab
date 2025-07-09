<?php
namespace App\Models;

use Core\Model;

class Equipo extends Model {

    public function listar() {
        $sql = "SELECT * FROM equip";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function insertar($datos) {
        $equipo = $this->satinizar($datos);
        $sql = "INSERT INTO equip 
                (nombr_equip, canti_equip, descr, tipo) 
                VALUES (
                    '{$equipo['nombre']}',      {$equipo['cantidad']}, 
                    '{$equipo['descripcion']}', '{$equipo['tipo']}'
                )";

        return $this->db->query($sql);
    }
    public function actualizar($datos, $idEquipo) {
        $equipo = $this->satinizar($datos);
        $sql= "UPDATE equip 
                SET nombr_equip = '{$equipo['nombre']}', 
                    canti_equip = {$equipo['cantidad']}, 
                    descr = '{$equipo['descripcion']}', 
                    tipo = '{$equipo['tipo']}' 
                WHERE id_equip = $idEquipo";

        return $this->db->query($sql);
    }
    public function mostrar($idEquipo) {
        $id_equip = (int) $idEquipo;
        $sql = "SELECT * FROM equip WHERE id_equip = $id_equip";
        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }
    public function eliminar($idEquipo) {
        $id_equip = (int) $idEquipo;
        $sql= "DELETE FROM equip WHERE id_equip= $id_equip";

        return  $this->db->query($sql);
    }
    public function buscar($nombre) {
        $nombr_equip = $this->db->real_escape_string($nombre);
        $sql = "SELECT * FROM equip WHERE nombr_equip LIKE '%$nombr_equip%'";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function sumaCantidadId($cantidad, $idEquipo) {
        $canti_equip = (int) $cantidad;
        $sql = "UPDATE equip 
                SET canti_equip = canti_equip + '$canti_equip' 
                WHERE id_equip = '$idEquipo'";
        
        return $this->db->query($sql);
    }
    public function restaCantidadId($idEquipo, $cantidad) {
        $cant = (int) $cantidad;
        $sql = "UPDATE equip 
                SET canti_equip = canti_equip - '$cant' 
                WHERE id_equip = '$idEquipo'";
        
        return $this->db->query($sql);
    }
    private function satinizar($datos) {
        return [
            'nombre' => $this->db->real_escape_string($datos['nombre']),
            'cantidad' => (int) $datos['cantidad'],
            'descripcion' => $this->db->real_escape_string($datos['descripcion']),
            'tipo' => $this->db->real_escape_string($datos['tipo']),
        ];
    }
}
