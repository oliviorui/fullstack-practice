<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION['usuario'])) {
    header('Location: ../auth/login.php');
    exit;
}

if ($_SESSION['usuario']['tipo'] !== 'recepcionista') {
    header('Location: ../../../public/index.php');
    exit;
}

require_once '../../../src/config/database.php';
$conn = (new Database())->conectar();

// Recupera todos os agendamentos
$queryAgendamentos = $conn->prepare("SELECT * FROM agendamentos");
$queryAgendamentos->execute();
$agendamentos = $queryAgendamentos->fetchAll(PDO::FETCH_ASSOC);

// Mapear serviços para exibição
$servicos = [
    1 => 'Suporte Técnico',
    2 => 'Manutenção preventiva',
    3 => 'Manutenção corretiva',
    4 => 'Instalação e configuração de redes',
    5 => 'Backup e recuperação de dados',
    6 => 'Diagnóstico e reparo de hardware',
    7 => 'Instalação e configuração de software'
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos os Agendamentos</title>
    <link rel="stylesheet" href="../../../public/css/dashboard.css">
    <link rel="stylesheet" href="../../../public/css/table.css">
    <link rel="stylesheet" href="../../../public/css/form.css">
    <link rel="shortcut icon" href="../../../public/assets/logo.png" type="image/x-icon">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2 style="text-align: center; color: white;">Recepcionista</h2>
        <a href="schedule.php">Agendamentos</a>
        <a href="../../../src/controllers/AuthController.php?action=logout">Sair</a>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="header">
            <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario']['nome']) ?>!</h1>
        </div>

        <!-- Formulário de Agendamento -->
        <div class="form-container">
            <h3>Agendar Serviço</h3>
            <form action="../../../src/controllers/AgendamentoController.php?action=agendar" method="POST">
                <div class="form-group">
                    <label for="nome_cliente">Nome do Cliente</label>
                    <input type="text" id="nome_cliente" name="cliente_nome" required>
                </div>
                <div class="form-group">
                    <label for="id_servico">Serviço</label>
                    <select id="id_servico" name="servico" required>
                        <option value="" disabled selected>Selecione um serviço</option>
                        <?php foreach ($servicos as $id => $nome): ?>
                            <option value="<?= htmlspecialchars($nome) ?>"><?= htmlspecialchars($nome) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="data">Data</label>
                    <input type="date" id="data" name="data" required>
                </div>
                <div class="form-group">
                    <label for="hora">Hora</label>
                    <input type="time" id="hora" name="hora" required>
                </div>
                <button type="submit">Agendar</button>
            </form>
        </div>

        <!-- Tabela de Agendamentos -->
        <div class="form-container">
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
                            <td>
                            <!-- Botão de Cancelar -->
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
