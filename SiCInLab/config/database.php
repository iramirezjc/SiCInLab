<?php
namespace Config;

use mysqli;

class DataBase {
	protected $host = "localhost";
	protected $username = "root";
	protected $password = "";
	protected $database = "lab";
	protected $mysql;

	public function __construct() {
		$this->setConexion();
	}

	public function setConexion() {
		$this->mysql = new mysqli($this->host, $this->username, $this->password, $this->database);

		// Si ha ocurrido un error...
		if ($this->mysql->connect_error){
			die('Error de conexion...<br>'. $this->mysql->connect_error);
		}
	}

	public function getConexion() {
		return $this->mysql;
	}
}