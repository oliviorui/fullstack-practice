<?php
session_start();
if (isset($_SESSION['usuario'])) {
    $redirectPage = $_SESSION['usuario']['tipo'] === 'admin' ? "dashboard.php" : "schedule.php";
    header("Location: ../pages/$redirectPage");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vega IT - Login</title>
    <link rel="stylesheet" href="../../../public/css/auth.css">
    <link rel="shortcut icon" href="../../../public/assets/logo.png" type="image/x-icon">
</head>
<body>
    <main>
        <div>
        <h1>Entre e conecte-se com a tecnologia!</h1>
            <p>
                A tecnologia está sempre em movimento, e estamos aqui para garantir que você acompanhe o ritmo. Faça login na sua conta e tenha acesso ao nosso ecossistema de serviços especializados.
                Realize seus agendamentos, acompanhe o status dos serviços e tenha soluções práticas para suas necessidades tecnológicas.
            </p>
        </div>
            

        <form action="../../../src/controllers/AuthController.php" method="POST">
        <?php if (isset($_GET['erro']) && $_GET['erro'] == 1): ?>
                <p style="color: red; font-size: 1em;">Email ou senha incorretos. Tente novamente.</p>
            <?php endif; ?>
            <input type="hidden" name="acao" value="login">
            <label>
                <input type="email"  class="campos" placeholder="E-mail" id="email" name="email" required>
            </label>

            <label>
                <input type="password" class="campos" placeholder="Senha"  id="senha" name="senha" required>
            </label>
            <button type="submit">Entrar</button>
            <p>Não tem uma conta? <a href="register.php">Registre-se</a></p>
        </form>
    </main>
</body>
</html>
