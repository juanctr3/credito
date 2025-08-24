<?php

class HomeController extends Controller {
    
    public function index() {
        // Datos que queremos pasar a la vista
        $data = [
            'pageTitle' => 'Bienvenido al Sistema de Dotaciones'
        ];

        // Cargar la vista 'home' y pasarle los datos
        $this->view('home', $data);
    }
}
