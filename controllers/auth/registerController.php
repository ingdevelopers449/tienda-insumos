<?php
session_start();
require_once __DIR__ . '/../../models/Usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_str = $_POST['usuario'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $terminos = $_POST['terminos'] ?? '';

    if (empty($usuario_str) || empty($email) || empty($password)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: ../../views/auth/register.php");
        exit();
    }

    $usuarioModel = new Usuario();

    if ($usuarioModel->emailExiste($email)) {
        $_SESSION['error'] = "El email ya está registrado.";
        header("Location: ../../views/auth/register.php");
        exit();
    }

    // 3 = Cliente
    $registrado = $usuarioModel->registrar($usuario_str, $email, $password, 3);

    if ($registrado) {
        $_SESSION['success'] = "Cuenta creada exitosamente. Puedes iniciar sesión.";
        header("Location: ../../views/auth/login.php");
        exit();
    } else {
        $_SESSION['error'] = "Hubo un error al registrar. Verifica tu conexión o intenta más tarde.";
        header("Location: ../../views/auth/register.php");
        exit();
    }
} else {
    header("Location: ../../views/auth/register.php");
    exit();
}
?>