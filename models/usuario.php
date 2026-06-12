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
        $fecha_creacion = date("Y-m-d H:i:s");
        
        $query = "INSERT INTO usuarios (usuario, email, password, id_rol, fecha_creacion) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("sssis", $usuario, $email, $hashed_password, $id_rol, $fecha_creacion);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        }
        return false;
    }

    public function emailExiste($email) {
        $query = "SELECT id_usuario FROM usuarios WHERE email = ?";
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