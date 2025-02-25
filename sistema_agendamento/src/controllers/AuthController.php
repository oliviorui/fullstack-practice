<?php
require_once 'C:/xampp/htdocs/sistema_agendamento/src/config/database.php';

class AuthController {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    private function registrarLog($idUsuario, $acao, $detalhes = null) {
        try {
            $sql = "INSERT INTO logs (id_usuario, acao, detalhes) VALUES (:id_usuario, :acao, :detalhes)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
            $stmt->bindParam(':acao', $acao, PDO::PARAM_STR);
            $stmt->bindParam(':detalhes', $detalhes, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao registrar log: " . $e->getMessage());
        }
    }

    public function registrarUsuario($nome, $email, $senha) {
        try {
            $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senhaHash, PDO::PARAM_STR);
            $stmt->execute();

            $idUsuario = $this->conn->lastInsertId(); // Obter o ID do novo usuário
            $this->registrarLog($idUsuario, 'Registro', "Novo usuário registrado: $nome ($email).");
            header("Location: ../views/auth/login.php?sucesso=1");
            exit;
        } catch (PDOException $e) {
            error_log("Erro ao registrar usuário: " . $e->getMessage());
            header("Location: ../views/auth/register.php?status=error");
        }
    }

    public function autenticarUsuario($email, $senha) {
        try {
            session_start();
            $sql = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario'] = $usuario;
                $this->registrarLog($usuario['id'], 'Login', 'Usuário logou no sistema.');
                return $usuario;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Erro na autenticação: " . $e->getMessage());
            return false;
        }
    }

    public function logout() {
        session_start();
        $idUsuario = $_SESSION['usuario']['id'] ?? null;

        if ($idUsuario) {
            $this->registrarLog($idUsuario, 'Logout', 'Usuário saiu do sistema.');
        }

        session_unset();
        session_destroy();
        header("Location: ../views/auth/login.php");
        exit;
    }

    public function listarLogs() {
        try {
            $sql = "SELECT logs.id, usuarios.nome AS usuario, logs.acao, logs.detalhes, logs.data_hora
                    FROM logs
                    LEFT JOIN usuarios ON logs.id_usuario = usuarios.id
                    ORDER BY logs.data_hora DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar logs: " . $e->getMessage());
            return [];
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao'])) {
    $acao = $_POST['acao'];
    $auth = new AuthController();

    switch ($acao) {
        case 'login':
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $usuario = $auth->autenticarUsuario($email, $senha);

            if ($usuario) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                $redirectPage = $usuario['tipo'] === 'admin' ? "dashboard.php" : "schedule.php";
                header("Location: ../views/pages/$redirectPage");
            } else {
                header("Location: ../views/auth/login.php?erro=1");
            }
            exit;

        case 'registrar':
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $auth->registrarUsuario($nome, $email, $senha);
            exit;

        default:
            header("Location: ../../views/auth/login.php");
            exit;
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $controller = new AuthController();
    $controller->logout();
}
?>