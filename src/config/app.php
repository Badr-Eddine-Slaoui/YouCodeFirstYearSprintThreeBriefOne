<?php

use App\Routes\Router;

function parseMavel(string $content) {
    $content = preg_replace(
        "/@view\(['\"](.+?)['\"]\)/",
        "<?php view('$1'); ?>",
        $content
    );

    $content = preg_replace(
        "/@yield\(['\"](.+?)['\"]\)/",
        "<?php echo \$content ?? ''; ?>",
        $content
    );

    $content = preg_replace(
        "/@layout\(['\"](.+?)['\"]\)/",
        "<?php ob_start(); \$__layout = '$1'; ?>",
        $content
    );

    $content = str_replace(
        "@endlayout",
        "<?php \$content = ob_get_clean(); view(\$__layout, ['content' => \$content]); ?>",
        $content
    );

    return $content;
}

function view(string $view, array $data = []): void {
    try {
        extract($data);

        $view = str_replace('.', '/', $view);
        $file = __DIR__.'/../views/'.$view.'.mavel.php';

        if (!file_exists($file)) {
            abort(404, 'View not found');
        }

        $dir = __DIR__.'/../cache/views';
        
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
            chmod($dir, 0777);
        }

        $cache =  "$dir/" . md5($view) . ".php";

        $needs_compile = true;

        if (file_exists($cache)) {
            if (filemtime($file) <= filemtime($cache)) {
                $needs_compile = false;
            }
        }

        if ($needs_compile) {

            $fileContent = file_get_contents($file);

            $compiled = parseMavel($fileContent);

            file_put_contents($cache, $compiled);

            chmod($cache, 0777);

        }

        include_once "$dir/" . md5($view) . ".php";
        
    } catch (Exception $e) {
        echo $e->getMessage();
        exit();
    }
}

function route(string $name, array $params = []): string {
    try {
        $route = Router::$instance->namedRoutes[$name];

        if (!$route) {
            abort(404, 'Route not found');
        }

        if($route['name'] !== $name){
            abort(404, 'Route not found');
        }

        $path = $route['path'];
        $pathParamsCount = count(array_filter(explode('/', $path), function($param) {
            return preg_match('/^\{[A-Za-z]+\}$/', $param);
        }));

        if(count($params) !== $pathParamsCount){
            abort(404, 'Route not found');
        }

        foreach ($params as $key => $value) {
            if(!str_contains($path, '{'.$key.'}')) {
                abort(404, 'Route not found');
            }
            $path = str_replace('{'.$key.'}', $value, $path);
        }

        return $path;

    } catch (Exception $e) {
        echo $e->getMessage();
        exit();
    }
}

function redirect(string $name, array $params = []): never {
    try{
        header('Location: ' . route($name, $params));
        exit();
    }catch(Exception $e){
        echo $e->getMessage();
        exit();
    }
}

function abort(int $code, string $message): never {
    try {
        http_response_code($code);
        echo $message;
        exit();
    } catch (Exception $e) {
        echo $e->getMessage();
        exit();
    }
}

function dd(mixed ...$var): never {
    try {
        echo '<pre>';
        var_dump(...$var);
        echo '</pre>';
        die();
    } catch (Exception $e) {
        echo $e->getMessage();
        die();
    }
}

function page(): string {
    try{
        $page = $_SERVER['REQUEST_URI'];
        $page = explode('/', $page);
        $page = end($page);
        $page = str_replace('.mavel.php', '', $page);
        return $page;
    }catch(Exception $e){
        echo $e->getMessage();
        exit();
    }
}