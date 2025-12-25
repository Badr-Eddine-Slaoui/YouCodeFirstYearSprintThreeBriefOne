<?php

use Foundations\DI\Container;
use Foundations\Helpers\Auth;
use Foundations\Helpers\Session;
use Foundations\Routes\Router;

define('CACHE_DIR', __DIR__.'/../cache');
define('VIEWS_DIR', __DIR__.'/../views');
define('BASE_VIEWS_DIR', __DIR__.'/../foundations/views');

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

    $content = preg_replace(
        "/@endlayout/",
        "<?php \$content = ob_get_clean(); view(\$__layout, ['content' => \$content]); ?>",
        $content
    );

    $content = preg_replace(
        "/@asset\(['\"](.+?)['\"]\)/",
        "<?php echo asset('$1'); ?>",
        $content
    );

    $content = preg_replace(
        "/@auth/",
        "<?php if (auth()->check()) : ?>",
        $content
    );

    $content = preg_replace(
        "/@endauth/",
        "<?php endif; ?>",
        $content
    );

    $content = preg_replace(
        "/@guest/",
        "<?php if (!auth()->check()) : ?>",
        $content
    );

    $content = preg_replace(
        "/@endguest/",
        "<?php endif; ?>",
        $content
    );

    $content = preg_replace(
        "/@if\s*\((.*)\)/",
        "<?php if ($1) : ?>",
        $content
    );

    $content = preg_replace(
        "/@elseif\s*\((.*)\)/",
        "<?php else if ($1) : ?>",
        $content
    );

    $content = preg_replace(
        "/@endif/",
        "<?php endif; ?>",
        $content
    );

    $content = preg_replace(
        "/@php/",
        "<?php ",
        $content
    );

    $content = preg_replace(
        "/@endphp/",
        " ?>",
        $content
    );

    $content = preg_replace(
        "/@route\(['\"](.+?)['\"](, \[(.+?)\])?\)/",
        "<?php echo route('$1', [$3]); ?>",
        $content
    );

    $content = preg_replace(
        "/@page\((.+?) \? (.+?) : (.+?)\)/",
        "<?php echo page() === $1 ? $2 : $3; ?>",
        $content
    );

    $content = preg_replace(
        "/@error\(['\"](.+?)['\"]\)\s*(.*?)\s*@enderror/s",
        "<?php if (session()->hasError('$1')) : ?>\n<?php \$message = session()->getError('$1'); ?>\n$2\n<?php endif; ?>",
        $content
    );

    $content = preg_replace(
        "/{{\s*(.+?)\s*}}/",
        "<?php echo $1; ?>",
        $content
    );

    return $content;
}

function asset($path) {
    return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/' . ltrim($path, '/');
}

function app(): Container {
    return $GLOBALS['app'];
}

function show_error_view(Exception $e): never {
    require_once BASE_VIEWS_DIR . "/Exceptions/exception.php";
    exit();
}

function view(string $view, array $data = []): void {
    try {
        extract($data);

        $view = str_replace('.', '/', $view);
        $file = VIEWS_DIR . "/$view.mavel.php";

        if (!file_exists($file)) {
            abort(404, 'View not found');
        }

        $dir = CACHE_DIR . "/views";
        
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
        show_error_view($e);
    }
}

function route(string $name, array $params = []): string {
    try {
        $router = app()->get(Router::class);
        $route = $router->namedRoutes[$name];

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
        show_error_view($e);
    }
}

function redirect(string $name, array $params = []): never {
    try{
        header('Location: ' . route($name, $params));
        exit();
    }catch(Exception $e){
        show_error_view($e);
    }
}

function abort(int $code, string $message): never {
    try {
        http_response_code($code);
        require_once  BASE_VIEWS_DIR . "/Errors/abort.php";
        exit();
    } catch (Exception $e) {
        show_error_view($e);
    }
}

function dd(mixed ...$vars): never {
    try {
        require_once  BASE_VIEWS_DIR . "/Exceptions/dd.php";
        exit();
    } catch (Exception $e) {
        show_error_view($e);
    }
}

function page(): string {
    try{
        $page = $_SERVER['REQUEST_URI'];
        $pages = explode('/', $page);
        $page = end($pages);
        if((int) $page > 0) {
            $page = $pages[count($pages) -2];
        }
        $page = str_replace('.mavel.php', '', $page);
        return $page;
    }catch(Exception $e){
        show_error_view($e);
    }
}

function auth(): Auth{
    return new Auth();
}

function session(): Session{
    return new Session();
}