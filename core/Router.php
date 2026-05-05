<?php
// core/Router.php
namespace Core;

class Router {
    protected $routes = [];

    public function get($uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action) {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch($uri, $method) {
        $uri = parse_url($uri, PHP_URL_PATH);
        
        // Basic routing
        if (array_key_exists($uri, $this->routes[$method])) {
            $action = $this->routes[$method][$uri];
            
            if (is_array($action)) {
                $controller = new $action[0]();
                $method = $action[1];
                return $controller->$method();
            }
            
            if (is_callable($action)) {
                return $action();
            }
        }

        // Handle 404
        http_response_code(404);
        echo "404 - Not Found in the Matrix.";
        exit;
    }
}
