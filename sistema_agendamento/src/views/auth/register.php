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
    <title>Vega IT - Registro</title>
    <link rel="stylesheet" href="../../../public/css/auth.css">
    <link rel="shortcut icon" href="../../../public/assets/logo.png" type="image/x-icon">
</head>
<body>
    <main>
        <div>
            <h1>Crie sua conta e conecte-se com a tecnologia!</h1>
            <p>
                Junte-se à Vega IT e tenha acesso exclusivo aos nossos serviços:
            </p>
                <li>Suporte técnico especializado</li>
                <li>Manutenção preventiva e corretiva</li>
                <li>Diagnóstico e reparo de hardware e software</li>
                <li>Muito mais!</li>
            <p>
                Preencha o formulário ao lado e comece agora mesmo. Estamos aqui para simplificar sua vida tecnológica.
            </p>
        </div>
        
        <form action="../../../src/controllers/AuthController.php" method="POST">
            <?php if (isset($_GET['sucesso'])): ?>
                <p style="color: green;">Registro realizado com sucesso! Faça login.</p>
            <?php elseif (isset($_GET['erro'])): ?>
                <p style="color: red;">Ocorreu um erro no registro. Tente novamente.</p>
            <?php endif; ?>

            <input type="hidden" name="acao" value="registrar">

            <label>
                <input type="text" class="campos" id="nome" placeholder="Nome" name="nome" required>
            </label>

            <label>
                <input type="email" class="campos" id="email" placeholder="Email" name="email" required>
            </label>

            <label>
                <input type="password" id="senha" class="campos" placeholder="Senha"  name="senha" required>
            </label>

            <button type="submit">Registrar</button>
            <p>Já possui uma conta? <a href="login.php">Faça login</a></p>
        </form>
    </main>
</body>
</html>
