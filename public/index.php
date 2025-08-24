<?php

/**
 * -------------------------------------------------------------------------
 * PUNTO DE ENTRADA ÚNICO (FRONT CONTROLLER)
 * -------------------------------------------------------------------------
 * * Todas las peticiones a la aplicación son redirigidas aquí por el .htaccess.
 * Este script inicializa el entorno, carga las clases del núcleo y
 * despacha la petición al controlador correspondiente a través del Router.
 */

// Iniciar la sesión para manejar variables de sesión (ej: login de usuario)
session_start();

// -------------------------------------------------------------------------
// Cargar el Núcleo del Sistema
// -------------------------------------------------------------------------

require_once '../app/core/Router.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Database.php';

// -------------------------------------------------------------------------
// Inicialización y Definición de Rutas
// -------------------------------------------------------------------------

// Inicializar el enrutador
$router = new Router();

/*
|--------------------------------------------------------------------------
| Definición de Rutas de la Aplicación
|--------------------------------------------------------------------------
|
| Aquí es donde registras todas las rutas para tu aplicación. Es simple
| y expresivo. Simplemente dile al Router la URI y el Controlador@método
| que debe manejarla.
|
*/

// --- Rutas Públicas ---
$router->get('', 'HomeController@index'); // Ruta para la página de inicio. La URI vacía '' representa la raíz '/'.

// --- Rutas de Autenticación ---
$router->get('register', 'AuthController@register');     // Muestra el formulario de registro
$router->post('register', 'AuthController@store');        // Procesa los datos del formulario de registro
$router->get('login', 'AuthController@login');          // Muestra el formulario de inicio de sesión
$router->post('login', 'AuthController@authenticate');  // Procesa los datos del formulario de inicio de sesión
$router->get('logout', 'AuthController@logout');        // Cierra la sesión del usuario

// --- (Aquí se añadirán más rutas en el futuro: proyectos, mi-cuenta, admin, etc.) ---


// -------------------------------------------------------------------------
// Despachar la Petición
// -------------------------------------------------------------------------

// Obtener la URI y el método de la petición actual
// Limpiamos la URI para manejarla de forma consistente y segura.
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$method = $_SERVER['REQUEST_METHOD'];

// El enrutador busca la ruta correspondiente y ejecuta la acción del controlador.
$router->dispatch($uri, $method);
