<?php
namespace Core;

use Config\DataBase;

class Model {
    protected $db;

    public function __construct(){
        $conexion = new DataBase();
        $this->db = $conexion->getConexion(); 
    }
}