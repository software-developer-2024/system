<?php

namespace Core;

class Router {

    protected $routes = [];

    public function add($method, $uri, $controller){
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function get($uri, $controller){
        $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller){
        $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller){
        $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller){
        $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller){
        $this->add('PUT', $uri, $controller);
    }

    public function route($uri, $method){
        foreach ($this->routes as $route) {
            if ($this->match($route['uri'], $uri) && $route['method'] === strtoupper($method)){
                return require base_path($route['controller']);
            }
        }

        $this->abort();
    }

    protected function match($routeUri, $requestUri) {
        // Convert the route URI into a regex pattern
        $pattern = preg_replace('/\{(\w+)\}/', '([^/]+)', $routeUri);
        $pattern = str_replace('/', '\/', $pattern); // Escape slashes
        $pattern = '/^' . $pattern . '$/'; // Add start and end delimiters

        // Check if the request URI matches the pattern
        if (preg_match($pattern, $requestUri, $matches)) {
            // You can return the matches if you want to use them later
            return $matches;
        }

        return false;
    }

    protected function abort($code = 404){
        http_response_code($code);

        require base_path("views/{$code}.php");

        die();

    }
    
}

