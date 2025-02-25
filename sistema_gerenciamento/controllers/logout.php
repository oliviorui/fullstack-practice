<?php
session_start();
require_once '../config/conexao.php'; // Ajustei o caminho da conexão

if (isset($_SESSION['usuario_id'])) {
    $id_usuario = $_SESSION['usuario_id'];

    // Registra o log de logout no sistema
    $data_hora = date('Y-m-d H:i:s');
    $descricao = 'Logout realizado';
    $query_log = "INSERT INTO logs_atividades (id_usuario, data_hora, descricao, tipo_actividade) 
                  VALUES ($id_usuario, '$data_hora', '$descricao', 'Logout')";
    mysqli_query($conn, $query_log);
}

// Remove o cookie "user_id" definindo sua data de expiração no passado
if (isset($_COOKIE['user_id'])) {
    setcookie('user_id', '', time() - 3600, '/'); // Expira o cookie imediatamente
}

// Destroi a sessão
session_unset();
session_destroy();

// Previne o navegador de armazenar a página em cache
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Redireciona para a página de login
header("Location: ../pages/auth/login.php");
exit();
?>
