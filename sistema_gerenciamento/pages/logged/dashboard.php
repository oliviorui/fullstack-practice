<?php
session_start();
require_once '../../config/conexao.php';

// Verifica se existe o cookie de usuário
if (isset($_COOKIE['user_id'])) {
    $usuario_id = $_COOKIE['user_id'];

    // Verifica se o ID do usuário ainda existe no banco de dados
    $query = "SELECT * FROM usuarios WHERE id_usuario = '$usuario_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);

        // Configura os dados da sessão caso o cookie seja válido
        $_SESSION['usuario_id'] = $usuario['id_usuario'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        
    } else {
        // Se o cookie estiver inválido, redireciona o usuário para o login
        header('Location: ../auth/login.php');
        exit();
    }
} else {
    // Se não houver cookie, redireciona para o login
    header('Location: ../auth/login.php');
    exit();
}

// Consulta para buscar todas as disciplinas
$query_disciplinas = "SELECT id_disciplina, nome FROM disciplinas";
$result_disciplinas = mysqli_query($conn, $query_disciplinas);
$disciplinas = [];

while ($row = mysqli_fetch_assoc($result_disciplinas)) {
    $disciplinas[] = $row;
}

// Agora, em vez de enviar os dados apenas para a interface, você também pode passar o nome do usuário
$usuario_nome = $_SESSION['usuario_nome'] ?? 'Usuário desconhecido'; // Definindo nome como "desconhecido" caso a sessão não esteja configurada
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - Sistema Acadêmico</title>
    <link rel="stylesheet" href="../../css/estilo.css">
    <script src="../../js/jquery.js"></script>
    <script src="../../js/chart.js"></script>
    <script src="../../js/validate.js"></script>
    <script src="../../js/valida_form.js"></script>
    
    <style>
        input.error {
            border: 1px solid red;
            color: red;
        }

        label.error {
            color: red;
            margin-top: -5px;
        }
    </style>
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
        <h1>Bem-vindo(a), <span id="usuarioNome"><?= $usuario_nome ?></span>!</h1>

        <h2>Pesquisar Notas</h2>
        <label for="searchTerm">Buscar:</label>
        <input type="text" id="searchTerm" name="search" placeholder="Digite o nome da disciplina ou nota obtida">

        <h2 class="metade">Registar Nota</h2>
        <form action="../../controllers/adiciona_nota.php" method="POST" id="novaNota">
            <label for="disciplina">Disciplina:</label>
            <select name="disciplina" id="disciplina">
                <option value="">Selecione uma disciplina</option>
                <?php foreach ($disciplinas as $disciplina): ?>
                    <option value="<?= $disciplina['id_disciplina'] ?>"><?= $disciplina['nome'] ?></option>
                <?php endforeach; ?>
            </select>
            
            <label for="nota">Nota:</label>
            <input type="number" id="nota" name="nota" step="0.01">
            
            <label for="tipo_avaliacao">Tipo de Avaliação:</label>
            <select id="tipo_avaliacao" name="tipo_avaliacao">
                <option value="Prova">Prova</option>
                <option value="Trabalho">Trabalho</option>
                <option value="Exame">Exame</option>
            </select>
            
            <button type="submit">Adicionar Nota</button>
        </form>

        <h2 class="metade" id="right">Gráfico de desempenho</h2>
        <canvas id="graficoDesempenho"></canvas>

        <!-- Exibição das notas -->
        <h2>Suas Notas</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Disciplina</th>
                    <th>Nota</th>
                    <th>Data</th>
                    <th>Tipo</th>
                    <th>Desempenho</th>
                </tr>
            </thead>
            <tbody id="tabelaNotas">
                <tr>
                    <td colspan="3" style="text-align:center;">Carregando...</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            // Atualiza o nome do usuário logado
            $("#usuarioNome").text("<?= $usuario_nome ?>");
            
            // Função para carregar as notas com base no filtro de pesquisa
            function carregarNotas(searchTerm = '') {
                $.ajax({
                    url: '../../dados/get_dados.php',
                    method: 'GET',
                    data: { search: searchTerm }, // Envia o termo de pesquisa
                    dataType: 'json',
                    success: function (response) {
                        console.log(response); // Verifique os dados no console
                        let notas = response.notas;
                        let tabelaNotas = $("#tabelaNotas");
                        tabelaNotas.empty();

                        if (notas.length > 0) {
                            notas.forEach(function (nota) {
                                let desempenho = "";
                                if (nota.nota <= 9.9) {
                                    desempenho = "Mau";
                                } else if (nota.nota >= 10 && nota.nota <= 13.9) {
                                    desempenho = "Suficiente";
                                } else if (nota.nota >= 14 && nota.nota <= 15.9) {
                                    desempenho = "Bom";
                                } else {
                                    desempenho = "Muito Bom";
                                }
                                tabelaNotas.append(
                                    `<tr>
                                        <td>${nota.disciplina}</td>
                                        <td>${nota.nota}</td>
                                        <td>${nota.data_avaliacao}</td>
                                        <td>${nota.tipo_avaliacao}</td>
                                        <td>${desempenho}</td>
                                    </tr>`
                                );
                            });
                        } else {
                            tabelaNotas.append('<tr><td colspan="4">Nenhuma atividade registrada.</td></tr>');
                        }
                    },
                    error: function () {
                        $("#tabelaNotas").html('<tr><td colspan="4">Erro ao carregar os logs.</td></tr>');
                    }
                });
            }

            // Chama a função de carregar notas sem filtro na inicialização
            carregarNotas();

            // Adiciona evento de 'keyup' para pesquisa em tempo real
            $("#searchTerm").keyup(function () {
                let searchTerm = $(this).val(); // Pega o valor digitado no campo de pesquisa
                carregarNotas(searchTerm); // Recarrega as notas com o filtro de pesquisa
            });
        });
    </script>

    <!-- Gráfico de desempenho -->
    <script>
        $(document).ready(function () {
            $.ajax({
                url: '../../dados/get_dados.php', // Caminho do JSON
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    let disciplinas = response.disciplinas;
                    let notas = response.notas;

                    // Criar arrays para armazenar os dados do gráfico
                    let labels = [];
                    let dataNotas = [];

                    // Percorrer as disciplinas e pegar as notas correspondentes
                    disciplinas.forEach(disciplina => {
                        let notaEncontrada = notas.find(n => n.disciplina === disciplina.nome);
                        let nota = notaEncontrada ? parseFloat(notaEncontrada.nota) : 0;

                        labels.push(disciplina.nome);
                        dataNotas.push(nota);
                    });

                    // Criar gráfico com Chart.js
                    let ctx = $('#graficoDesempenho');
                    let grafico = new Chart(ctx, {
                        type: 'bar', // Tipo de gráfico
                        data: {
                            labels: labels, // Disciplinas no eixo X
                            datasets: [{
                                label: 'Notas Obtidas',
                                data: dataNotas, // Notas no eixo Y
                                backgroundColor: dataNotas.map(nota => {
                                    if (nota < 10) return 'rgba(255, 99, 132, 0.7)';  // Vermelho (ruim)
                                    if (nota >= 10 && nota <= 13.9) return 'rgba(255, 206, 86, 0.7)';  // Amarelo (médio)
                                    return 'rgba(75, 192, 192, 0.7)';  // Verde (bom)
                                }),
                                borderColor: 'rgba(0, 0, 0, 0.8)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    suggestedMax: 20
                                }
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Desempenho Acadêmico por Disciplina',
                                    font: {
                                        size: 16
                                    }
                                }
                            }
                        }
                    });
                },
                error: function () {
                    console.error("Erro ao carregar os dados.");
                }
            });
        });
    </script>
</body>
</html>
