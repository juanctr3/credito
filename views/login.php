<?php require_once '../views/partials/header.php'; ?>
<?php require_once '../views/partials/nav.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h2><?= htmlspecialchars($pageTitle) ?></h2>
            </div>
            <div class="card-body">
                <form action="/login" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                </form>
                 <p class="mt-3 text-center">¿No tienes una cuenta? <a href="/register">Regístrate aquí</a></p>
            </div>
        </div>
    </div>
</div>

<?php require_once '../views/partials/footer.php'; ?>
