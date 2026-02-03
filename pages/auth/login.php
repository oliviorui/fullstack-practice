<?php
// Inicia a sessão
session_start();

// Verifica se o usuário já está logado (se a sessão estiver ativa ou se o cookie estiver presente)
if (isset($_SESSION['usuario_id']) || isset($_COOKIE['user_id'])) {
    // Se estiver logado, redireciona para o dashboard
    header('Location: ../logged/dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Acadêmico - Login</title>
    <link rel="stylesheet" href="../../css/login.css">
    <script src="../../js/jquery.js"></script>
    <script src="../../js/validate.js"></script>
    <script src="../../js/valida_form.js"></script>

    <style>
        input.error {
            border: 1px solid red;
            color: red;
            margin-top: -5px;
        }

        label.error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <img src="../../img/logo.png" alt="Logo do Sistema" class="logo">
            <h1>Faça login e desfrute do sistema</h1>
            <form action="../../controllers/processa_login.php" method="POST" id="login">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="Digite seu e-mail">
                
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha">

                <button type="submit">Entrar</button>
            </form>
            <p>Não tem conta? <a href="cadastro.php">Cadastre-se aqui</a>.</p>
        </div>
    </div>
</body>
</html>
