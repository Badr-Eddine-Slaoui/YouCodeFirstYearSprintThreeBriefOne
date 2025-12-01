<?php

namespace App;

use ReflectionMethod;

class Router {
    private $routes = [];
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function get(array $args) {
        [$path, $action] = $args;
        $this->add('GET', $path, $action);
    }

    public function post(array $args) {
        [$path, $action] = $args;
        $this->add('POST', $path, $action);
    }

    public function add(string $method, string $path, string $action) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'action' => $action
        ];
    }

    private function match(array $requestPathArr, array $pathArr, array $route) : bool {
        [$controller , $action] = explode('@', $route['action']);

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

        $controller = new $controller($this->pdo);
        $controller->$action(...$params);

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

        http_response_code(404);
        echo "<h1>404 Not Found</h1>";
        echo "<p>No route matched for $requestPath</p>";
    }
}
