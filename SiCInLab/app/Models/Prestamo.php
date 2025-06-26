<?php
namespace App\Models;

use Core\Model;

class Prestamo extends Model {
    public function buscarMatricula($matricula) {
        $matri_solic = (int) $matricula;
        $sql = "SELECT * FROM prest WHERE matri_solic = '$matri_solic'";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}