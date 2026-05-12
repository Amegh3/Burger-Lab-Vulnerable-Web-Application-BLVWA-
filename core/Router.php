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
        
        foreach ($this->routes[$method] as $route => $action) {
            // Convert {param} to named regex group
            $pattern = str_replace('/', '\/', $route);
            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^\/]+)', $pattern);
            $pattern = '/^' . $pattern . '$/';

            if (preg_match($pattern, $uri, $matches)) {
                // Extract named parameters
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                
                if (is_array($action)) {
                    $controllerName = $action[0];
                    $methodName = $action[1];
                    $controller = new $controllerName();
                    return call_user_func_array([$controller, $methodName], $params);
                }
                
                if (is_callable($action)) {
                    return call_user_func_array($action, $params);
                }
            }
        }

        // Handle 404
        http_response_code(404);
        echo "404 - Not Found in the Matrix.";
        exit;
    }
}
