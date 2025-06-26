<?php
namespace App\Models;

use Core\Model;

class Reactivo extends Model {

    public function listar() {
        $sql = "SELECT r.id_react,	r.nombr AS react_nombr, 
		            r.formu,		r.pelig_salud, 
		            r.pelig_infla,	r.pelig_ines, 
		            r.pelig_esp,	u.nombr AS unid_nombr,
                    r.cant
                FROM react AS r 
                INNER JOIN unids AS u ON r.fk_unids = u.id_unids";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function mostrar($idReactivo) {
        $id_react = (int) $idReactivo;
        $sql = "SELECT r.id_react,	r.nombr AS react_nombr, 
		            r.formu,		r.pelig_salud, 
		            r.pelig_infla,	r.pelig_ines, 
		            r.pelig_esp,	u.nombr AS unid_nombr,
                    r.cant
                FROM react AS r 
                INNER JOIN unids AS u ON r.fk_unids = u.id_unids
                WHERE r.id_react = '$id_react'";
        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }
    public function insertar($datos) {
        $reactivo = $this->sanitizar($datos);
        $sql = "INSERT INTO react 
                (nombr, formu, pelig_salud, pelig_infla, pelig_ines, pelig_esp, fk_unids, cant)
                VALUES (
                    '{$reactivo['nombr']}','{$reactivo['formu']}',
                    '{$reactivo['salud']}','{$reactivo['infla']}',
                    '{$reactivo['inest']}','{$reactivo['espec']}',
                    '{$reactivo['fk_unids']}','{$reactivo['canti']}'
                )";
        
        return $this->db->query($sql);
    }
    public function actualizar($datos, $idReactivo) {
        $reactivo = $this->sanitizar($datos);
        $sql = "UPDATE react 
                SET nombr= '{$reactivo['nombr']}', 
                    formu= '{$reactivo['formu']}', 
                    pelig_salud= '{$reactivo['salud']}', 
                    pelig_infla= '{$reactivo['infla']}', 
                    pelig_ines= '{$reactivo['inest']}', 
                    pelig_esp= '{$reactivo['espec']}', 
                    fk_unids= '{$reactivo['fk_unids']}', 
                    cant= '{$reactivo['canti']}' 
                WHERE id_react= '$idReactivo'";
                
        return $this->db->query($sql);
    }
    public function eliminar($idReactivo) {
        $id_react = (int) $idReactivo;
        $sql= "DELETE FROM react WHERE id_react= '$id_react'";

        return $this->db->query($sql);
    }
    public function buscar($nombre) {
        $nombr_react = $this->db->real_escape_string($nombre);
        $sql = "SELECT r.id_react,	r.nombr AS react_nombr, 
		            r.formu,		r.pelig_salud, 
		            r.pelig_infla,	r.pelig_ines, 
		            r.pelig_esp,	u.nombr AS unid_nombr,
                    r.cant
                FROM react AS r 
                INNER JOIN unids AS u ON r.fk_unids = u.id_unids
                WHERE r.nombr LIKE'%$nombr_react%'";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function sumaCantidadId($cantidad, $idReactivo) {
        $cant = (int) $cantidad;
        $sql = "UPDATE react 
                SET cant = cant + '$cant' 
                WHERE id_react = '$idReactivo'";
        
        return $this->db->query($sql);
    }
    public function restaCantidadId($idReactivo, $cantidad) {
        $cant = (int) $cantidad;
        $sql = "UPDATE react 
                SET cant = cant - '$cant' 
                WHERE id_react = '$idReactivo'";
        
        return $this->db->query($sql);
    }
    private function sanitizar($datos) {
        return [
            'nombr'=> $this->db->real_escape_string($datos['nombr']),
            'formu'=> $this->db->real_escape_string($datos['formu']),
            'salud'=> $this->db->real_escape_string($datos['salud']),
            'infla'=> $this->db->real_escape_string($datos['infla']),
            'inest'=> $this->db->real_escape_string($datos['inest']),
            'espec'=> $this->db->real_escape_string($datos['espec']),
            'fk_unids'=> (int) $datos['fk_unids'],
            'canti'=> (int) $datos['canti'],
        ];
    }
}