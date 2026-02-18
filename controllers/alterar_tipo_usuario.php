<?php
require_once '../config/conexao.php';
session_start();

if ($_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../pages/auth/login.php");
    exit();
}

$id = intval($_GET['id']);
$tipo_atual = $_GET['tipo'];

$novo_tipo = ($tipo_atual === 'admin') ? 'usuario' : 'admin';

$query = "UPDATE usuarios SET tipo = '$novo_tipo' WHERE id_usuario = $id";
mysqli_query($conn, $query);

// LOG
$data_hora = date('Y-m-d H:i:s');
$descricao = "Alterou tipo de usuário para $novo_tipo";

mysqli_query($conn, "
    INSERT INTO logs_atividades (id_usuario, data_hora, descricao, tipo_actividade)
    VALUES ({$_SESSION['usuario_id']}, '$data_hora', '$descricao', 'Admin')
");

header("Location: ../pages/admin/usuarios.php");
exit();
