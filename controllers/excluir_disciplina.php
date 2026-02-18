<?php
require_once '../config/conexao.php';
session_start();

if ($_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../pages/auth/login.php");
    exit();
}

$id = intval($_GET['id']);

mysqli_query($conn, "DELETE FROM disciplinas WHERE id_disciplina = $id");

// LOG
$data_hora = date('Y-m-d H:i:s');
$descricao = "Excluiu uma disciplina";

mysqli_query($conn, "
    INSERT INTO logs_atividades (id_usuario, data_hora, descricao, tipo_actividade)
    VALUES ({$_SESSION['usuario_id']}, '$data_hora', '$descricao', 'Admin')
");

header("Location: ../pages/admin/disciplinas.php");
exit();
