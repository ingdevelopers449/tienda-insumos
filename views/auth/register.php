<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - AgriStock</title>
    <!-- Bootstrap 5.3.2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom Style Sheet -->
    <link href="../../public/css/style.css" rel="stylesheet">
</head>
<body class="auth-page">

    <div class="auth-card auth-card-register">
        <!-- Logo -->
        <div class="text-center mb-4">
            <a class="text-success fw-bold text-decoration-none fs-2 d-inline-flex align-items-center mb-2" href="../../public/index.php">
                <i class="bi bi-patch-check-fill text-success me-2"></i>AgriStock
            </a>
            <h4 class="fw-bold mb-1 text-white">Crear una Cuenta</h4>
            <p class="auth-subtitle small">Regístrate para empezar a gestionar tus insumos agrícolas</p>
        </div>

        <!-- Form -->
        <form class="needs-validation" novalidate action="#" method="POST" id="registerForm">
            <!-- Full Name -->
            <div class="mb-3">
                <label for="name" class="form-label-premium">Nombre Completo</label>
                <div class="input-group input-group-premium">
                    <span class="input-group-text input-group-text-premium"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control form-control-premium" id="name" name="name" placeholder="Juan Pérez" required autocomplete="name">
                    <div class="invalid-feedback">Por favor ingresa tu nombre completo.</div>
                </div>
            </div>

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
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="password" class="form-label-premium">Contraseña</label>
                    <div class="input-group input-group-premium">
                        <span class="input-group-text input-group-text-premium"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control form-control-premium" id="password" name="password" placeholder="••••••••" required autocomplete="new-password" minlength="8">
                        <div class="invalid-feedback">Debe tener al menos 8 caracteres.</div>
                    </div>
                </div>
                <div class="col-md-6 mt-3 mt-md-0">
                    <label for="confirm_password" class="form-label-premium">Confirmar Contraseña</label>
                    <div class="input-group input-group-premium">
                        <span class="input-group-text input-group-text-premium"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control form-control-premium" id="confirm_password" name="confirm_password" placeholder="••••••••" required autocomplete="new-password">
                        <div class="invalid-feedback">Las contraseñas deben coincidir.</div>
                    </div>
                </div>
            </div>

            <!-- Terms and Conditions -->
            <div class="mb-4 form-check d-flex align-items-start gap-2">
                <input type="checkbox" class="form-check-input bg-transparent border-secondary mt-1" id="terms" name="terms" required>
                <label class="form-check-label text-secondary small" for="terms">
                    Acepto los <a href="#" class="text-link">Términos de Servicio</a> y la <a href="#" class="text-link">Política de Privacidad</a> de AgriStock.
                </label>
                <div class="invalid-feedback">Debes aceptar los términos para registrarte.</div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-premium btn-premium-primary w-100 py-3 mb-3">
                Registrarse <i class="bi bi-check-circle ms-2"></i>
            </button>

            <!-- Login Link -->
            <div class="text-center">
                <p class="text-secondary small mb-0">
                    ¿Ya tienes una cuenta? <a href="login.php" class="text-link">Inicia sesión aquí</a>
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
            var form = document.getElementById('registerForm')
            var password = document.getElementById('password')
            var confirmPassword = document.getElementById('confirm_password')

            form.addEventListener('submit', function (event) {
                // Custom Password matching check
                if (password.value !== confirmPassword.value) {
                    confirmPassword.setCustomValidity('Passwords do not match')
                } else {
                    confirmPassword.setCustomValidity('')
                }

                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })()
    </script>
</body>
</html>
