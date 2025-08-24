<?php

// Iniciar la sesión para manejar variables de sesión (ej: login de usuario)
session_start();

// Cargar el núcleo del sistema
require_once '../app/core/Router.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Database.php';

// Inicializar el enrutador
$router = new Router();

// --- Definición de Rutas ---
// Aquí definiremos todas las URLs de nuestra aplicación.
// Por ahora, crearemos una ruta de prueba para la página de inicio.

// Ruta para la página de inicio (GET /)
$router->get('/', 'HomeController@index');

// --- Fin de Definición de Rutas ---


// Obtener la URI y el método de la petición actual
// Usamos trim para limpiar la URI y parse_url para ignorar query strings
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$method = $_SERVER['REQUEST_METHOD'];

// Despachar la ruta para que el enrutador llame al controlador correspondiente
$router->dispatch($uri, $method);
