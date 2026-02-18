<?php
require_once '../../config/conexao.php';
require_once 'protecao_admin.php';

// =========================
// CONTADORES DO SISTEMA
// =========================
$total_usuarios = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM usuarios"))['total'];

$total_disciplinas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM disciplinas"))['total'];

$total_notas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM notas"))['total'];

// =========================
// ÚLTIMOS LOGS
// =========================
$logs = mysqli_query($conn, "
    SELECT u.nome, l.descricao, l.data_hora
    FROM logs_atividades l
    LEFT JOIN usuarios u ON u.id_usuario = l.id_usuario
    ORDER BY l.data_hora DESC
    LIMIT 5
");
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Painel do Admin</title>
    <link rel="stylesheet" href="../../css/app.css">
</head>
<body>

<div class="app">
    <aside class="sidebar">
        <div class="brand">
            <img src="../../img/logo.png" alt="Logo">
            <strong>Sistema Acadêmico</strong>
        </div>

        <nav class="nav">
            <a href="dashboard_admin.php">Dashboard</a>
            <a href="usuarios.php">Gerir Usuários</a>
            <a href="disciplinas.php">Gerir Disciplinas</a>
        </nav>

        <div class="divider"></div>

        <a class="btn btn-danger logout" href="../../controllers/logout.php">Sair</a>
    </aside>

    <header class="topbar">
        <h1>Painel do Administrador</h1>
        <div class="actions">
            <span class="muted">Olá, <strong><?= $_SESSION['usuario_nome']; ?></strong></span>
        </div>
    </header>

    <main class="main">
        <h2 class="page-title">Visão geral</h2>

        <section class="card-grid" style="margin-bottom: 16px;">
            <div class="card"><div class="card-body metric"><span class="label">Usuários</span><span class="value"><?= $total_usuarios; ?></span></div></div>
            <div class="card"><div class="card-body metric"><span class="label">Disciplinas</span><span class="value"><?= $total_disciplinas; ?></span></div></div>
            <div class="card"><div class="card-body metric"><span class="label">Notas</span><span class="value"><?= $total_notas; ?></span></div></div>
        </section>

        <h3 class="subtitle">Últimas atividades</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Descrição</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($log = mysqli_fetch_assoc($logs)): ?>
                <tr>
                    <td><?= $log['nome'] ?? 'Sistema'; ?></td>
                    <td><?= $log['descricao']; ?></td>
                    <td><?= $log['data_hora']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</div>

</body>
</html>
