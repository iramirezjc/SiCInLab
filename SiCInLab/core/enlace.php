<?php
namespace Core;

class Enlace {

    public function __construct(
        public $method, 
        public $url, 
        public $callback
    ) {}
    
    public static function url($path = '') {
        return rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');
    }
}