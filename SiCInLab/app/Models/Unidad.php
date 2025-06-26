<?php
namespace App\Models;

use Core\Model;

class Unidad extends Model {

    public function listar() {
        $sql = "SELECT * FROM unids";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}