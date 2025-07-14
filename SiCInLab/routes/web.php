<?php
require_once(__DIR__.'/../core/global.php');

use App\Controllers\EquiposController;
use App\Controllers\MaterialesController;
use App\Controllers\MobiliariosController;
use App\Controllers\ReactivosController;
use App\Controllers\ComprasController;
use App\Controllers\DetalleComprasController;
use App\Controllers\DevolucionesController;
use App\Controllers\PrestamosController;
use App\Controllers\PrestamoConsumiblesController;
use App\Controllers\IncidenciasController;
use App\Controllers\InventariosController;
use App\Controllers\ServicioSalaController;
use App\Controllers\UsuariosController;
use Core\Route;
/**
 * Rutas de CRUD Equipos
 */
Route::get('equipos/{accion:[a-z]+}', [EquiposController::class]);
Route::post('equipos/alta', [EquiposController::class, 'guardar']);
Route::get('equipos/{accion:[a-z]+}/{id:\d+}', [EquiposController::class]);
Route::post('equipos/editar/{id:\d+}', [EquiposController::class, 'modificar']);
Route::get('equipos/buscador', [EquiposController::class, 'buscador']);
/**
 * Rutas de CRUD Materiales
 */
Route::get('materiales/{accion:[a-z]+}', [MaterialesController::class]);
Route::post('materiales/alta', [MaterialesController::class, 'guardar']);
Route::get('materiales/{accion:[a-z]+}/{id:\d+}', [MaterialesController::class]);
Route::post('materiales/editar/{id:\d+}', [MaterialesController::class, 'modificar']);
Route::get('materiales/buscador', [MaterialesController::class, 'buscador']);
/**
 * Rutas de CRUD Mobiliarios
 */
Route::get('mobiliarios/{accion:[a-z]+}', [MobiliariosController::class]);
Route::post('mobiliarios/alta', [MobiliariosController::class, 'guardar']);
Route::get('mobiliarios/{accion:[a-z]+}/{id:\d+}', [MobiliariosController::class]);
Route::post('mobiliarios/editar/{id:\d+}', [MobiliariosController::class, 'modificar']);
Route::get('mobiliarios/buscador', [MobiliariosController::class, 'buscador']);
/**
 * Rutas de CRUD Reactivos
 */
Route::get('reactivos/{accion:[a-z]+}', [ReactivosController::class]);
Route::post('reactivos/alta', [ReactivosController::class, 'guardar']);
Route::get('reactivos/{accion:[a-z]+}/{id:\d+}', [ReactivosController::class]);
Route::post('reactivos/editar/{id:\d+}', [ReactivosController::class, 'modificar']);
Route::get('reactivos/buscador', [ReactivosController::class, 'buscador']);
/**
 * Rutas Compras
 */
Route::get('compras/{accion:[a-z]+}', [ComprasController::class]);
Route::post('compras/guardar', [ComprasController::class, 'guardar']);
/**
 * Rutas Detalle Compras
 */
Route::get('detalle-compras/{accion:[a-z]+}', [DetalleComprasController::class]);
Route::get('detalle-compras/obtenerObjetos', [DetalleComprasController::class, 'obtenerObjetos']);//ruta ajax
Route::post('detalle-compras/registrarCompras', [DetalleComprasController::class, 'registrarCompras']);//ruta ajax
/**
 * Rutas Prestamos
 */
Route::get('prestamos/{accion:[a-z]+}', [PrestamosController::class]);
Route::post('prestamos/registrarPrestamo', [PrestamosController::class, 'registrarPrestamo']);
Route::get('prestamos/detallePrestamo', [PrestamosController::class, 'detallePrestamo']);
Route::get('prestamos/listarObjetos', [PrestamosController::class, 'listarObjetos']);
Route::post('prestamos/guardarDetallePrestamo', [PrestamosController::class, 'guardarDetallePrestamo']);
/**
 * Rutas Consumibles
 */
Route::get('consumibles/{accion:[a-z]+}', [PrestamoConsumiblesController::class]);
Route::get('consumibles/obtenerCatidades', [PrestamoConsumiblesController::class, 'obtenerCatidades']); //ruta ajax
Route::post('consumibles/guardarPrestamoConsumible', [PrestamoConsumiblesController::class, 'guardarPrestamoConsumible']); //ruta ajax
/**
 * Rutas Devoluciones - detalle devolucion
 */
Route::get('devoluciones/{accion:[a-z]+}', [DevolucionesController::class]);
Route::get('devoluciones/buscarPrestamos', [DevolucionesController::class, 'buscarPrestamos']);//ruta ajax
Route::post('devoluciones/registrarDevolucion', [DevolucionesController::class, 'registrarDevolucion']);//ruta ajax
/**
 * Rutas Incidentes
 */
Route::get('incidencias/{accion:[a-z]+}', [IncidenciasController::class]);
Route::post('incidencias/index', [IncidenciasController::class, 'guardar']);
/**
 * Rutas Inventario
 */
Route::get('inventarios/{accion:[a-z]+}', [InventariosController::class]);
Route::get('inventarios/registroInventario', [InventariosController::class, 'registroInventario']);//ajax
Route::post('inventarios/reporteInventario', [InventariosController::class, 'reporteInventario']); //ruta de reporte en get
Route::post('inventarios/guardarDesgloseInventario', [InventariosController::class, 'guardarDesgloseInventario']);
Route::post('inventarios/reporteDesgloseInventario', [InventariosController::class, 'reporteDesgloseInventario']);
/**
 * Rutas Servicio a Sala
 */
Route::get('servicio-sala/reservacion', [ServicioSalaController::class, 'reservaciones']);
Route::get('servicio-sala/listaReservaciones', [ServicioSalaController::class, 'listaReservaciones']);
Route::get('servicio-sala/horasDisponibles', [ServicioSalaController::class, 'horasDisponibles']);
Route::post('servicio-sala/registrarReservacion', [ServicioSalaController::class, 'registrarReservacion']);
/**
 * Rutas Usuarios
 */
Route::get('usuarios/index', [UsuariosController::class, 'index']);
Route::get('usuarios/alta', [UsuariosController::class, 'alta']);
Route::post('usuarios/alta', [UsuariosController::class, 'guardar']);
Route::get('usuarios/editar/{id:\d+}', [UsuariosController::class, 'editar']);
Route::post('usuarios/editar/{id:\d+}', [UsuariosController::class, 'actualizarDatos']);
Route::get('usuarios/buscador', [UsuariosController::class, 'buscador']);
Route::get('usuarios/{accion:[a-z]+}/{id:\d+}', [UsuariosController::class]);

Route::handle();