<?php
require_once __DIR__ . '/../config/database.php';

class Usuario
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function registrar($usuario, $email, $password, $id_rol = 3, $estado = 1)
    {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $query = 'INSERT INTO usuarios (usuario, email, password, id_rol, estado) VALUES (?, ?, ?, ?, ?)';

        $stmt = $this->conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param('sssii', $usuario, $email, $hashed_password, $id_rol, $estado);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        }
        return false;
    }

    public function emailExiste($email)
    {
        $query = 'SELECT id_usuario FROM usuarios WHERE email = ?';
        $stmt = $this->conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();
            $num_rows = $stmt->num_rows;
            $stmt->close();
            return $num_rows > 0;
        }
        return false;
    }

    public function obtenerPorEmail($email)
    {
        $query = 'SELECT id_usuario, usuario, email, password, id_rol, estado FROM usuarios WHERE email = ?';
        $stmt = $this->conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $usuario = $result->fetch_assoc();
            $stmt->close();
            return $usuario;
        }
        return null;
    }

    public function obtenerTodos()
    {
        $query = 'SELECT u.id_usuario, u.usuario, u.email, u.id_rol, u.estado 
                  FROM usuarios u 
                  LEFT JOIN roles r ON u.id_rol = r.id_rol';
        $result = $this->conn->query($query);
        $usuarios = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
        }
        return $usuarios;
    }

    public function obtenerEstados()
    {
        return [
            1 => 'Activo',
            0 => 'Inactivo'
        ];
    }
}
?>