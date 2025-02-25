<?php
session_start();
require_once '../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_SESSION['usuario_id'];
    $id_disciplina = intval($_POST['disciplina']); // Pegamos o ID da disciplina
    $nota = floatval($_POST['nota']);
    $tipo_avaliacao = mysqli_real_escape_string($conn, $_POST['tipo_avaliacao']); // 'Prova', 'Trabalho', 'Exame'

    // Recupera o nome da disciplina
    $query_disciplina = "SELECT nome FROM disciplinas WHERE id_disciplina = $id_disciplina";
    $result_disciplina = mysqli_query($conn, $query_disciplina);

    if ($result_disciplina && mysqli_num_rows($result_disciplina) > 0) {
        $row_disciplina = mysqli_fetch_assoc($result_disciplina);
        $nome_disciplina = $row_disciplina['nome'];
        
        // Insere a nota
        $query = "INSERT INTO notas (id_usuario, id_disciplina, nota, data_avaliacao, tipo_avaliacao) 
                  VALUES ($id_usuario, $id_disciplina, $nota, NOW(), '$tipo_avaliacao')";

        if (mysqli_query($conn, $query)) {
            // Registra o log de atividade com o nome da disciplina
            $descricao = "Adicionou nota na disciplina de $nome_disciplina";
            $query_log = "INSERT INTO logs_atividades (id_usuario, data_hora, descricao, tipo_actividade) 
                          VALUES ($id_usuario, NOW(), '$descricao', 'Registro')";
            mysqli_query($conn, $query_log);

            header('Location: ../pages/logged/dashboard.php');
            exit();
        } else {
            echo "<p>Erro ao adicionar nota: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p>Erro: Disciplina não encontrada.</p>";
    }
}
?>
