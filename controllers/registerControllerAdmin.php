<?php
session_start();
require_once __DIR__ . '/../models/Usuario.php';

function mostrarAlerta($type, $title, $text, $redirectUrl) {
    echo "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Procesando...</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <style>
            body {
                background-color: #0f172a;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
        </style>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: '{$type}',
                title: '{$title}',
                text: '{$text}',
                confirmButtonColor: '#10b981',
                background: '#1e293b',
                color: '#fff'
            }).then(() => {
                window.location.href = '{$redirectUrl}';
            });
        </script>
    </body>
    </html>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres = trim($_POST['nombres'] ?? '');
    $apellidos = trim($_POST['apellidos'] ?? '');
    $usuario_str = trim($nombres . ' ' . $apellidos);
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $rol = $_POST['rol'] ?? '';
    $estado = $_POST['estado'] ?? '';

    if (empty($usuario_str) || empty($email) || empty($password) || empty($rol) || empty($estado)) {
        mostrarAlerta('error', 'Campos obligatorios', 'Todos los campos son obligatorios.', '../views/admin/gusuarios.php');
    }

    $usuarioModel = new Usuario();

    if ($usuarioModel->emailExiste($email)) {
        mostrarAlerta('error', 'Correo registrado', 'El email ya está registrado.', '../views/admin/gusuarios.php');
    }

    $registrado = $usuarioModel->registrar($usuario_str, $email, $password, $rol, $estado);

    if ($registrado) {
        mostrarAlerta('success', '¡Registro Exitoso!', 'Cuenta creada exitosamente.', '../views/admin/gusuarios.php');
    } else {
        mostrarAlerta('error', 'Error de registro', 'Hubo un error al registrar. Verifica tu conexión o intenta más tarde.', '../views/admin/gusuarios.php');
    }
} else {
    header("Location: ../views/admin/gusuarios.php");
    exit();
}
?>