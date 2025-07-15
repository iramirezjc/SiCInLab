# SiCInLab

Sistema de Control de Inventarios de Laboratorio.

## Estructura del proyecto

- `/SiCInLab/` → Código fuente del sistema (PHP, JS, CSS).
- `/BD/` → BD de prueva y Scripts SQL para crear y poblar la base de datos.

## Requisitos

- PHP 8.x
- MySQL
- Composer
- Laragon o similar

## Instalación

1. Clona el repositorio.
2. Ejecuta `composer install` dentro de la carpeta `SiCInLab/`.
3. Configura tu base de datos usando los scripts en la carpeta `BD/`.
4. Apunta tu servidor local (Laragon) al subdirectorio `SiCInLab/SiCInLab`.

## Base de Datos

- Crea una nueva base de datos en MySQL usando Workbench o similar
- Puedes ejecutar las tablas en `BD/tablas.sql`. o restaurar la BD de `BD/dbdesarrollo/sicinlab.sql`
- En una terminal ejecuta mysql -u "usuario" -p "contraseña"
- Una vez abierto el interprete de MySQL ejecutar
- use database "nombr de la BD";
- source C:/ruta/completa/al/archivo.sql; en BD/database/lab.sql
