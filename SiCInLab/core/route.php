<?php
namespace Core;

class Route {
    private static $enlace = [];

    public static function get($url, $callback) {
        return self::addRoute('GET', $url, $callback);
    }
    public static function post($url, $callback) {
        return self::addRoute('POST', $url, $callback);
    }
    private static function addRoute($method, $url, $callback) {
        $url = preg_replace('/\{(\w+):([^\}]+)\}/', '(?P<$1>($2))', $url);
        $url = "#^$url$#";
        
        $ruta = new Enlace($method, $url, $callback);
        self::$enlace[] = $ruta;

        return $ruta;
    }
    public static function resolve($url, $method) {
        foreach (self::$enlace as $route) {
            if ($route->method == $method && preg_match($route->url, $url, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $method = $params['accion'] ?? $route->callback[1];
                $controller = new $route->callback[0];

                unset($params['accion']);

                if (method_exists($controller, $method)) {
                    
                    return call_user_func_array([$controller, $method], array_values($params));
                } else {
                    die("No existe el metodo...");
                }
            }
        }

        die("404 - Ruta no encontrada");
    }
    public static function handle() {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = substr($url, strlen(BASE_URL));
        
        self::resolve($url, $method);
    }
}