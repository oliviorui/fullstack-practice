<?php
require_once '../../config/conexao.php';
require_once 'protecao_admin.php';

// =========================
// BUSCAR USUÁRIOS
// =========================
$usuarios = mysqli_query($conn, "
    SELECT id_usuario, nome, email, tipo, data_cadastro
    FROM usuarios
    ORDER BY nome ASC
");
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Gerir Usuários</title>
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
        <h1>Gestão de Usuários</h1>
        <div class="actions">
            <a class="btn btn-ghost" href="dashboard_admin.php">← Voltar</a>
        </div>
    </header>

    <main class="main">
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($u = mysqli_fetch_assoc($usuarios)): ?>
                <tr>
                    <td><?= $u['nome']; ?></td>
                    <td><?= $u['email']; ?></td>
                    <td><?= strtoupper($u['tipo']); ?></td>
                    <td><?= $u['data_cadastro']; ?></td>
                    <td>

                        <!-- PROMOVER / REBAIXAR -->
                        <a class="btn <?= $u['tipo'] === 'admin' ? 'btn-info' : 'btn-success'; ?>"
                           href="../../controllers/alterar_tipo_usuario.php?id=<?= $u['id_usuario']; ?>&tipo=<?= $u['tipo']; ?>">
                            <?= $u['tipo'] === 'admin' ? 'Tornar Usuário' : 'Tornar Admin'; ?>
                        </a>

                        <!-- EXCLUIR -->
                        <?php if ($u['id_usuario'] != $_SESSION['usuario_id']): ?>
                            <a class="btn btn-danger"
                               onclick="return confirm('Tem certeza que deseja excluir este usuário?');"
                               href="../../controllers/excluir_usuario.php?id=<?= $u['id_usuario']; ?>">
                                Excluir
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</div>

</body>
</html>
