<?php
require_once '../config/conexao.php';
session_start();

if ($_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../pages/auth/login.php");
    exit();
}

$id = intval($_GET['id']);

// Não deixa o admin se auto-destruir 😅
if ($id == $_SESSION['usuario_id']) {
    header("Location: ../pages/admin/usuarios.php");
    exit();
}

mysqli_query($conn, "DELETE FROM usuarios WHERE id_usuario = $id");

// LOG
$data_hora = date('Y-m-d H:i:s');
$descricao = "Excluiu um usuário";

mysqli_query($conn, "
    INSERT INTO logs_atividades (id_usuario, data_hora, descricao, tipo_actividade)
    VALUES ({$_SESSION['usuario_id']}, '$data_hora', '$descricao', 'Admin')
");

header("Location: ../pages/admin/usuarios.php");
exit();
