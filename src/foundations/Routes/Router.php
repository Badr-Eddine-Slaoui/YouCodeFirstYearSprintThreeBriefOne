<?php

namespace Foundations\Routes;

use App\Kernel;
use Foundations\DB\Database;
use Foundations\DB\GoldDigger\Model;
use Foundations\Request\FormRequest;
use Foundations\Request\Request;
use ReflectionMethod;

class Router {

    public static Router $instance;

    private $routes = [];
    public $namedRoutes = [];
    private $modelParamName = null;
    private $requestFormParamName = null;

    public function __construct() {
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

    public function middleware(array $middleware) {
        $this->routes[count($this->routes) - 1]["middleware"] = $middleware;
        return $this;
    }

    private function add(string $method, string $path, string $action) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'action' => $action,
            'name' => "",
            'middleware' => []
        ];
    }

    private function isModel(int $index, array $route) {
        [$controller , $action] = explode('@', $route['action']);

        $method = new ReflectionMethod("App\Controllers\\$controller", $action);
        $count = count($method->getParameters());
        if ($count > $index) {
            $param  =  $method->getParameters()[$index];

            while($param->getType()->getName() === Request::class || is_subclass_of($param->getType()->getName(), Request::class) && $index < $count ){
                $param  =  $method->getParameters()[$index++];
            }

            if(is_subclass_of($param->getType()->getName(), Model::class)){
                $this->modelParamName = $param->getName();
                return $param->getType()->getName();
            }
        }

        return false;
    }

    private function isFormRequest(int $index, array $route) {
        [$controller , $action] = explode('@', $route['action']);

        $method = new ReflectionMethod("App\Controllers\\$controller", $action);
        $count = count($method->getParameters());
        if($count > $index){
            $param  =  $method->getParameters()[$index];

            while($param->getType()->getName() !== FormRequest::class && !is_subclass_of($param->getType()->getName(), FormRequest::class) && $index < $count){
                $param  =  $method->getParameters()[$index++];
            }

            if(is_subclass_of($param->getType()->getName(), FormRequest::class)){
                $this->requestFormParamName = $param->getName();
                return $param->getType()->getName();
            }
        }

        return false;
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
            $pathParamCount = 0;
            $index = $pathParamCount;
            $pathParamCount++;
            if (preg_match('/^\{[A-Za-z]+\}$/', $path)) {
                $path = substr($path, 1, -1);
                $isModel = $this->isModel($index, $route);

                if(!in_array($path, $paramArr) && $isModel === false) {
                    return false;
                }else{
                    if(!$requestPathArr[$key]){
                        return false;
                    }
    
                    if($isModel === false) {
                        if($paramTypeArr[$path] !== gettype($requestPathArr[$key]) && (int) $requestPathArr[$key] === 0) {
                            return false;
                        }

                        $params[$path] = $requestPathArr[$key];
                        continue;
                    }

                    if($isModel){
                        if((int) $requestPathArr[$key] !== 0){
                            $model = $this->isModel($index, $route);
                            $params[$this->modelParamName] = function () use ($requestPathArr, $model, $key) {
                                return $model::findOrFail((int) $requestPathArr[$key]);
                            };
                            $this->modelParamName = null;
                            continue;
                        }
                    }
                    
                    return false;
                }
            }else{
                if ($path !== $requestPathArr[$key]){
                    return false;
                }

                $isFormRequest = $this->isFormRequest($index, $route);
                if($isFormRequest){
                    $requestForm = $this->isFormRequest($index, $route);
                    $params[$this->requestFormParamName] = function () use ($requestForm) {
                        $request = new $requestForm();
                        $request->handleValidationErrors();
                        return $request;
                    };
                    $this->requestFormParamName = null;
                    continue;
                }
            }
        }

        global $container;

        foreach($route["middleware"] as $middleware){
            Kernel::setMiddleware($middleware);
        }

        Kernel::handle(new Request(), function() use ($container, $controller, $action, $params) {
            $container->call([$controller, $action], $params);
        });

        return true;
    }

    public function dispatch() {
        $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            $pathArr = explode('/', $route['path']);
            $requestPathArr = explode('/', $requestPath);
            array_shift($pathArr);
            array_shift($requestPathArr);

            if (count($pathArr) !== count($requestPathArr) || $requestMethod !== $route['method'] || !$this->match($requestPathArr, $pathArr, $route)) {
                continue;
            }

            return;
        }

        abort(404, 'Route not found');
    }
}
