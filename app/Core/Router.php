<?php
namespace App\Core;

class Router {
    protected $routes = [];

    public function add($method, $path, $callback) {
        $path = preg_replace("/{([a-z]+)}/", "([^/]+)", $path);
        $this->routes[] = [
            "method" => strtoupper($method),
            "path" => "#^" . $path . "$#",
            "callback" => $callback
        ];
    }

    public function dispatch($method, $uri) {
        $uri = explode("?", $uri)[0];
        
        // Remove /fr prefix if exists for internal routing
        if (strpos($uri, '/fr/') === 0) {
            $uri = substr($uri, 3);
        } elseif ($uri === '/fr') {
            $uri = '/';
        }

        foreach ($this->routes as $route) {
            if ($route["method"] === $method && preg_match($route["path"], $uri, $matches)) {
                array_shift($matches);
                return call_user_func_array($route["callback"], $matches);
            }
        }
        http_response_code(404);
        include __DIR__ . "/../../views/404.php";
    }
}
