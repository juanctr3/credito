<?php

class AuthController extends Controller {
    
    private $userModel;

    public function __construct() {
        // Cargamos el modelo de usuario para poder usarlo en todos los métodos
        $this->userModel = $this->model('User');
    }

    // Muestra el formulario de registro
    public function register() {
        $this->view('auth/register', ['pageTitle' => 'Crear una Cuenta']);
    }

    // Procesa el formulario de registro
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validar y limpiar datos (simplificado)
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'password' => trim($_POST['password']),
                'password_confirm' => trim($_POST['password_confirm'])
            ];
            
            // Lógica de validación (simplificada)
            if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
                 // Redirigir con error
                 header('Location: /register'); // Aquí se puede añadir un mensaje de error
                 exit();
            }
            if ($data['password'] !== $data['password_confirm']) {
                 // Redirigir con error
                 header('Location: /register'); // Las contraseñas no coinciden
                 exit();
            }
            if ($this->userModel->findByEmail($data['email'])) {
                // Redirigir con error
                header('Location: /register'); // El email ya está en uso
                exit();
            }

            // Si todo es correcto, crear el usuario
            if ($this->userModel->create($data)) {
                // Redirigir al login para que inicie sesión
                header('Location: /login');
                exit();
            }
        }
    }

    // Muestra el formulario de login
    public function login() {
        $this->view('auth/login', ['pageTitle' => 'Iniciar Sesión']);
    }

    // Procesa el formulario de login
    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $loggedInUser = $this->userModel->attemptLogin($email, $password);

            if ($loggedInUser) {
                // Usuario autenticado, crear la sesión
                $_SESSION['user_id'] = $loggedInUser->id;
                $_SESSION['user_name'] = $loggedInUser->name;
                $_SESSION['user_role'] = $loggedInUser->role;
                
                // Redirigir al panel correspondiente
                if ($loggedInUser->role === 'admin') {
                    header('Location: /admin/dashboard');
                } else {
                    header('Location: /mi-cuenta');
                }
                exit();
            } else {
                // Error de autenticación, redirigir de vuelta al login
                // Podríamos usar sesiones "flash" para mostrar un mensaje de error
                header('Location: /login');
                exit();
            }
        }
    }

    // Cierra la sesión del usuario
    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /');
        exit();
    }
}
