# SiCInLab

Sistema de Control de Inventarios de Laboratorio.

## Estructura del proyecto

- `/SiCInLab/` → Código fuente del sistema (PHP, JS, CSS).
- `/BD/bddesarrollo` → BD de prueba SQL para crear y probar la base de datos.
- `/BD/bdlimpia` → BD sin datos

## Requisitos

- PHP 8.x
- MySQL
- Composer
- Laragon o similar

## Instalación

1. Clona o descargar el repositorio.
2. Ejecuta `composer install` dentro de la carpeta `SiCInLab/`.
3. Configura tu base de datos usando los scripts en la carpeta `BD/`.
4. Apunta tu servidor local (Laragon) o similar (XAMPP, WAMP, etc.) al subdirectorio `SiCInLab/`.

## Base de Datos

- Crea una nueva base de datos en MySQL usando Workbench o similar
- Puedes restaurar la Base de Datos desde:
- Puedes restaurar la base de datos desde:
   - `/BD/bddesarrollo/` para desarrollo con datos de prueba.
   - `/BD/bdlimpia/` para iniciar con estructura limpia (sin datos).
- En la terminal o CMD ejecuta mysql -u "usuario" -p "contraseña"
- Una vez abierto el interprete de MySQL ejecutar
- use "el_nombre_de_la_BD" donde se restaurará la BD y
- source C:/ruta/completa/al/archivo.sql; en `BD/subdirectorios`

## Inicio de sesion
- Abre el navegador e ingresa: `http://localhost/SiCInLab/public/login`
- Usuario por defecto (solo si usas la BD de desarrollo):
    - Usuario: 0000
    - contraseña: admin