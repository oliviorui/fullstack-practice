<?php
require_once '../config/conexao.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = $_POST['senha'];

    $query = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {

        $usuario = mysqli_fetch_assoc($result);

        // Verifica a senha criptografada
        if (password_verify($senha, $usuario['senha'])) {

            // =========================
            // SESSÃO DO USUÁRIO
            // =========================
            $_SESSION['usuario_id']   = $usuario['id_usuario'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_tipo'] = $usuario['tipo'];

            // =========================
            // COOKIE (30 dias logado)
            // =========================
            setcookie(
                "user_id",
                $usuario['id_usuario'],
                time() + (30 * 24 * 60 * 60),
                "/",
                "",
                false,
                true
            );

            // =========================
            // LOG DE LOGIN
            // =========================
            $data_hora = date('Y-m-d H:i:s');
            $descricao = "Login realizado";

            $query_log = "INSERT INTO logs_atividades 
                (id_usuario, data_hora, descricao, tipo_actividade)
                VALUES ({$usuario['id_usuario']}, '$data_hora', '$descricao', 'Login')";

            mysqli_query($conn, $query_log);

            // =========================
            // REDIRECIONAMENTO POR TIPO
            // =========================
            if ($usuario['tipo'] === 'admin') {
                header('Location: ../pages/admin/dashboard_admin.php');
            } else {
                header('Location: ../pages/logged/dashboard.php');
            }

            exit();

        } else {
            echo "<p>Senha incorreta.</p>";
        }

    } else {
        echo "<p>E-mail não encontrado.</p>";
    }
}
?>
