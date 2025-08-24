<?php

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        // En un futuro, cargaremos esto desde el archivo .env
        $db_host = 'localhost'; // O 127.0.0.1
        $db_name = 'dotaciones_db';
        $db_user = 'root';
        $db_pass = ''; // Tu contraseña de XAMPP/WAMP, si tienes una
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$db_host;dbname=$db_name;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, // Retorna resultados como objetos stdClass
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $db_user, $db_pass, $options);
        } catch (\PDOException $e) {
            // En un entorno de producción, registraríamos el error en un log en lugar de mostrarlo.
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}
