<?php
namespace App\Models;

use Core\Model;

class NivelUsuario extends Model {

    public function listar() {
        $sql = "SELECT * FROM nivel_usuar";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}