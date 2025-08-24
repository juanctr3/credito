<?php

class User {
    private $db;

    public function __construct() {
        // Obtenemos la instancia de la conexión a la BD
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Busca un usuario por su email.
     * @param string $email
     * @return mixed El objeto del usuario si se encuentra, de lo contrario false.
     */
    public function findByEmail($email) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            // Manejar error
            return false;
        }
    }

    /**
     * Registra un nuevo usuario en la base de datos.
     * @param array $data ['name', 'email', 'password', 'phone']
     * @return bool True si fue exitoso, de lo contrario false.
     */
    public function create($data) {
        try {
            // ¡NUNCA guardes contraseñas en texto plano! Usa password_hash.
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

            $stmt = $this->db->prepare(
                "INSERT INTO users (name, email, password, phone, role) VALUES (:name, :email, :password, :phone, 'client')"
            );
            
            return $stmt->execute([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $hashedPassword,
                'phone' => $data['phone']
            ]);
        } catch (PDOException $e) {
            // Manejar error (ej. email duplicado)
            return false;
        }
    }

    /**
     * Intenta autenticar a un usuario.
     * @param string $email
     * @param string $password
     * @return mixed El objeto del usuario si la autenticación es exitosa, de lo contrario false.
     */
    public function attemptLogin($email, $password) {
        $user = $this->findByEmail($email);

        if ($user && password_verify($password, $user->password)) {
            // La contraseña es correcta
            return $user;
        }

        // Email no encontrado o contraseña incorrecta
        return false;
    }
}
