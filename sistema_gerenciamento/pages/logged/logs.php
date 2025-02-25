<?php
    session_start();
    // Verifica se o usuário está autenticado
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: ../auth/login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - Sistema Acadêmico</title>
    <link rel="stylesheet" href="../../css/estilo.css">
    <script src="../../js/jquery.js"></script>
</head>
<body>
    <div class="sidebar">
        <nav>
            <a href="dashboard.php">Página Inicial</a>
            <a href="logs.php">Atividades no sistema</a>
        </nav>
        
        <form action="../../controllers/logout.php" method="POST">
            <input type="hidden" name="acao" value="logout">
            <input type="submit" value="Sair" id="btnSair">
        </form>
    </div>
    
    <div class="container">
        <h1>Bem-vindo(a), <span id="usuarioNome"></span>!</h1>
        
        <h2>Logs de Atividades</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Data e Hora</th>
                    <th>Descrição</th>
                    <th>Tipo de Atividade</th>
                </tr>
            </thead>
            <tbody id="tabelaLogs">
                <tr>
                    <td colspan="4">Carregando...</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '../../dados/get_dados.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Atualiza o nome do usuário logado
                    if (response.usuarios.length > 0) {
                        $("#usuarioNome").text(response.usuarios[0].nome);
                    }

                    // Preenche a tabela de logs
                    let logs = response.logs_atividades;
                    let tabelaLogs = $("#tabelaLogs");
                    tabelaLogs.empty();

                    if (logs.length > 0) {
                        logs.forEach(log => {
                            tabelaLogs.append(`
                                <tr>
                                    <td>${log.data_hora}</td>
                                    <td>${log.descricao}</td>
                                    <td>${log.tipo_actividade}</td>
                                </tr>
                            `);
                        });
                    } else {
                        tabelaLogs.append('<tr><td colspan="4">Nenhuma atividade registrada.</td></tr>');
                    }
                },
                error: function() {
                    $("#tabelaLogs").html('<tr><td colspan="4">Erro ao carregar os logs.</td></tr>');
                }
            });
        });
    </script>
</body>
</html>
