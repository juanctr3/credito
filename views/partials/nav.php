<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container">
    <a class="navbar-brand" href="/">Dotaciones App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="/">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/proyectos">Proyectos</a>
        </li>
        
        <?php if (isset($_SESSION['user_id'])): ?>
          
          <li class="nav-item">
            <a class="nav-link" href="/mi-cuenta">Mi Cuenta</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout">Cerrar Sesión</a>
          </li>

        <?php else: ?>

          <li class="nav-item">
            <a class="nav-link" href="/login">Iniciar Sesión</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-primary text-white" href="/register">Registrarse</a>
          </li>
          
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>
