<?php

namespace Foundations\Routes;

use Foundations\DB\Database;
use ReflectionMethod;

class Router {

    public static Router $instance;

    private $routes = [];
    public $namedRoutes = [];
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
        self::$instance = $this;
    }

    public function get(array $args) {
        [$path, $action] = $args;
        $this->add('GET', $path, $action);
        return $this;
    }

    public function post(array $args) {
        [$path, $action] = $args;
        $this->add('POST', $path, $action);
        return $this;
    }

    public function name(string $name) {
        $this->routes[count($this->routes) - 1]['name'] = $name;
        $this->namedRoutes[$name] = $this->routes[count($this->routes) - 1];
        return $this;
    }

    private function add(string $method, string $path, string $action) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'action' => $action,
            'name' => ""
        ];
    }

    private function match(array $requestPathArr, array $pathArr, array $route) : bool {
        [$controller , $action] = explode('@', $route['action']);

        $controller = 'App\Controllers\\'.ucfirst($controller);
        $action = lcfirst($action);
        
        $reflection = new ReflectionMethod($controller, $action);

        $paramArr = array_map(function($param) {
            return $param->name;
        }, $reflection->getParameters());

        $paramTypeArr = array_merge(...array_map(function($param) {
            return [$param->name => $param->getType()->getName()];
        }, $reflection->getParameters()));

        $params = [];

        foreach ($pathArr as $key => $path) {
            if (preg_match('/^\{[A-Za-z]+\}$/', $path)) {
                $path = substr($path, 1, -1);
                if(!in_array($path, $paramArr)) {
                    return false;
                }else{
                    if(!$requestPathArr[$key]){
                        return false;
                    }
                    if($paramTypeArr[$path] !== gettype($requestPathArr[$key]) && (int) $requestPathArr[$key] === 0) {
                        return false;
                    }
                    $params[$path] = $requestPathArr[$key];
                }
            }else if ($path !== $requestPathArr[$key]) {
                return false;
            }
        }

        global $container;
        $container->call([$controller, $action], $params);

        return true;
    }

    public function dispatch() {
        $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            $pathArr = explode('/', $route['path']);
            $requestPathArr = explode('/', $requestPath);

            if (count($pathArr) !== count($requestPathArr) || $requestMethod !== $route['method'] || !$this->match($requestPathArr, $pathArr, $route)) {
                continue;
            }

            return;
        }

        abort(404, 'Route not found');
    }
}
