<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\Horario;
use App\Models\Solicitud;
use DateInterval;
use DatePeriod;
use DateTime;

class ServicioSalaController extends Controller {
    private $horarios;
    private $solicitudes;

    public function __construct() {
        parent::__construct(true);
        $this->horarios = new Horario();
        $this->solicitudes = new Solicitud();        
    }
    public function reservaciones() {
        $this->render('servicio-sala/reservacion');
    }
    public function listaReservaciones() {
        $reservaciones = $this->horarios->listar();
        $eventos = [];

        foreach ($reservaciones as $reservacion) {
            $eventos[] = [
                'title' => $reservacion['asunt'],
                'start' => $reservacion['fecha'] . 'T' . $reservacion['hora_inicio'],
                'end'   => $reservacion['fecha'] . 'T' . $reservacion['hora_fin']
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($eventos);        
    }
    public function horasDisponibles() {
        $diaElegido = $_GET['dia'];
        $horasOcupadas = $this->horarios->listarHorasReservadas($diaElegido);

        $entrada = new DateTime('08:00');
        $salida = new DateTime('20:00');
        $intervalo = new DateInterval('PT60M'); // Intervalo de 60 minutos
        $periodo = new DatePeriod($entrada, $intervalo, $salida);
        $horasDisponibles = [];

        foreach ($periodo as $hora) {
            $ocupada = false;

            foreach ($horasOcupadas as $reservada) {
                $hora = new DateTime($hora->format('H:i:s'));
                $inicioReserva = new DateTime($reservada['hora_inicio']);
                $finReserva = new DateTime($reservada['hora_fin']);

                if($hora >= $inicioReserva && $hora < $finReserva) {
                    $ocupada = true;
                    break;
                }   
            }
            if(!$ocupada) {
                $horasDisponibles[] = $hora->format('h:i A');
            }
        }
        header('Content-Type: application/json');
        echo json_encode([
            'horasDisponibles' => $horasDisponibles,
        ]);
    }
    public function registrarReservacion() {
        $datos = [
            'usuario' => $_POST['fk_matri'],
            'solicitante' => $_POST['solicitante'],
            'fecha' => $_POST['fecha'],
            'asunto' => $_POST['asunto'],
            'horaInicio' => $this->convertirHoraA24($_POST['horaEntrada']),
            'horaFin' => $this->convertirHoraA24($_POST['horaSalida']),
            'id_solicitud' => 0,
        ];
        if($this->horarioInvalido($datos['horaInicio'], $datos['horaFin'])) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'mensaje' => 'El horario debe estar entre 08:00 y 20:00.'
            ]);
            return;
        }
        $revision = $this->revisarIntervaloHorario($datos['fecha'], $datos['horaInicio'], $datos['horaFin']);
        if ($revision) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'mensaje' => 'El horario seleccionado se cruza con otra reservación.'
            ]);
            return;
        }

        $existeSolicitud = $this->solicitudes->compruebaSolicitud($datos['solicitante']);

        if(!isset($existeSolicitud)) {
            $this->solicitudes->insertar($datos);
            $existeSolicitud = $this->solicitudes->compruebaSolicitud($datos['solicitante']);
            $datos['id_solicitud'] = $existeSolicitud['id_solicitud'];
            $this->horarios->insertar($datos);
        } else {
            $datos['id_solicitud'] = $existeSolicitud['id_solicitud'];
            $this->horarios->insertar($datos);
        }
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true, 
            'mensaje' => 'Laboratorio reservado con éxito.'
        ]);
    }
    function convertirHoraA24($hora12) {
        $hora24 = DateTime::createFromFormat('h:i A', trim($hora12));

        return $hora24 ? $hora24->format('H:i:s') : null;
    }
    private function revisarIntervaloHorario($fecha, $horaInicio, $horaFin) {
        $horasOcupadas = $this->horarios->listarHorasReservadas($fecha);
        $inicioNueva = new DateTime($horaInicio);
        $finNueva = new DateTime($horaFin);

        foreach ($horasOcupadas as $reserva) {
            $inicioOcupado = new DateTime($reserva['hora_inicio']);
            $finOcupado = new DateTime($reserva['hora_fin']);

            // Verifica traslape
            if (($inicioNueva < $finOcupado) && ($finNueva > $inicioOcupado)) {
                return true; // hay conflicto
            }
        }
        return false; // no hay conflicto
    }
    private function horarioInvalido($horaInicio, $horaFin) {
        $entrada = new DateTime('08:00');
        $salida = new DateTime('20:00');
        $inicioNueva = new DateTime($horaInicio);
        $finNueva = new DateTime($horaFin);

        if ($inicioNueva >= $salida) {
            return true;
        }
        if ($inicioNueva < $entrada || $finNueva > $salida) {
            return true;
        }
        if ($finNueva < $entrada || $finNueva < $inicioNueva) {
            return true;
        }
        return false;
    }
}