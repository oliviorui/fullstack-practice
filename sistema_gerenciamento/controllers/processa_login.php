<?php
require_once '../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = $_POST['senha'];

    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);

        if (password_verify($senha, $usuario['senha'])) {
            session_start();
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_tipo'] = $usuario['tipo'];

            // Definindo o cookie para manter o usuário logado por 30 dias
            $cookie_nome = "user_id";
            $cookie_valor = $usuario['id_usuario'];
            $cookie_expira_em = time() + (30 * 24 * 60 * 60);  // 30 dias
            setcookie($cookie_nome, $cookie_valor, $cookie_expira_em, "/");  // "/" torna o cookie acessível em todo o domínio

            // Registrando a atividade de login no log
            $data_hora = date('Y-m-d H:i:s');
            $descricao = "Login realizado";
            $query_log = "INSERT INTO logs_atividades (id_usuario, data_hora, descricao, tipo_actividade) 
                          VALUES ({$usuario['id_usuario']}, '$data_hora', '$descricao', 'Login')";
            mysqli_query($conn, $query_log);

            header('Location: ../pages/logged/dashboard.php');
            exit();
        } else {
            echo "<p>Senha incorreta.</p>";
        }
    } else {
        echo "<p>E-mail não encontrado.</p>";
    }
}
?>
