<?php
session_start();
require_once '../config/conexao.php';

header('Content-Type: application/json');

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(["Erro" => "Usuário não autenticado"]);
    exit();
}

$id_usuario = $_SESSION['usuario_id'];
$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Inicializa o array de dados
$dados = [];

// Buscar usuários
$query = "SELECT id_usuario, nome, email, data_cadastro FROM usuarios";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo json_encode(["Erro" => "Erro na consulta de usuários: " . mysqli_error($conn)]);
    exit();
}
$usuarios = [];
while ($row = mysqli_fetch_assoc($result)) {
    $usuarios[] = $row;
}
$dados["usuarios"] = $usuarios;

// Buscar disciplinas com filtro
$query = "SELECT id_disciplina, nome, codigo, descricao 
          FROM disciplinas 
          WHERE nome LIKE '%$searchTerm%' OR descricao LIKE '%$searchTerm%'";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo json_encode(["Erro" => "Erro na consulta de disciplinas: " . mysqli_error($conn)]);
    exit();
}
$disciplinas = [];
while ($row = mysqli_fetch_assoc($result)) {
    $disciplinas[] = $row;
}
$dados["disciplinas"] = $disciplinas;

// Buscar notas do usuário autenticado com filtro
$query = "SELECT n.id_nota, d.nome AS disciplina, n.nota, n.tipo_avaliacao, n.data_avaliacao 
          FROM notas n
          JOIN disciplinas d ON n.id_disciplina = d.id_disciplina
          WHERE n.id_usuario = $id_usuario 
          AND (d.nome LIKE '%$searchTerm%' OR n.nota LIKE '%$searchTerm%')";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo json_encode(["Erro" => "Erro na consulta de notas: " . mysqli_error($conn)]);
    exit();
}
$notas = [];
while ($row = mysqli_fetch_assoc($result)) {
    $notas[] = $row;
}
$dados["notas"] = $notas;

// Buscar logs de atividades (sem filtro, pois não foi especificado)
$query = "SELECT id_log, data_hora, descricao, tipo_actividade 
          FROM logs_atividades 
          WHERE id_usuario = $id_usuario
          ORDER BY data_hora DESC";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo json_encode(["Erro" => "Erro na consulta de logs de atividades: " . mysqli_error($conn)]);
    exit();
}
$logs = [];
while ($row = mysqli_fetch_assoc($result)) {
    $logs[] = $row;
}
$dados["logs_atividades"] = $logs;

// Retorna todos os dados em JSON
echo json_encode($dados);
?>
