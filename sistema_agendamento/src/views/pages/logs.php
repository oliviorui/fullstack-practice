<?php
session_start();

header("Cache-Control: no-cache, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Desativa cache em navegadores

if ($_SESSION['usuario']['tipo'] !== 'admin') {
    header('Location: ../../../public/index.php');
    exit;
}

require_once '../../controllers/AuthController.php';
$auth = new AuthController();
$logs = $auth->listarLogs();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs do Sistema</title>
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
        <a href="../../controllers/AuthController.php?action=logout">Sair</a>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="header">
            <h1>Logs do Sistema</h1>
        </div>

        <!-- Cards de Resumo -->
        <div class="cards-container">
            <div class="card">
                <h3>Total de Logs</h3>
                <p><?= count($logs) ?></p>
            </div>
        </div>

        <!-- Tabela de Logs -->
        <div class="form-container">
            <h3>Lista de Logs</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Ação</th>
                        <th>Detalhes</th>
                        <th>Data e Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?= $log['id'] ?></td>
                            <td><?= $log['usuario'] ?? 'N/A' ?></td>
                            <td><?= $log['acao'] ?></td>
                            <td><?= $log['detalhes'] ?></td>
                            <td><?= $log['data_hora'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
