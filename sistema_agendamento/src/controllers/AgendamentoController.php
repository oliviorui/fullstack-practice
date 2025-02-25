<?php
session_start();
require_once '../config/database.php';

class AgendamentoController {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    private function registrarLog($idUsuario, $acao, $detalhes = null) {
        try {
            $sql = "INSERT INTO logs (id_usuario, acao, detalhes) VALUES (:id_usuario, :acao, :detalhes)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_usuario', $idUsuario);
            $stmt->bindParam(':acao', $acao);
            $stmt->bindParam(':detalhes', $detalhes);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao registrar log: " . $e->getMessage();
        }
    }

    public function agendar() {
        $clienteNome = $_POST['cliente_nome'];
        $servico = $_POST['servico'];
        $data = $_POST['data'];
        $hora = $_POST['hora'];
        $status = 'pendente';
        $idUsuario = $_SESSION['usuario']['id'];

        try {
            $sql = "INSERT INTO agendamentos (cliente_nome, servico, data, hora, status) 
                    VALUES (:cliente_nome, :servico, :data, :hora, :status)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':cliente_nome', $clienteNome);
            $stmt->bindParam(':servico', $servico);
            $stmt->bindParam(':data', $data);
            $stmt->bindParam(':hora', $hora);
            $stmt->bindParam(':status', $status);
            $stmt->execute();

            $this->registrarLog($idUsuario, 'Agendamento', 'Usuário agendou um serviço.');

            header('Location: ../views/pages/schedule.php');
            exit;
        } catch (PDOException $e) {
            echo "Erro ao agendar: " . $e->getMessage();
        }
    }

    public function concluir() {
        $idAgendamento = $_POST['id_agendamento'];
        $idUsuario = $_SESSION['usuario']['id'];

        try {
            $sql = "UPDATE agendamentos SET status = 'concluido' WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $idAgendamento);
            $stmt->execute();

            $this->registrarLog($idUsuario, 'Conclusão', 'Usuário concluiu um serviço.');
            header('Location: ../views/pages/dashboard.php');
            exit;
        } catch (PDOException $e) {
            echo "Erro ao concluir: " . $e->getMessage();
        }
    }

    public function cancelar() {
        $idAgendamento = $_POST['id_agendamento'];
        $idUsuario = $_SESSION['usuario']['id'];

        try {
            $sql = "UPDATE agendamentos SET status = 'cancelado' WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $idAgendamento);
            $stmt->execute();

            $this->registrarLog($idUsuario, 'Cancelamento', 'Usuário cancelou um serviço.');
            if ($_SESSION['usuario']['tipo'] === 'admin') {
                header('Location: ../views/pages/dashboard.php');
            } else {
                header('Location: ../views/pages/schedule.php');
            }
            exit;
        } catch (PDOException $e) {
            echo "Erro ao cancelar: " . $e->getMessage();
        }
    }
}

// Roteamento de ações
if (isset($_GET['action'])) {
    $controller = new AgendamentoController();

    if ($_GET['action'] === 'agendar') {
        $controller->agendar();
    } elseif ($_GET['action'] === 'cancelar') {
        $controller->cancelar();
    } elseif ($_GET['action'] === 'concluir') {
        $controller->concluir();
    }
}
?>