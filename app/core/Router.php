<?php

class Router {
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function get($uri, $controllerAction) {
        $this->routes['GET'][$uri] = $controllerAction;
    }

    public function post($uri, $controllerAction) {
        $this->routes['POST'][$uri] = $controllerAction;
    }

    public function dispatch($uri, $method) {
        if (array_key_exists($uri, $this->routes[$method])) {
            // Separamos el controlador del método. Ej: 'HomeController@index'
            list($controller, $action) = explode('@', $this->routes[$method][$uri]);
            
            return $this->callAction($controller, $action);
        }

        // Si la ruta no se encuentra, mostramos un error 404
        http_response_code(404);
        echo "<h1>404 Not Found</h1><p>La página que buscas no existe.</p>";
        // En el futuro, cargaremos una vista de error bonita aquí.
    }

    protected function callAction($controller, $action) {
        $controllerFile = "../app/controllers/{$controller}.php";

        if (!file_exists($controllerFile)) {
            throw new Exception("Controlador no encontrado: {$controller}");
        }

        require_once $controllerFile;
        $controllerInstance = new $controller();

        if (!method_exists($controllerInstance, $action)) {
            throw new Exception("La acción {$action} no existe en el controlador {$controller}.");
        }

        return $controllerInstance->$action();
    }
}
