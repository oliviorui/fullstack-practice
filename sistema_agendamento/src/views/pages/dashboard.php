<?php
session_start();

header("Cache-Control: no-cache, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Desativa cache em navegadores

if ($_SESSION['usuario']['tipo'] !== 'admin') {
    header('Location: ../../../public/index.php');
    exit;
}

if (!isset($_SESSION['usuario'])) {
    header('Location: ../auth/login.php');
    exit;
}

require_once '../../../src/config/database.php';
$conn = (new Database())->conectar();

// Recupera o total de agendamentos concluídos
$queryTotalConcluidos = $conn->prepare("SELECT COUNT(*) AS total FROM agendamentos WHERE status = 'concluido'");
$queryTotalConcluidos->execute();
$totalConcluidos = $queryTotalConcluidos->fetch(PDO::FETCH_ASSOC)['total'];

// Recupera o total de agendamentos pendentes
$queryTotalPendentes = $conn->prepare("SELECT COUNT(*) AS total FROM agendamentos WHERE status = 'pendente'");
$queryTotalPendentes->execute();
$totalPendentes = $queryTotalPendentes->fetch(PDO::FETCH_ASSOC)['total'];

// Recupera todos os agendamentos
$queryAgendamentos = $conn->prepare("SELECT * FROM agendamentos");
$queryAgendamentos->execute();
$agendamentos = $queryAgendamentos->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../../public/css/dashboard.css">
    <link rel="stylesheet" href="../../../public/css/table.css">
    <link rel="shortcut icon" href="../../../public/assets/logo.png" type="image/x-icon">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2 style="text-align: center; color: white;">Administrador</h2>
        <a href="dashboard.php">Agendamentos</a>
        <a href="logs.php">Atividades</a>
        <a href="../../../src/controllers/AuthController.php?action=logout">Sair</a>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="header">
            <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario']['nome']) ?>!</h1>
        </div>

        <!-- Cards de Resumo -->
        <div class="cards-container">
            <div class="card">
                <h3>Total Tarefas</h3>
                <p><?= $totalConcluidos + $totalPendentes ?></p>
            </div>
            <div class="card">
                <h3>Total Concluídos</h3>
                <p><?= $totalConcluidos ?></p>
            </div>
            <div class="card">
                <h3>Total Pendentes</h3>
                <p><?= $totalPendentes ?></p>
            </div>
        </div>

        <!-- Tabela de Agendamentos -->
        <div class="table-container">
            <h3>Lista de Agendamentos</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Serviço</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agendamentos as $agendamento): ?>
                        <tr>
                            <td><?= $agendamento['id'] ?></td>
                            <td><?= htmlspecialchars($agendamento['cliente_nome']) ?></td>
                            <td><?= htmlspecialchars($agendamento['servico']) ?></td>
                            <td><?= htmlspecialchars($agendamento['data']) ?></td>
                            <td><?= htmlspecialchars($agendamento['hora']) ?></td>
                            <td><?= htmlspecialchars($agendamento['status']) ?></td>
                            <td style="display: flex; gap: 10px; justify-content: space-around;">
                                <form action="../../../src/controllers/AgendamentoController.php?action=concluir" method="POST">
                                    <input type="hidden" name="id_agendamento" value="<?= $agendamento['id'] ?>">
                                    <button type="submit">Concluir</button>
                                </form>
                                <form action="../../../src/controllers/AgendamentoController.php?action=cancelar" method="POST">
                                    <input type="hidden" name="id_agendamento" value="<?= $agendamento['id'] ?>">
                                    <button type="submit">Cancelar</button>
                            </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
