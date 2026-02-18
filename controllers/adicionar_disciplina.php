<?php
require_once '../config/conexao.php';
session_start();

if ($_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../pages/auth/login.php");
    exit();
}

$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$codigo = mysqli_real_escape_string($conn, $_POST['codigo']);
$descricao = mysqli_real_escape_string($conn, $_POST['descricao']);

mysqli_query($conn, "
    INSERT INTO disciplinas (nome, codigo, descricao)
    VALUES ('$nome', '$codigo', '$descricao')
");

// LOG
$data_hora = date('Y-m-d H:i:s');
$descricao_log = "Adicionou disciplina: $nome";

mysqli_query($conn, "
    INSERT INTO logs_atividades (id_usuario, data_hora, descricao, tipo_actividade)
    VALUES ({$_SESSION['usuario_id']}, '$data_hora', '$descricao_log', 'Admin')
");

header("Location: ../pages/admin/disciplinas.php");
exit();
