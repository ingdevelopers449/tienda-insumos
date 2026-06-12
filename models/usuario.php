<?php
require_once __DIR__ . '/../config/database.php';

class Usuario {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function registrar($usuario, $email, $password, $id_rol = 3) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        $query = "INSERT INTO usuarios (usuario, email, password, id_rol) VALUES (?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("sssi", $usuario, $email, $hashed_password, $id_rol);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        }
        return false;
    }

    public function emailExiste($email) {
        $query = "SELECT id FROM usuarios WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            $num_rows = $stmt->num_rows;
            $stmt->close();
            return $num_rows > 0;
        }
        return false;
    }
}
?>