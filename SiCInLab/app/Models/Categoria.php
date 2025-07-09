<?php
namespace App\Models;

use Core\Model;

class Categoria extends Model {

    public function listar() {
        $sql= "SELECT * FROM categ";
        $resutl = $this->db->query($sql);

        return $resutl->fetch_all(MYSQLI_ASSOC);
    }
    public function listarParaPrestamo() {
        $sql= "SELECT * FROM categ WHERE nombr != 'Reactivos'";
        $resutl = $this->db->query($sql);

        return $resutl->fetch_all(MYSQLI_ASSOC);
    }
}