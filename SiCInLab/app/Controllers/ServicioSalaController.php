<?php
namespace App\Controllers;

use Core\Controller;

class ServicioSalaController extends Controller {

    public function solicitud() {
        $this->render('servicio-sala/solicitud');
    }
    public function registrarSolicitud() {
        return $this->redirect('servicio-sala/reservacion');
    }
    public function reservacion() {
        $this->render('servicio-sala/reservacion');
    }
}