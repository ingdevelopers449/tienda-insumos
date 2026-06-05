<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - AgriStock</title>
    <!-- Bootstrap 5.3.2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom Style Sheet -->
    <link href="../../public/css/style.css" rel="stylesheet">
</head>
<body class="auth-page">

    <div class="auth-card">
        <!-- Logo -->
        <div class="text-center mb-4">
            <a class="text-success fw-bold text-decoration-none fs-2 d-inline-flex align-items-center mb-2" href="../../public/index.php">
                <i class="bi bi-patch-check-fill text-success me-2"></i>AgriStock
            </a>
            <h4 class="fw-bold mb-1 text-white">¡Bienvenido de nuevo!</h4>
            <p class="auth-subtitle small">Ingresa tus credenciales para acceder al sistema</p>
        </div>

        <!-- Form -->
        <form class="needs-validation" novalidate action="#" method="POST">
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label-premium">Correo Electrónico</label>
                <div class="input-group input-group-premium">
                    <span class="input-group-text input-group-text-premium"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control form-control-premium" id="email" name="email" placeholder="nombre@ejemplo.com" required autocomplete="email">
                    <div class="invalid-feedback">Por favor ingresa un correo electrónico válido.</div>
                </div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="password" class="form-label-premium mb-0">Contraseña</label>
                    <a href="#" class="small text-link">¿Olvidaste tu contraseña?</a>
                </div>
                <div class="input-group input-group-premium">
                    <span class="input-group-text input-group-text-premium"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control form-control-premium" id="password" name="password" placeholder="••••••••" required autocomplete="current-password">
                    <div class="invalid-feedback">Por favor ingresa tu contraseña.</div>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="mb-4 form-check d-flex align-items-center gap-2">
                <input type="checkbox" class="form-check-input bg-transparent border-secondary" id="remember" name="remember">
                <label class="form-check-label text-secondary small" for="remember">Recordarme en este dispositivo</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-premium btn-premium-primary w-100 py-3 mb-3">
                Iniciar Sesión <i class="bi bi-box-arrow-in-right ms-2"></i>
            </button>

            <!-- Register Link -->
            <div class="text-center">
                <p class="text-secondary small mb-0">
                    ¿No tienes una cuenta? <a href="register.php" class="text-link">Regístrate aquí</a>
                </p>
            </div>
        </form>
    </div>

    <!-- Bootstrap 5.3.2 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form Validation Bootstrap Script
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>
