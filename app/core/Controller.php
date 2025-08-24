<?php

abstract class Controller {
    /**
     * Carga una vista.
     * @param string $view El nombre del archivo de la vista (sin .php)
     * @param array $data Los datos a pasar a la vista
     */
    protected function view($view, $data = []) {
        // Convierte las claves del array en variables. Ej: $data['titulo'] se convierte en $titulo
        extract($data);

        $viewFile = "../views/{$view}.php";

        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            // Si la vista no existe, muestra un error.
            die("Vista no encontrada: {$viewFile}");
        }
    }

    /**
     * Carga un modelo. (Lo usaremos más adelante)
     * @param string $model El nombre del modelo
     */
    protected function model($model) {
        $modelFile = "../app/models/{$model}.php";
        if (file_exists($modelFile)) {
            require_once $modelFile;
            return new $model();
        } else {
            die("Modelo no encontrado: {$modelFile}");
        }
    }
}
