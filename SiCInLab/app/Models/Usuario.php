<?php
namespace App\Models;

use Core\Model;

class Usuario extends Model {

    public function listar() {
        $sql = "SELECT * FROM usuar 
                INNER JOIN nivel_usuar ON fk_nivel_usuar = id_nivel_usuar";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function insertar($datos) {
        $usuario = $this->sanitizar($datos);
        $sql = "INSERT INTO usuar
                (id_matri, nombr, apell, contr, fecha_nacim, num_tel, fk_nivel_usuar, user_name)
                VALUES(
                    {$usuario['id_matri']},
                    '{$usuario['nombr']}',
                    '{$usuario['apell']}',
                    '{$usuario['contr']}',
                    '{$usuario['fecha_nacim']}',
                    '{$usuario['num_tel']}',
                    {$usuario['fk_nivel_usuar']},
                    '{$usuario['user_name']}'
                );";

        return $this->db->query($sql);
    }
    public function mostrar($matricula) {
        $sql = "SELECT * FROM usuar 
                INNER JOIN nivel_usuar ON fk_nivel_usuar = id_nivel_usuar
                WHERE id_matri = $matricula";
        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }
    public function actualizar($datos, $matricula) {
        $usuario = $this->sanitizar($datos);
        $sql = "UPDATE usuar 
                SET nombr = '{$usuario['nombr']}',
                    apell = '{$usuario['apell']}',
                    contr = '{$usuario['contr']}', 
                    fecha_nacim = '{$usuario['fecha_nacim']}', 
                    num_tel = '{$usuario['num_tel']}', 
                    fk_nivel_usuar = {$usuario['fk_nivel_usuar']}, 
                    user_name = '{$usuario['user_name']}' 
                WHERE id_matri = $matricula";
        
        return $this->db->query($sql);
    }
    public function eliminar($matricula) {
        $sql = "DELETE FROM usuar WHERE id_matri = $matricula";

        return $this->db->query($sql);
    }
    public function buscar($valorBusqueda) {
        $sql = "SELECT * FROM usuar 
                INNER JOIN nivel_usuar ON fk_nivel_usuar = id_nivel_usuar
                WHERE CAST(id_matri AS CHAR) like '%$valorBusqueda%' 
                    OR nombr LIKE '%$valorBusqueda%' 
                    OR apell LIKE '%$valorBusqueda%' 
                    OR user_name LIKE '%$valorBusqueda%'";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function actualizaContrasenia($claveNueva, $matricula) {
        $id_matri = (int) $matricula;
        $sql = "UPDATE usuar
                SET contr = '$claveNueva'
                WHERE id_matri = $id_matri";

        return $this->db->query($sql);
    }
    private function sanitizar($datos) {
        $fecha = $this->validarFecha($datos['fechUsuario']) ? $this->db->real_escape_string($datos['fechUsuario']) : date('Y-m-d');
        return [
            'fk_nivel_usuar' => (int)$datos['nivelUsario'],
            'nombr' =>  $this->db->real_escape_string($datos['nomUsuario']),
            'apell' => $this->db->real_escape_string($datos['apeUsuario']),
            'id_matri' => (int)$datos['matUsuario'],
            'num_tel' => $this->db->real_escape_string($datos['TelUsuario']),
            'fecha_nacim'=> $fecha,
            'user_name' => $this->db->real_escape_string($datos['usuarioNom']),
            'contr' => $this->db->real_escape_string($datos['claveUsuario']),
        ];
    }
    private function validarFecha($fecha) {
        return preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha);
    }
}